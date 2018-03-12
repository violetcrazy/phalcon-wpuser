<?php

namespace Orders\Controller;

use Common\Constant;
use \Core\Controller\BaseController;
use Orders\Model\Orders;
use Orders\Model\OrdersItem;
use Phalcon\Exception;
use User\HelperModel\UserHelper;
use User\Model\User;
use User\Model\UserMeta;

class SingleController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function editAction()
    {
        $orderId = $this->dispatcher->getParam('id', array('int'), 0);

        $billing = $this->request->getPost('billing');
        $shipping = $this->request->getPost('shipping');

        $orderRequest = $this->request->getPost('order_detail', array('striptags'), '');
        if (is_string($orderRequest)){
            $orderRequest = json_decode($orderRequest, true);
        }

        $orderDetail = Orders::findFirst("order_id = '{$orderId}'");

        if (!$orderDetail){
            throw new Exception("Không tồn tại đơn hàng này {$orderId}");
        }

        $orderItems = $orderDetail->getItems('OBJECT');

        if ($this->request->isPost()){

            if ($this->validateOrder()) {
                $orderDetail->total_price = 0;
                $orderDetail->total_qty = 0;

                $statusNew = $this->request->getPost('order_status', array('striptags', 'trim'), Constant::ORDER_STATUS_DEFAULT);
                if ($statusNew != $orderDetail->status && !empty($statusNew)){
                    $userName = $this->userCurrent->getName();
                    $statusOldLabel = $orderDetail->getStatusHtml();
                    $orderDetail->status = $statusNew;
                    $statusNewLabel = $orderDetail->getStatusHtml();

                    $orderDetail->addNote("{$userName} đã chuyển trạng thái từ {$statusOldLabel} ==> {$statusNewLabel}", Constant::ORDER_NOTE_TYPE_SYSTEM);

                }

                $customer = $this->checkCustomer($orderDetail);

                $orderDetail->saveShippingCustomer($shipping);

                foreach ($orderItems as $item) {
                    $item->delete();
                }

                foreach ($orderRequest['itemsline'] as $product){
                    if (is_array($product) && count($product) > 0){
                        $orderItem = new OrdersItem();
                        $orderItem->order_id = $orderDetail->order_id;
                        $orderItem->customer_id = 0;
                        $orderItem->saler_id = $this->userCurrent->ID;
                        $orderItem->product_id = 0;
                        $orderItem->product_name = trim($product['name']);
                        $orderItem->product_price = $product['price'];
                        $orderItem->product_qty = $product['qty'];
                        $orderItem->product_sku = '';


                        if (!$orderItem->create()) {
                            foreach ($orderItem->getMessages() as $mess) {
                                $this->flashSession->error($mess->getMessage());
                            }
                        } else {
                            $orderDetail->total_price += ($orderItem->product_price * $orderItem->product_qty);
                            $orderDetail->total_qty ++;
                        }
                    }
                }


                if (count($orderRequest['fee']) > 0) {
                    foreach ($orderRequest['fee'] as $fee) {
                        if ($fee['value'] > 0) {
                            $orderDetail->total_price += (int)$fee['value'];
                        }
                    }
                    $orderDetail->update_meta('fee_plus', $orderRequest['fee']);
                }

                if ($orderRequest['discount'] > 0) {
                    $orderDetail->total_price -= (int)$orderRequest['discount'];
                    $orderDetail->update_meta('discount', $orderRequest['discount']);
                    if (!empty($orderRequest['discount_note'])) {
                        $orderDetail->update_meta('discount_note', $orderRequest['discount_note']);
                    }
                }

                if (!$orderDetail->save()) {
                    foreach ($orderDetail->getMessages() as $m) {
                        $this->flashSession->error($m->getMessage());
                    }
                } else {
                    $this->flashSession->success('Cập nhật đơn hàng thành công');
                }

                $this->response->redirect(array(
                    'for' => 'order_edit',
                    'id' => $orderDetail->order_id
                ));

                return true;
            }
        }

        $this->view->orderDetail = $orderDetail;

        $this->view->pick('orders/edit');
    }

    public function addAction()
    {

        if ($this->request->isPost()){

            if ($this->validateOrder()) {
                $this->processOrderCreate();
            }
        }

        $this->view->pick('orders/add');
    }

    private function validateOrder()
    {
        $output = true;

        $billing = $this->request->getPost('billing');
        $shipping = $this->request->getPost('shipping');
        $orderRequest = $this->request->getPost('order_detail', array('striptags'), '');
        if (is_string($orderRequest)){
            $orderRequest = json_decode($orderRequest, true);
        }

        if (empty($billing['phone']) || strlen($billing['phone']) < 10) {
            $this->flashSession->error('Số điện thoại người mua không hợp lệ');
            $output = false;
        }

        if (!empty($billing['email']) &&  !filter_var($billing['email'], FILTER_VALIDATE_EMAIL)) {
            $this->flashSession->error('Email người mua không hợp lệ');
            $output = false;
        }

        if (empty($billing['address'])) {
            $this->flashSession->error('Địa chỉ người mua là bắt buộc');
            $output = false;
        }

        if (empty($billing['name'])) {
            $this->flashSession->error('Tên người mua là bắt buộc');
            $output = false;
        }

        if (!empty($shipping['phone']) && strlen($shipping['phone']) < 10) {
            $this->flashSession->error('Số điện thoại người nhận không hợp lệ');
            $output = false;
        }

        if (!empty($shipping['email']) &&  !filter_var($billing['email'], FILTER_VALIDATE_EMAIL)) {
            $this->flashSession->error('Email người nhận không hợp lệ');
            $output = false;
        }

        if (!isset($orderRequest['total']) || $orderRequest['total'] == 0){
            $this->flashSession->error('Gía trị đơn hàng không hợp lệ hoặc bằng 0');
            $output = false;
        }

        if (!isset($orderRequest['itemsline']) || $orderRequest['itemsline'] == 0){
            $this->flashSession->error('Chưa có sản phẩm trong đơn hàng');
            $output = false;
        }

        return $output;
    }


    private function processOrderCreate()
    {
        $billing = $this->request->getPost('billing');
        $shipping = $this->request->getPost('shipping');
        $orderRequest = $this->request->getPost('order_detail', array('striptags'), '');

        if (!empty($orderRequest)) {
            $orderRequest = json_decode($orderRequest, true);
        }

        $order = new Orders();

        $customer = $this->checkCustomer($order);

        $order->saler_id = $this->userCurrent->ID;
        $order->total_price = 0;
        $order->total_qty = 0;
        $order->ip = $this->request->getClientAddress();

        $order->status = Constant::ORDER_STATUS_DEFAULT;
        $order->updated_by = $this->userCurrent->ID;
        $order->created_by = $this->userCurrent->ID;

        if (!$order->create()) {
            foreach ($order->getMessages() as $mess) {
                $this->flashSession->error($mess->getMessage());
            }
        } else {

            if ($orderRequest['total'] > 0){
                if (count($orderRequest['itemsline']) > 0) {
                    foreach ($orderRequest['itemsline'] as $product) {
                        $total = $product['price'] * $product['qty'];

                        $orderItem = new OrdersItem();
                        $orderItem->order_id = $order->order_id;
                        $orderItem->customer_id = $customer->ID;
                        $orderItem->saler_id = $this->userCurrent->ID;
                        $orderItem->product_id = 0;
                        $orderItem->product_name = $product['name'];
                        $orderItem->product_price = $product['price'];
                        $orderItem->product_qty = $product['qty'];
                        $orderItem->product_sku = '';

                        if ($orderItem->create()) {
                            if ($total > 0) {
                                $order->total_price += $total;
                            }

                            $order->total_qty ++;
                        }
                    }
                }

                if (count($orderRequest['fee']) > 0) {
                    foreach ($orderRequest['fee'] as $id => $fee) {
                        if ($fee['value'] > 0) {
                            $order->total_price += $fee['value'];
                        } else {
                            unset($fee[$id]);
                        }
                    }
                    $order->create_meta('fee_plus', $orderRequest['fee']);
                }

            }

            if ($orderRequest['discount'] > 0) {
                $order->total_price -= $orderRequest['discount'];
                $order->create_meta('discount', $orderRequest['discount']);
                if (!empty($orderRequest['discount_note'])) {
                    $order->create_meta('discount_note', $orderRequest['discount_note']);
                }
            }

            $order->saveShippingCustomer($shipping);

            $billing['name'] = $billing['name'] . ' tạo từ đơn hàng #' . $order->order_id;
            $customer->addAdress($billing);

            if(!$order->update()) {
                foreach ($order->getMessages() as $m) {
                    $this->flashSession->error($m->getMessage());
                }
            } else {
                $this->response->redirect(array(
                    'for' => 'order_edit',
                    'id' => $order->order_id
                ));
            }
        }
    }

    public function checkCustomer(&$order)
    {
        $billing = $this->request->getPost('billing');

        $customer = User::findFirst("
        (user_phone = '{$billing['phone']}' AND user_email = '{$billing['email']}') 
        OR (user_phone = '{$billing['phone']}') 
        OR (user_email = '{$billing['email']}')");

        if (!$customer) {
            $customer = new User();
            $customer->display_name = $billing['name'];
            $customer->user_nicename = $billing['name'];
            $customer->user_login = $billing['email'];
            $customer->user_email = $billing['email'];
            $customer->user_pass = md5(uniqid());
            $customer->user_phone = $billing['phone'];
            $customer->user_address = $billing['address'];
            $customer->user_status = 0;

            if (!$customer->create()){
                $messs = $customer->getMessages();
                foreach ($messs as $m) {
                    $this->flashSession->error($m->getMessage());
                }
            }
        }

        $customer->update_meta('role', Constant::USER_MEMBER_CUSTOMER);

        $order->customer_id = $customer->ID;
        $order->customer_email = $customer->user_email;
        $order->customer_phone = $customer->getPhone();
        $order->customer_name = $customer->getName();
        $order->customer_address = $customer->getAddress();

        return $customer;
    }
}

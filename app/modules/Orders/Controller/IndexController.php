<?php

namespace Orders\Controller;

use Common\Constant;
use \Core\Controller\BaseController;
use Orders\Model\Orders;
use Orders\Model\OrdersItem;
use User\Model\User;
use User\Model\UserAddress;
use User\Model\UserMeta;

class IndexController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $this->view->pick('orders/listing');
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

        if (empty($billing['phone']) || count($billing['phone']) < 10) {
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

        if (!empty($shipping['phone']) || count($shipping['phone']) < 10) {
            $this->flashSession->error('Số điện thoại người nhận không hợp lệ');
            $output = false;
        }

        if (!empty($shipping['email']) ||  !filter_var($billing['email'], FILTER_VALIDATE_EMAIL)) {
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
        $currentTime = time();

        $billing = $this->request->getPost('billing');
        $shipping = $this->request->getPost('shipping');
        $orderRequest = $this->request->getPost('order_detail', array('striptags'), '');

        if (!empty($orderRequest)) {
            $orderRequest = json_decode($orderRequest, true);
        }

        $customer = '';

        if (empty($billing['email']) && filter_var($billing['email'], FILTER_VALIDATE_EMAIL)) {
            $customer = User::findFirst("user_email = '{$billing['email']}'");
        }

        if (!$customer) {
            $customerMeta = UserMeta::findFirst(array(
                'conditions' => '(meta_key = :key_phone: AND meta_value = :phone_value:) OR (meta_key = :key_email: AND meta_value = :email_value:)',
                'bind' => array(
                    'key_phone' => 'billing_phone',
                    'phone_value' => $billing['phone'],
                    'key_email' => 'billing_email',
                    'email_value' => $billing['email'],
                )
            ));

            if (!$customerMeta) {
                $customer = new User();
                $customer->display_name = $billing['name'];
                $customer->user_nicename = $billing['name'];
                $customer->user_login = $billing['email'];
                $customer->user_email = $billing['email'];
                $customer->user_pass = md5(uniqid());
                $customer->user_status = 0;

                if (!$customer->create()){
                    $messs = $customer->getMessages();
                    foreach ($messs as $m) {
                        $this->flashSession->error($m->getMessage());
                    }
                }
            } else {
                $customer = User::findFirst("ID = '{$customerMeta->user_id}'");
            }
        }

        $order = new Orders();

        $order->total_price = 0;
        $order->total_qty = 0;
        $order->customer_id = $customer->ID;
        $order->customer_email = $customer->user_email;
        $order->customer_phone = $billing['phone'];
        $order->customer_name = $billing['name'];
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
                        if ($total > 0) {
                            $order->total_price += $total;
                        }

                        $orderItem = new OrdersItem();
                        $orderItem->order_id = $order->order_id;
                        $orderItem->customer_id = $customer->ID;
                        $orderItem->saler_id = $this->userCurrent->ID;
                        $orderItem->product_id = 0;
                        $orderItem->product_name = $product['name'];
                        $orderItem->product_price = $product['price'];
                        $orderItem->product_qty = $product['qty'];
                        $orderItem->product_sku = '';

                        $orderItem->create();
                    }

                    $order->total_qty = count($orderRequest['itemsline']);
                }

                if (count($orderRequest['fee']) > 0) {
                    foreach ($orderRequest['fee'] as $fee) {
                        if ($fee['value'] > 0) {
                            $order->total_price += $fee['value'];
                        }
                    }

                    $order->create_meta('fee_plus', $orderRequest['fee']);
                }
            }

            if ($orderRequest['discount'] > 0) {
                $order->total_price -= $orderRequest['discount'];

                if (!empty($orderRequest['discount_note'])) {
                    $order->create_meta('discount_note', $orderRequest['discount_note']);
                }
            }

            if (count($shipping) > 0) {
                $order->create_meta('order_shipping', $shipping);
            }

            $customer->addAdress(array(
                'name' => $billing['address'] . ' tạo từ đơn hàng #' . $order->order_id,
                'address' => $billing['address'],
                'phone' => $billing['phone'],
                'email' => $billing['email']
            ));

            $order->update();
        }

//        parent::outputJSON([
//            $billing,
//            $shipping,
//            $orderRequest
//        ]);

    }
}

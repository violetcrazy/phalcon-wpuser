<?php
namespace Plugins;


use Common\Util;
use Common\Constant;
use Core\Model\Options;
use Orders\Model\Orders;

class Kiotviet
{
	const RETAILER = 'nghiathaibinhduong';
    const branchName = "WEB";
    const branchId = 80160;
    const retailerId = 102026;
    const clientID = "c66e109b-e5f3-4188-9f1c-535f6ab7c7aa";
    const secret = "A066282DCC85E3A287DD6A8DF85F325B32A0E80F";

    public static $status = array(
        1 => 'Phiếu tạm',   
        3 => 'Đang giao hàng',   
        3 => 'Hoàn thành',   
        4 => 'Đã hủy',   
    );

    public static function checkToken()
    {
        $token = Options::getOption('kiotviet_token');
        $expires = (int)Options::getOption('kiotviet_expires');

        $time = time();

        if (($time + 3600 > $expires) || empty($token)){

            $url = "https://id.kiotviet.vn/connect/token";
            $post = array(
                "scopes" => "PublicApi.Access",
                "grant_type" => "client_credentials",
                "client_id" => self::clientID,
                "client_secret" => self::secret
            );

            $_res = Util::curlPost($url, $post);

            $res = json_decode($_res, true);
            if (isset($res['access_token'])) {
                $token = $res['token_type'] . ' ' . $res['access_token'];
                
                Options::saveOption('kiotviet_token',  $token);
                Options::saveOption('kiotviet_expires', time() + $res['expires_in']);
            } else {
                Util::sendTele('Tạo token lỗi: ' . $_res);
            }
        }

        return $token;
    }

    public static function createOrder($orderId)
    {

        if ($orderId <= 0) return false;

        $orderDetail = Orders::findFirst("order_id = '{$orderId}'");
        if (!$orderDetail) return false;

        switch ($orderDetail->status) {
            case Constant::ORDER_STATUS_DEFAULT:
            case Constant::ORDER_STATUS_KIOTVIETTRANS:
                $status = 1;
                break;
            case Constant::ORDER_STATUS_COMPLETE:
                $status = 3;
                break;
            case Constant::ORDER_STATUS_CANCEL:
                $status = 4;
                break;
            case Constant::ORDER_STATUS_PROCESSING:
                $status = 1;
                break;
            case Constant::ORDER_STATUS_SHIPPING:
                $status = 2;
                break;
            default:
                $status = 1;
                break;
        }

        $dataOrder = array(
 	       "branchId" => self::branchId,
           "retailerId" => self::retailerId,

 	       "total" => 0,
 	       "status" => (int)$status,
 	       
 	       "description" => "Đơn hàng từ hệ thống WOO",

           "discount" => (int)$orderDetail->get_meta('discount'),
 	       "orderDetails" => array()
        );

        $url = "https://public.kiotapi.com/orders";
        $optionsCurl = array();
        $idKiotviet = (int)$orderDetail->get_meta('kiotviet_id');
        if ($idKiotviet > 0) {
            $dataOrder['id'] = $idKiotviet;
            $optionsCurl['custom_method'] = 'PUT';
            $url .= "/{$idKiotviet}";
        }

        $items = $orderDetail->getItems();
        if (count($items)) {
            foreach ($items as $key => $value) {
                $dataOrder["orderDetails"][] = array(
                    "productCode" => $value['sku'],
                    "productName" => $value['name'],
                    "quantity" => (int)$value['qty'],
                    "price" => (int)$value['price'],
                );

                $dataOrder['total'] += (int)($value['qty'] * $value['price']);
            }
        }

        $dataOrder["customer"] = array(
            "name" => $orderDetail->getBilling('name'),
            "contactNumber" => $orderDetail->getBilling('phone'),
            "address" => $orderDetail->getBilling('address'),
            "email" => $orderDetail->getBilling('email'),
        );

        // echo $url; 
        // echo 45; echo '<br>';
        // echo json_encode($dataOrder); die;
        
 	    $res = self::curlPost($url, $dataOrder, $optionsCurl);
        Util::sendTele($idKiotviet . '__' . $res);

        if (!empty($res)) {
            $res = json_decode($res, true);
            if (isset($res['id'])) {
                $orderDetail->update_meta('kiotviet_id', (int)$res['id']);
            }
        }

        return true;
    }

    public static function curlPost($url, $post = array(), $options = array())
    {
		$token = self::checkToken();
		if (empty($token )) {
		    Util::sendTele('Token lỗi');
		    return '';
        }

        $url = trim($url);
        if (is_array($post) && count($post)) {
            $data = json_encode($post);
        } else {
            $data = $post;
        }

        $ch = curl_init();

        $headers = [
            "Content-Type:application/json",
            "Retailer:" . self::RETAILER,
            "Authorization:" . $token,
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // echo $data; die;
        // var_dump($headers);
        // die;

        $defaults = array(
            CURLOPT_POST => true,
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HEADER => false,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FORBID_REUSE => true,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        );

        if (isset($options['custom_method']) && $options['custom_method'] == 'PUT') {
            unset($defaults[CURLOPT_POST]);
            $defaults[CURLOPT_CUSTOMREQUEST] = "PUT";
        }
        unset($options['custom_method']);

        
        curl_setopt_array($ch, ($options + $defaults));

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

} 
<?php
namespace Plugins;


use Common\Util;
use Orders\Model\Orders;

class Kiotviet
{
	const TOKEN = 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYmYiOjE1MjI4MzI4MjgsImV4cCI6MTUyMjkxOTIyOCwiaXNzIjoiaHR0cDovL2lkLmtpb3R2aWV0LnZuIiwiYXVkIjpbImh0dHA6Ly9pZC5raW90dmlldC52bi9yZXNvdXJjZXMiLCJLaW90VmlldC5BcGkuUHVibGljIl0sImNsaWVudF9pZCI6IjM0ZDMzMTIzLTM4ZDctNGZmNC04YTBmLTg3MjQyYTgyOTA3OCIsImNsaWVudF9SZXRhaWxlckNvZGUiOiJuZ2hpYXRoYWliaW5oZHVvbmciLCJjbGllbnRfUmV0YWlsZXJJZCI6IjEwMjAyNiIsImNsaWVudF9Vc2VySWQiOiIxMTcyOCIsInNjb3BlIjpbIlB1YmxpY0FwaS5BY2Nlc3MiXX0.yl2FW9OltQzThS8TTqWzW4yKaM1E3KyMZBPJPYRm6H8SSPn0DfuYHttcfspvnZsSnm3aO9wy2OoMi8qth0xtwAouZV3cWXA7mINsVnlqF33NFGJh_Ipi7hadfcR_MH1xkJ9MgJ9SBm-Tvy_nbriBml3K970gLdyz7-IIHIvlDDSXh4BrBaqpUsCf2Jtx_2iSeblO1Br22Avu9En7lyLvUKk2wEBMVBFiv-4ph-ZCoE9U1W5spfaalIgeA2UUdNiYo1BM_Cz6wyCJrDOMCr6CRIoN5EdMQCs51szvXG6malLodxtooRo5__yU5kUOjH5kna7R8U6vNtsCmaPnf_8PVw';

	const RETAILER = 'nghiathaibinhduong';

    const branchName = "WEB";
    const branchId = 80160;
    const retailerId = '102026';

    public static $status = array(
        1 => 'Phiếu tạm',   
        3 => 'Hoàn thành',   
        4 => 'Đã hủy',   
    );


    public static function createOrder($orderId)
    {

        if ($orderId <= 0) return false;

        $orderDetail = Orders::findFirst("order_id = '{$orderId}'");
        if (!$orderDetail) return false;

        $dataOrder = array(
 	       "branchId" => self::branchId,
           "retailerId" => self::retailerId,

 	       "total" => 0,
 	       "totalPayment" => 0,
 	       "status" => 1,
 	       
 	       "usingCod" => false,
 	       "description" => "Đơn hàng từ hệ thôngs WOO",

           "discount" => $orderDetail->get_meta('discount'),
 	       "orderDetails" => array()
        );

        $items = $orderDetail->getItems();
        if (count($items)) {
            foreach ($items as $key => $value) {
                $dataOrder["orderDetails"][] = array(
                    "productCode" => $value['product_sku'],
                    "productName" => $value['product_name'],
                    "quantity" => $value['product_qty'],
                    "price" => $value['product_price'],
                );

                $dataOrder['total'] += $value['product_qty'] * $value['product_price'];
            }
        }

        $dataOrder['totalPayment'] = $dataOrder['total'];

        $dataOrder['“customer'] = array(
            "name" => $orderDetail->getBilling('name'),
            "contactNumber" => $orderDetail->getBilling('phone'),
            "address" => $orderDetail->getBilling('address'),
            "email" => $orderDetail->getBilling('email'),
        );

 	    $res = self::curlPost('https://public.kiotapi.com/orders', $dataOrder);
        Util::sendTele($res);


        return true;
    }

    public static function curlPost($url, $post = array(), $options = array())
    {
		$url = trim($url);
        if (is_array($post) && count($post)) {
            $data = http_build_query($post);
        } else {
            $data = $post;
        }

        $ch = curl_init();

        $headers = [
            "Content-Type:application/json",
            "Retailer:" . self::RETAILER,
            "Authorization:Bearer " . self::TOKEN
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


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

        
        curl_setopt_array($ch, ($options + $defaults));

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

} 
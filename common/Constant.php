<?php

namespace Common;

class Constant {
    const ORDER_STATUS_DEFAULT = 'new_order';
    const ORDER_STATUS_COMPLETE = 'complete';
    const ORDER_STATUS_CANCEL = 'cancel';
    const ORDER_STATUS_PROCESSING = 'info';
    const LIMIT_LISTING = 5;

    const ORDER_NOTE_TYPE_SHARE = 1;
    const ORDER_NOTE_TYPE_PRIVATE = 2;
    const ORDER_NOTE_TYPE_SYSTEM = 3;

    const DATE_FORMAT = 'H:i d/m/Y';

    public static function getStatus($key = '', $onlyLabel = false){
        $status = array(
            self::ORDER_STATUS_DEFAULT => array(
                'label' => 'Đơn hàng mới',
                'class' => 'm-badge m-badge--wide m-badge--danger',
                'color' => 'danger'
            ),
            self::ORDER_STATUS_PROCESSING => array(
                'label' => 'Đang xử lý',
                'class' => 'm-badge m-badge--wide m-badge--info',
                'color' => 'info'
            ),
            'shipping' => array(
                'label' => 'Vận chuyển',
                'class' => 'm-badge m-badge--wide m-badge--warning',
                'color' => 'warning'
            ),
            self::ORDER_STATUS_COMPLETE => array(
                'label' => 'Hoàn thành',
                'class' => 'm-badge m-badge--wide m-badge--success',
                'color' => 'success'
            ),
            self::ORDER_STATUS_CANCEL => array(
                'label' => 'Đã hủy',
                'class' => 'm-badge m-badge--wide m-badge--primary',
                'color' => 'primary'
            ),
            'delete' => array(
                'label' => 'Đã xóa',
                'class' => 'm-badge m-badge--wide m-badge--secondary',
                'color' => 'secondary'
            ),
        );

        if ($key == '') {
            return $status;
        } elseif (isset($status[$key])) {
            if($onlyLabel) {
                return $status[$key]['label'];
            } else {
                return $status[$key];
            }

        } else {
            return array();
        }
    }
}
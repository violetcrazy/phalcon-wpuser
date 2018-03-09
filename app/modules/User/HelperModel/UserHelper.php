<?php
namespace User\HelperModel;

use User\Model\UserMeta;
use User\Model\User as UserModel;

class UserHelper {
    public static function getUserByPhoneEmail($phone, $email)
    {
        $customer = false;
        if (empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $customer = UserModel::findFirst("user_email = '{$email}'");
        }

        if (!$customer) {
            $customerMeta = UserMeta::findFirst(array(
                'conditions' => '(meta_key = :key_phone: AND meta_value = :phone_value:) OR (meta_key = :key_email: AND meta_value = :email_value:)',
                'bind' => array(
                    'key_phone' => 'billing_phone',
                    'phone_value' => $phone,
                    'key_email' => 'billing_email',
                    'email_value' => $email,
                )
            ));

            if (!$customerMeta) {
                $customer = false;
            } else {
                $customer = UserModel::findFirst("ID = '{$customerMeta->user_id}'");
            }
        }

        return $customer;
    }
}
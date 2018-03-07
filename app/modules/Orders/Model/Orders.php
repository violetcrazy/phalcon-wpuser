<?php
namespace Orders\Model;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model;

class Orders extends Model
{

    public $order_id;
    public $total_price;
    public $total_qty;

    public $customer_id;
    public $customer_email;
    public $customer_name;
    public $customer_phone;

    public $created_at;
    public $updated_at;
    public $updated_by;
    public $created_by;
    public $completed_at;
    public $status;

    public $user_aff_id;
    public $user_aff_email;

    public function initialize()
    {
        $this->useDynamicUpdate(true);
        $this->setSource('crm_orders');
    }

    public function create_meta($key, $meta)
    {
        $orderMeta = new OrdersMeta();
        $orderMeta->meta_key = $key;
        $orderMeta->meta_value = $meta;
        $orderMeta->order_id = $this->order_id;

        if (is_array($orderMeta->meta_value)) {
            $orderMeta->meta_value = serialize($orderMeta->meta_value);
        }

        $orderMeta->create();
    }

    public function beforeValidationOnCreate()
    {
        $currentTime = time();

        $this->updated_at = $currentTime;
        $this->created_at = $currentTime;

        if ($this->user_aff_email == '') {
            $this->user_aff_email = 'not set';
        }
        if ($this->user_aff_id == '') {
            $this->user_aff_id = 0;
        }
        if ($this->completed_at == '') {
            $this->completed_at = 0;
        }
    }

    public function beforeUpdate()
    {

    }
}

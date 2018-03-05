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
    public $user_aff_id;
    public $updated_at;
    public $updated_by;
    public $created_by;
    public $completed_at;
    public $status;
    public $user_aff_email;
    public $customer_email;
    public $customer_name;
    public $customer_phone;

    public function initialize()
    {
        $this->setSource('crm_orders');
    }
}

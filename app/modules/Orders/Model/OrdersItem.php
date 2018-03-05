<?php
namespace Orders\Model;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model;

class Orders extends Model
{

    public $item_id;
    public $order_id;
    public $product_id;
    public $product_name;
    public $product_sku;
    public $product_price;
    public $product_qty;
    public $product_discount;
    public $product_note;

    public function initialize()
    {
        $this->setSource('crm_orders_item');
    }
}

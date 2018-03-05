<?php
namespace Orders\Model;

use Phalcon\Mvc\Model;

class OrdersNote extends Model
{
    public $order_note_id;
    public $user_id;
    public $order_id;
    public $content;
    public $created_at;
    public $created_by;

    public function initialize()
    {
        $this->setSource('crm_order_note');
    }
}

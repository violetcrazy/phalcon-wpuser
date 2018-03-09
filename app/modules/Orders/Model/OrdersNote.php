<?php
namespace Orders\Model;

use Common\Constant;
use Phalcon\Mvc\Model;
use User\Model\User;

class OrdersNote extends Model
{
    public $order_note_id;
    public $type;
    public $order_id;
    public $content;
    public $created_at;
    public $created_by;

    public function initialize()
    {
        $this->setSource('crm_order_note');
    }

    public function getSchemaApi()
    {
        $user = User::findFirst("ID = '{$this->created_by}'");

        $args = array(
            'user_id' => $this->created_by,
            'user_name' => $user->getName(),
            'user_avatar_url' => $user->getAvatar(),
            'note_content' => $this->content,
            'note_created_at' => date(Constant::DATE_FORMAT, $this->created_at),
            'type' => $this->type
        );

        return $args;
    }
}

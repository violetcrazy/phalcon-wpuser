<?php
namespace User\Model;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model;

class User extends Model
{
    public $ID;
    public $user_login;
    public $user_pass;
    public $user_nicename;
    public $user_email;
    public $user_url;
    public $user_registered;
    public $user_activation_key;
    public $user_status;
    public $display_name;
    public $metas;

    public function initialize()
    {
        $this->setSource('wp_users');
    }


    public function getPublicInfo()
    {
        $output = array(
            'ID' => $this->ID,
            'user_login' => $this->user_login,
            'user_nicename' => $this->user_nicename,
            'user_email' => $this->user_email,
            'user_url' => $this->user_url,
            'user_registered' => $this->user_registered,
            'user_activation_key' => $this->user_activation_key,
            'user_status' => $this->user_status,
            'display_name  ' => $this->display_name,
            'meta' => $this->getMeta()
        );

        return $output;
    }

    public function getMeta($key = '')
    {
        $output = array();

        if (empty($this->metas)) {
            $metas = UserMeta::find(array(
                'conditions' => 'user_id = :user_id:',
                'bind' => array(
                    'user_id' => $this->ID
                )
            ));

            foreach ($metas as $key => $meta) {
                $valueArray = @unserialize($meta->meta_value);
                if (!$valueArray) {
                    $this->metas[$meta->meta_key][] = $meta->meta_value;
                } else {
                    $this->metas[$meta->meta_key][] = $valueArray;
                }
            }
        }

        if (!empty(trim($key))) {
            if (isset($this->metas[$key][0])) {
                return $this->metas[$key][0];
            } else {
                return false;
            }
        } else {
            return $this->metas;
        }
    }

    public function getName()
    {
        if (!empty($this->display_name)) {
            return $this->display_name;
        } else {
            return $this->user_nicename;
        }
    }

    public function getAvatar()
    {
        if ($this->getMeta('avatar')) {
            return $this->getMeta('avatar');
        } else {
            $email = trim( $this->user_email );
            return "https://www.gravatar.com/avatar/{$email}";
        }
    }
}

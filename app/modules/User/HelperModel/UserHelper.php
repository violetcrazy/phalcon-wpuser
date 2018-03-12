<?php
namespace User\HelperModel;

use Common\Constant;
use Phalcon\Paginator\Adapter\QueryBuilder;
use User\Model\User;
use User\Model\UserMeta;
use User\Model\User as UserModel;

class UserHelper extends User {
    public function getUsersPagination($args)
    {
        $page = isset($args['page']) && $args['page'] > 1 ? $args['page'] : 1;

        $b = $this->getModelsManager()->createBuilder();
        $b->columns(array(
            "ID",
            "user_login",
            "user_nicename",
            "user_email",
            "user_url",
            "user_registered",
            "user_activation_key",
            "user_status",
            "display_name",
            "user_phone",
            "user_address"
        ));


        $b->from(array('u'=> 'User\Model\User'));

        $search = isset($args['search']) ? $args['search']  : false;
        if (is_array($search)) {
            $query = array();
            foreach ($search['fields'] as $field) {
                $query[] = "({$field} LIKE '%{$search['key']}%')";
            }
            $b->andWhere("(" . implode(' OR ', $query) . ")");
        }


        if (isset($args['user_phone']) && !empty($args['user_phone'])) {
            $b->andWhere("u.user_phone LIKE '%{$args['user_phone']}%' ");
        }

        if (isset($args['meta']) && count($args['meta']) > 0) {

            $b->leftJoin('User\Model\UserMeta', 'u.ID = um.user_id', 'um');

            if (isset($args['meta']['role'])) {
                if (is_array($args['meta']['role'])) {
                    $role = $args['meta']['role'];
                } else {
                    $role = array($args['meta']['role']);
                }
                $role = implode(',', $role);

                $b->andWhere(
                "(um.meta_key = 'role' AND um.meta_value = '') OR (um.meta_key = 'role' AND um.meta_value IN ('{$role}'))"
                );
            }
        }


        $b->orderBy('u.ID DESC');

        $paginator = new QueryBuilder(array(
            'builder' => $b,
            'page' => $page,
            'limit' => Constant::LIMIT_LISTING
        ));

        return $paginator->getPaginate();
    }
}
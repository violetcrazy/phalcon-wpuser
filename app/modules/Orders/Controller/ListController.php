<?php

namespace Orders\Controller;

use Common\Constant;
use Core\Controller\BaseController;
use Orders\Model\Orders;
use Phalcon\Paginator\Adapter\QueryBuilder;


class ListController extends BaseController {


    public function indexAction()
    {
        $page = $this->request->getQuery('page', array('int'), 1);
        $status = $this->request->getQuery('status', array('striptags', 'trim'), '');
        $order_id = $this->request->getQuery('order_id', array('striptags', 'trim'), '');
        $sort = $this->request->getQuery('sort', array('striptags', 'trim'), '');

        $date_range = $this->request->getQuery('date_range', array('striptags', 'trim'), '');
        switch ($date_range) {
            case 'now':
                $dateTime = strtotime(date('Y/m/d'));
                break;
            case 'star_week':
                $dateTime = strtotime(date('Y/m/d', strtotime('Monday this week')));
                break;
            case 'star_month':
                $dateTime =strtotime(date('Y/m/d', strtotime('first day of this month')));
                break;
            case '7dayago':
                $dateTime =strtotime(date('Y/m/d', strtotime('7 day ago')));
                break;
            case '15dayago':
                $dateTime =strtotime(date('Y/m/d', strtotime('15 day ago')));
                break;
            case '30dayago':
                $dateTime =strtotime(date('Y/m/d', strtotime('30 day ago')));
                break;

            default;
                $dateTime = 0;
                break;
        }

        $orderM = new Orders();
        $b = $orderM->getModelsManager()->createBuilder();
        $b->columns('*');
        $b->from(array('o'=> 'Orders\Model\Orders'));

        if ( !empty($order_id)) {
            $b->andWhere("o.order_id LIKE '{$order_id}%'");
        }
        if ( !empty($status)) {
            $b->andWhere("o.status = '{$status}'");
        }

        if ($dateTime > 0) {
            $b->andWhere("o.created_at >= '{$dateTime}'");
        }

        if ($sort == 'create') {
            $b->orderBy('o.created_at DESC');
        } else {
            $b->orderBy('o.updated_at DESC');
        }

        $paginator = new QueryBuilder(array(
            'builder' => $b,
            'page' => $page,
            'limit' => Constant::LIMIT_LISTING
        ));

        $this->view->result = $paginator->getPaginate();

        $this->view->pick('orders/listing');
    }
}
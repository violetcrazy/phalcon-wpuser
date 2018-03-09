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

        $orderM = new Orders();
        $b = $orderM->getModelsManager()->createBuilder();
        $b->columns('*');
        $b->from(array('o'=> 'Orders\Model\Orders'));
        $b->orderBy('o.created_at DESC');

        $paginator = new QueryBuilder(array(
            'builder' => $b,
            'page' => $page,
            'limit' => Constant::LIMIT_LISTING
        ));

        $this->view->result = $paginator->getPaginate();

        $this->view->pick('orders/listing');
    }
}
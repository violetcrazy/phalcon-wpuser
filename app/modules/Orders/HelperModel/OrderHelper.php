<?php
 
namespace Orders\HelpderModel;

use Orders\Model\Orders;
use Phalcon\Paginator\Adapter\QueryBuilder;

class OrderHelper extends Orders {
    public function getListPagination($params)
    {
        $b = $this->getModelsManager()->createBuilder();
        $b->from(array(
            'order' => "\\Orders\\Model\\Orders"
        ));

        if (isset($params['customer_id']) && $params['customer_id'] > 0) {
            $b->andWhere("customer_id = '{$params['customer_id']}'");
        }

        $order = 'order.order_id';
        if (isset($params['order']['field']) && !empty($params['order']['field'])) {
            $order = "order." . $params['order']['field'];
        }

        if (isset($params['order']['type']) && !empty($params['order']['type'])) {
            $order = $params['order']['type'];
        } else {
            $order .= " DESC";
        }

        $b->orderBy($order);

        $paginator = new QueryBuilder(array(
            'builder' => $b,
            'page' => abs($params['page']) > 0 ? abs($params['page']) : 1,
            'limit' => abs($params['limit']) > 0 ? abs($params['limit']) : 20
        ));

        return $paginator->getPaginate();

    }
}
<?php

namespace Orders;


class Routes
{

    public function init($router)
    {

        $router->add('/don-hang', array(
            'module' => 'orders',
            'controller' => 'index',
            'action' => 'index',
            'auth' => true,
            'parent' => 0,
            'show_in_menu' => 1,
            'title_menu' => 'Đơn hàng',
            'icon_menu' => 'flaticon-line-graph'
        ))->setName('order_index');
        
        $router->add('/tao-don-hang', array(
            'module' => 'orders',
            'controller' => 'index',
            'action' => 'add',
            'auth' => true,
            'parent' => 'order_index',
            'show_in_menu' => 1,
            'title_menu' => 'Tạo đơn hàng mới',
            'icon_menu' => 'flaticon-user-settings'
        ))->setName('order_add');

        return $router;

    }

}
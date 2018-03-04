<?php

namespace User;


class Routes
{

    public function init($router)
    {

        $router->add('/', array(
            'module' => 'user',
            'controller' => 'index',
            'action' => ''
        ))->setName('user_index');
        
        $router->add('/thoat', array(
            'module' => 'user',
            'controller' => 'auth',
            'action' => 'logout'
        ))->setName('auth_logout');

        $router->add('/dang-nhap', array(
            'module' => 'user',
            'controller' => 'auth',
            'action' => 'login'
        ))->setName('auth_login');

        return $router;

    }

}
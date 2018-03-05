<?php

namespace User;


class Routes
{

    public function init($router)
    {

        $router->add('/', array(
            'module' => 'user',
            'controller' => 'index',
            'action' => 'index',
            'auth' => true,
            'parent' => 0,
            'show_in_menu' => 1,
            'title_menu' => 'Trang chủ',
            'icon_menu' => 'flaticon-line-graph'
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

        $router->add('/quan-ly-tai-khoan', array(
            'module' => 'user',
            'controller' => 'index',
            'action' => 'profile',
            'auth' => true,
            'parent' => 0,
            'show_in_menu' => 1,
            'title_menu' => 'Tài khoản',
            'icon_menu' => 'flaticon-user-settings'
        ))->setName('user_profile');

        $router->add('/them-thanh-vien', array(
            'module' => 'user',
            'controller' => 'manager',
            'action' => 'add',
            'auth' => true,
            'parent' => 'user_profile',
            'show_in_menu' => 1,
            'title_menu' => 'Thêm thành viên',
            'icon_menu' => 'flaticon-user-add'
        ))->setName('user_add');

        return $router;

    }

}
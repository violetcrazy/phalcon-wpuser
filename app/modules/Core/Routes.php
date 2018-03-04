<?php

namespace Core;


class Routes
{

    public function init($router)
    {

        $router->notFound(array(
            'module'        => 'core',
            'controller'    => 'error',
            'action'        => 'error404',
            'params' => 'Url không hợp lệ'
        ));

        return $router;

    }

}
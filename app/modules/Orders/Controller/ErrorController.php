<?php

namespace Orders\Controller;

use Core\Controller\BaseController;

class ErrorController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function Error404Action($e)
    {
        echo $e;
        echo __FUNCTION__ . __CLASS__; die;
    }
    public function ErrorAction($e)
    {
        echo $e->getMessage();
        echo __FUNCTION__ . __CLASS__; die;
    }
}

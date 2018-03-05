<?php

namespace Orders\Controller;

use \Core\Controller\BaseController;

class IndexController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $this->view->pick('orders/listing');
    }

    public function addAction()
    {
        $this->view->pick('orders/add');
    }
}

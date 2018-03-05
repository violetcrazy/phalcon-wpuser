<?php

namespace User\Controller;

use \User\Model\Orders;
use \Core\Controller\BaseController;

class ManagerController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function addAction()
    {
        $this->view->pick('user/index');
    }

    public function editAction()
    {
        $this->view->pick('user/index');
    }
}

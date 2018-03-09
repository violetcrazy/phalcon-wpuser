<?php

namespace User\Controller;

use \User\Model\Orders;
use \Core\Controller\BaseController;

class IndexController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $this->view->pick('user/index');
    }

    public function profileAction()
    {
        $this->view->pick('user/profile');
    }
}

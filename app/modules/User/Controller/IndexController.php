<?php

namespace User\Controller;

use \User\Model\User;
use \Core\Controller\BaseController;

class IndexController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
        parent::checkAuth();
    }

    public function indexAction()
    {
        $this->view->pick('user/index');
    }
}

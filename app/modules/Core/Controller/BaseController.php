<?php

namespace Core\Controller;

use Phalcon\Exception;
use \Phalcon\Mvc\Controller;

class BaseController extends Controller
{

    public function initialize()
    {

    }

    public function checkAuth()
    {
        if (empty($this->session->get('AUTH'))){

            $redirectUrl[] = 2;
            $redirectUrl[] = $this->router->getRewriteUri();
            $redirectUrl[] = $this->request->getURI();
            $redirectUrl[] = $this->url->getBaseUri();

//            $this->outputJSON($redirectUrl);

            $this->response->redirect(array(
                'for' => 'auth_login'
            ));
        } else{

        }
    }

    public function outputJSON($response)
    {
        $this->view->disable();
        $this->response->setContentType('application/json', 'UTF-8');
        $this->response->setJsonContent($response);
        $this->response->send();
        exit;
    }
}
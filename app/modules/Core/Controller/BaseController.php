<?php

namespace Core\Controller;

use Phalcon\Exception;
use \Phalcon\Mvc\Controller;
use User\Model\User;

class BaseController extends Controller
{
    public $userCurrent = false;

    public function initialize()
    {

        $routers = $this->router->getRoutes();

        $menus = array();
        foreach ($routers as $router)  {
            $path = $router->getPaths();
            if (isset($path['show_in_menu']) && $path['show_in_menu'] == 1) {
                $path['url'] = $this->url->get(array(
                    'for' => $router->getName()
                ));
                $path['name'] = $router->getName();
                $menus[$path['parent']][] = $path;
            }

            if (!empty($this->router->getMatchedRoute())) {
                if ((isset($path['auth']) && $path['auth'] == 1) && $this->router->getMatchedRoute()->getName() == $router->getName()) {
                    $this->checkAuth();
                }
            }
        }
        $this->view->main_menu = $menus;
    }

    public function checkAuth()
    {
        if (!$this->session->has('AUTH') && !$this->cookies->has('AUTH')){

//            $redirectUrl[] = $this->router->getRewriteUri();
//            $redirectUrl[] = $this->request->getURI();
//            $redirectUrl[] = $this->url->getBaseUri();
//            $this->outputJSON($redirectUrl);

            $this->response->redirect(array(
                'for' => 'auth_login'
            ));
        } else{
            $auth = $this->session->get('AUTH');
            if (!$auth) {
                $auth = $this->cookies->get('AUTH');
                $auth = @unserialize($auth->getValue());
            }

            $userModel = User::findFirst(array(
                'conditions' => 'ID = :id:',
                'bind' => array(
                    'id' => $auth['ID']
                )
            ));
            $this->userCurrent = $userModel;
            $this->view->userCurrent = $userModel;
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
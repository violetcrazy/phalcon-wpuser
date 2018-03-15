<?php

namespace User\Controller;

use Common\Constant;
use Phalcon\Exception;
use User\Form\UserFrom;
use User\HelperModel\UserHelper;
use User\HelperModel\UserSetupData;
use Core\Controller\BaseController;
use User\Model\User;

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
        $id = $this->dispatcher->getParam('id', array('int'), 0);

        if ($id == 0) {
            $user = $this->userCurrent;
        } else {
            $user = User::findFirst("ID = {$id}");
            if (!$user) {
                throw new Exception("Không tìm thấy tài khoản {$id}");
            }
        }

        $form = new UserFrom($user);

        if ($this->request->isPost()){
            $form->bind($this->request->getPost(), $user);
            if(!$form->isValid()){
                $this->flashSession->error('Lỗi. Kiểm tra dữ liệu đã nhập');
            } else {
                if($user->save()) {
                    $this->flashSession->success('Cập nhật thành công thông tin người dùng.');

                    $role = $this->request->getPost('role');
                    if (is_array($role)) {
                        foreach ($role as $key => $r) {
                            if (empty(Constant::getUserLabel($r))){
                                unset($role[$key]);
                            } else {
                                $user->update_meta('role', $r);
                            }
                        }
                    }

                    $this->response->redirect(array(
                        'for' => 'user_profile_edit',
                        'id' => $user->ID
                    ));
                } else {
                    foreach ($user->getMessages() as $mess){
                        $this->flashSession->error($mess->getMessage());
                    }
                }
            }

        }

        $this->view->user = $user;
        $this->view->form = $form;

        $this->view->pick('user/profile');
    }

    public function listingAction()
    {
        
        $page = $this->request->getQuery('page', array('striptags', 'int'), 1);
        $UserHelper = new UserHelper();
        $users = $UserHelper->getUsersPagination(array(
            'page' => $page
        ));
        
        $outDebug = [];
        $setupData = new UserSetupData();
        foreach ($users->items as $user){
            $users->result[] = $setupData->setup_user_class($user);
            $outDebug[] = $setupData->setup_user_class($user)->toArray();
        }
        unset($users->items);

        $this->view->users = $users;

        $this->view->pick('user/listing');
    }
}

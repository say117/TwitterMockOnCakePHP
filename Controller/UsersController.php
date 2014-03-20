<?php
App::uses('Sanitize', 'Utility');

class UsersController extends AppController {
    public $components = array('Security');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
        $this->Security->csrfUseOnce = false;
        $this->Security->validatePost = false; //POSTを有効に
        $this->Security->csrfCheck = false; //AjaxのPOSTを有効
    }

    public function login() {
        if(!$this->request->isPost()) {
            return;
        }
        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            $this->Session->setFlash('Invalid username or password, try again');
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function add() {
        if (!$this->request->isPost()) {
            return;
        }
        //サニタイズ
        $this->request->data = Sanitize::clean($this->request->data, array('encode' => false));
        //icon保存
        $filePath = WWW_ROOT . 'icons/' . $this->request->data['User']['username'] . '.jpg';
        if (!move_uploaded_file($this->request->data['User']['icon']['tmp_name'], $filePath)){
            $this->Session->setFlash('The icon could not be saved. Please, try again.');
            return;
        }
        unset($this->request->data['User']['icon']);  //icon情報の削除
        //user情報の格納
        $this->User->create();
        if ($this->User->save($this->request->data)) {
            $this->Session->setFlash('The user has been saved');
            $this->redirect(array('controller' => 'bweets', 'action' => 'index'));
        } else {
            $this->Session->setFlash('The user could not be saved. Please, try again.');
        }
    }

    public function edit() {
        if (!$this->request->isPost()) {
            return;
        }
        //サニタイズ
        $this->request->data = Sanitize::clean($this->request->data, array('encode' => false));
        //icon上書き
        $filePath = WWW_ROOT . 'icons/' . $this->Auth->user()['username'] . '.jpg';
        if (move_uploaded_file($this->request->data['User']['icon']['tmp_name'], $filePath)){
            $this->Session->setFlash('The icon has been changed');
            $this->redirect(array('controller' => 'bweets', 'action' => 'index'));
        } else {
            $this->Session->setFlash('The icon could not be saved. Please, try again.');
        }
    }
}
<?php
App::uses('Sanitize', 'Utility');

class BweetsController extends AppController {
    public $components = array('Security');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
        $this->Security->csrfUseOnce = false;
        $this->Security->validatePost = false; //POSTを有効に
        $this->Security->csrfCheck = false; //AjaxのPOSTを有効
    }

    public function index() {
        $this->set('bweets', $this->Bweet->find('all', array('limit' => 10)));
        $this->Session->write('showNum', 10);  //初回アクセスの表示件数10件
    }

    public function add() {
        if(!$this->request->isPost()) {
            return;
        }
        //bweet格納
        $this->Bweet->create();
        $bweetData = array('description' => Sanitize::clean($this->request->data['description'], array('encode' => false)),
          'user_id' => $this->Auth->user()['id']);
        if ($this->Bweet->save($bweetData)) {
            $bweet = $this->set('bweet', $this->Bweet->find('first'));
            $this->Session->write('showNum', $this->Session->read('showNum') + 1);
            $this->layout = '';
            return $this->layout;
        }
    }

    public function moreShow() {
      $this->layout = '';
      //bweet取得
      $this->set('bweets', $this->Bweet->find('all',
        array('limit' => 10, 'offset' => $this->Session->read('showNum'))));
      //表示件数の加算
      $this->Session->write('showNum', $this->Session->read('showNum') + 10);
      return $this->layout;
    }
}
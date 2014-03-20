<?php

class BweetsController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }

    public function index() {
        $this->set('bweets', $this->Bweet->find('all'));
    }

    public function add() {
        if(!$this->request->isPost()) {
            return;
        }
        $this->Bweet->create();
        $this->request->data['Bweet']['user_id'] = $this->Auth->user()['id'];
        if ($this->Bweet->save($this->request->data)) {
            $this->Session->setFlash('The bweet has been posted' . $this->Bweet);
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('The bweet could not be posted. Please, try again.');
        }
    }
}
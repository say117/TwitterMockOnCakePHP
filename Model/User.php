<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $hasMany = 'Bweet';

    public $validate = array(
      'username' => array(
          array(
              'rule' => 'notEmpty',
              'message' => 'An username is required'
          ),
          array(
              'rule' => 'isUnique',
              'message' => 'An username already exist'
          )
      ),
      'password' => array(
          array(
              'rule' => 'notEmpty',
              'message' => 'A password is required'
          )
      ),
      'icon' => array(
          array(
              'rule' => 'notEmpty',
              'message' => 'An icon is required'
            )
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }
        return true;
    }
}
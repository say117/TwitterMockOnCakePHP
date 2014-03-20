<?php

class Bweet extends AppModel {
    public $belongsTo = 'User';

    public $validate = array(
      'description' => array(
          'required' => array(
              'rule' => array('notEmpty'),
              'message' => 'A description is required'
          )
      )
    );

    var $order = "Bweet.created desc";
}
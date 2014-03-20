<div id="side">
<?php
if ($user) {
  echo "<h2>User Data</h2>";
  echo $this->Html->image('/icons/'. $user['username'] .'.jpg', 
    array('alt' =>'icon', 'width' => 64, 'height' => 64));
  echo "<h3>" . $user['username'] . "</h3>";
  echo $this->Html->link('Sign out', '/users/logout') . "<br>";
  echo $this->Html->link('Edit', '/users/edit') . "<br>";
  echo $this->Html->link('New bweet', '/bweets/add') . "<br>";
} else {
  echo $this->Html->link('Sign up', '/users/add') . "<br>";
  echo $this->Html->link('Sign in', '/users/login') . "<br>";
}
?>
</div>
<div id="main">
<h2>Bweets List</h2>
<?php foreach ($bweets as $bweet) : ?>
  <fieldset>
    <legend>
      <?php 
            echo $this->Html->image('/icons/'. $bweet['User']['username'] .'.jpg', 
                array('alt' =>'icon', 'width' => 24, 'height' => 24));
            echo h($bweet['User']['username']); 
      ?>
    </legend>
    <p><?php echo h($bweet['Bweet']['description']); ?></p>
    <h6><?php echo h($bweet['Bweet']['created']); ?></h6>
  </fieldset>
  <hr>
<?php endforeach; ?>
</div>
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
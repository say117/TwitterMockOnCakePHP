<div class="bweets-form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('Bweet'); ?>
    <fieldset>
        <legend><?php echo 'Bweet'; ?></legend>
        <?php echo $this->Form->input('description');
        echo $this->Form->end('Bweet'); ?>
    </fieldset>
</div>
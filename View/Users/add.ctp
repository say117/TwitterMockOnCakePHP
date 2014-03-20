<div class="users-form">
<?php echo $this->Form->create('User', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password'); 
        echo $this->Form->label("icon");
        echo $this->Form->file('icon', array('label' => false, 'type' => 'file', 'multiple'));
?>
    </fieldset>
<?php echo $this->Form->end('Sign Up'); ?>
</div>
<div class="users-form">
<?php echo $this->Form->create('User', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo 'Change Icon'; ?></legend>
        <?php
        echo $this->Form->file('icon', array('label' => false, 'type' => 'file', 'multiple'));
        ?>
    </fieldset>
<?php echo $this->Form->end('Change Icon'); ?>
</div>
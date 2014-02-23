<?php echo $form->create(null, array('action' => 'index'));?>
<fieldset>
<legend>Enter Your Name</legend>
<?php echo $form->input('name'); ?>
</fieldset>
<?php echo $form->end('Go');?>
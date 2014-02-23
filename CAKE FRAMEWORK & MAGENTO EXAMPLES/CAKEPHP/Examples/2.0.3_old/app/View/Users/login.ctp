<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Please enter your username and password'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		
		echo "Hi you, <br>";
		echo "this is a simple Auth, account to login: <b>admin</b>, password: <b>admin</b>";
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Login'));?>
</div>
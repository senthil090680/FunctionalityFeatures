<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->element( 'admin/head' ); ?>
</head>
<body>
	<div id="wrapper">
		<br><br><br><br>

		<div id="contentUserLogin" class="form-stacked">
			<?php echo $this->Form->create('User', array('url' => $url_form, 'action' => 'login')); ?>
				<fieldset>
					<legend>Please enter your username and password</legend>
					<?php echo $this->Form->input('username'); ?><br>
					<?php echo $this->Form->input('password'); ?><br>
					<?php //echo $this->Form->input('remember_me', array('label' => 'Remember Me', 'type' => 'checkbox')); ?>
				</fieldset>
			<?php echo '<center>'.$this->Form->end( array( 'label' => 'Login', 'class' => 'btn primary' ) ).'</center>'; ?>
			<?php echo $this->Session->flash('auth'); ?>
		</div>

	</div>
	<script type="text/javascript">
		$(function() {
			$("#UserUsername").focus();
		});
	</script>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
	<title>Quick Wall</title>
	<?php e($javascript->link('prototype-1.6.0.2')); ?> 
	<?php e($javascript->link('scriptaculous')); ?>
	<?php e($scripts_for_layout); ?>
	<?php e($html->css('quickwall')); ?>
	<!--[if IE 6]>
		<?php e($html->css('quickwall_ie6hack')); ?>
	<![endif]-->
</head>
<body>
	<div id="content">
	
		<div id="user_menu">
			|<?php e($html->link('Home', array('controller' => 'questions', 'action' => 'home'))); ?>|
			<?php if($loggedIn): ?>
				<?php e($html->link('Search', array('controller' => 'questions', 'action' => 'search'))); ?>|
				<?php e($html->link('Logout', array('controller' => 'users', 'action' => 'logout'))); ?>|
			<?php else: ?>
				<?php e($html->link('Sign Up', array('controller' => 'users', 'action' => 'signup'))); ?>|
				<?php e($html->link('Login', array('controller' => 'users', 'action' => 'login'))); ?>|
			<?php endif; ?>
		</div>
		
		<?php e($html->image('loading.gif', array('id' => 'loader', 'style' => 'display:none'))); ?>
		
		<h1><?php e($html->link('Quickwall', array('controller' => 'questions', 'action' => 'home'))); ?></h1>
		<p id="strapline"><strong>“</strong>Quick way to Ask and Answer<strong>”</strong></p>
		
		<div id='js_errors' class='message' style='display:none'></div>
		
		<?php
		if ($session->check('Message.flash')):
			$session->flash();
		endif;
		?>

		<?php e($content_for_layout); ?>
		
		<div id="footer">
			<a href="http://www.cakephp.org/">
				<?php e($html->image('cake.power.gif')); ?>
			</a>
		</div>	
	</div>
</body>
</html>
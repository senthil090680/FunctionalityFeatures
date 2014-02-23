<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
	<title>Quick Wall</title> 
	<?php e($html->css('quickwall')); ?>
	<!--[if IE 6]>
		<?php e($html->css('quickwall_ie6hack')); ?>
	<![endif]-->
</head>
<body>
	<div id="content">
		<h1><?php e($html->link('Quickwall', array('controller' => 'questions', 'action' => 'home'))); ?></h1>
		<p id="strapline"><strong>“</strong>Quick way to Ask and Answer<strong>”</strong></p>
		
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
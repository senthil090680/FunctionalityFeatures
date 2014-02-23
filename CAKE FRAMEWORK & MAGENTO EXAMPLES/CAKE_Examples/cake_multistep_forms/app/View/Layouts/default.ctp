<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<style type="text/css" media="screen">
		a.button {
			font-weight:normal;
			padding: 8px 8px;
			background: #dcdcdc;
			background-image: -webkit-gradient(linear, left top, left bottom, from(#fefefe), to(#dcdcdc));
			background-image: -webkit-linear-gradient(top, #fefefe, #dcdcdc);
			background-image: -moz-linear-gradient(top, #fefefe, #dcdcdc);
			background-image: -ms-linear-gradient(top, #fefefe, #dcdcdc);
			background-image: -o-linear-gradient(top, #fefefe, #dcdcdc);
			background-image: linear-gradient(top, #fefefe, #dcdcdc);
			color:#333;
			border:1px solid #bbb;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			border-radius: 4px;
			text-decoration: none;
			text-shadow: #fff 0px 1px 0px;
			min-width: 0;
			-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3), 0px 1px 1px rgba(0, 0, 0, 0.2);
			-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3), 0px 1px 1px rgba(0, 0, 0, 0.2);
			box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3), 0px 1px 1px rgba(0, 0, 0, 0.2);
			-webkit-user-select: none;
			user-select: none;
			float: left;
		}
		.submit {
			float:left;
			clear:none !important;
			margin-top:0px !important;
			margin-left:10px;
			padding:0px !important;
		}
		.progress {
			margin-left: 30px;
		}
		.progress a {
			padding: 10px;
			display: block;
			float: left;
			margin-right: 10px;
			background-color: gray;
			text-decoration: none;
			color:white;
		}
		.progress a.normal {
			text-decoration: underline;
			background-color: #039BC1;
		}
		.progress a.active {
			text-decoration: none;
			background-color: white;
			color: black;
		}
	</style>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
		</div>
		<div class="progress">
			<?php
			for ($i=1; $i <= $params['steps']; $i++) {
				if ($i > $params['maxProgress'] + 1) {
					echo '<a>Step '.$i.'</a>';
				} else {
					$class = ($i == $params['currentStep']) ? 'active' : 'normal';
					echo $this->Html->link('Step '.$i, 
						array('action' => 'msf_step', $i), 
						array('class' => $class)
					);
				}
			}
			?>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>

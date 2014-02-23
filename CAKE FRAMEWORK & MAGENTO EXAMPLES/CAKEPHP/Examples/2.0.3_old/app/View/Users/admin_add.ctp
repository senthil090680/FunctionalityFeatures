<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Adminweb Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('status');
		echo $this->Form->input('avatar');
		echo $this->Form->input('email');
		echo $this->Form->input('newpasswd');
		echo $this->Form->input('realname');
		echo $this->Form->input('group_id', array('empty' => EMPTY_OPTIONS));
		echo $this->Form->input('birthday');
		echo $this->Form->input('tel');
		echo $this->Form->input('modifier');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index'));?></li>
	</ul>
</div>

<?php if($form->isFieldError('User.username')) e($form->error('User.username', null, array('class' => 'message'))); ?>
<?php if($form->isFieldError('User.password')) e($form->error('User.password', null, array('class' => 'message'))); ?> 
<?php if($form->isFieldError('User.email')) e($form->error('User.email', null, array('class' => 'message'))); ?> 

<h2>Sign Up for Quickwall</h2> 

<?php e($form->create('User', array('action' => 'signup')));?> 
	<fieldset> 
		<label for="UserUsername" class="usernamelabel"><span>Your Name</span></label> 
		<?php e($form->text('username', array('class' => 'fullwidth'))); ?> 
		<label for="UserEmail" class="emaillabel"><span>Your Email</span></label> 
		<?php e($form->text('email', array('class' => 'fullwidth'))); ?> 
		<label for="UserPassword" class="passwordlabel"><span>Password</span></label> 
		<?php e($form->password('password', array('class' => 'fullwidth'))); ?> 
		<label for="UserPasswordRepeat" class="passwordrepeatlabel"><span>Re Password</span></label> 
		<?php e($form->password('password2', array('class' => 'fullwidth'))); ?> 
		<?php e($form->submit('Sign Up', array('div' => false, 'class' => 'submitbutton'))); ?> 
	</fieldset> 
<?php e($form->end()); ?>
<?php e($javascript->link('search', false)); ?>
<?php e($ajax->link(
	'Show Your Questions', 
	array('controller' => 'questions', 'action' => 'user_questions', $loggedIn), 
	array('update' => 'questionList', 'loading' => "$('loader').show()", 'loaded' => "$('loader').hide()")
)); ?>|
<a href='javascript:;' id='showOthersQuestion'>Show Questions of Others</a>|
<form id='user_search_form'  style="display:none">
	<fieldset>
		<label for="UserUsername" class="questionlabel"><span>Username</span></label>
    	<?php echo $ajax->autoComplete('User.username', array('controller' => 'users', 'action' => 'show_usernames'), array('class' => 'fullwidth'))?>	
   		<?php echo $ajax->submit('Search', array('div' => false, 'class' => 'submitbutton', 'url' => array('controller' => 'questions', 'action' => 'user_questions'), 'update' => 'questionList', 'loading' => "$('loader').show()", 'loaded' => "$('loader').hide()")) ?>
    </fieldset>
</form>
<div id="questionList"></div>
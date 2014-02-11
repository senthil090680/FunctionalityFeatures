<?php e($javascript->link('home', false)); ?>

<?php  e($form->error('Question.question', null, array('class' => 'message'))); ?>

<?php if($loggedIn): ?>
	<?php e($form->create('Question', array('action' => 'home')));?>
		<fieldset>
			<label for="QuestionQuestion" class="questionlabel"><span>Your Question</span></label>
			<?php e($form->text('question', array('class' => 'fullwidth'))); ?><span class="big">?</span>
			<!-- Input for Questioner removed -->
			<?php e($form->submit('Post Your Question', array('div' => false, 'class' => 'submitbutton'))); ?>
		</fieldset>
	<?php e($form->end()); ?>
<?php else: ?>
	<p>To post a question, please login or signup.</p>
<?php endif; ?>

<?php if(empty($questions)): ?>
	<p class="no_answer">No Questions yet. Be the first one to post a Question!</p>
<?php else: ?>
	<?php e($this->renderElement('question_list')); ?>
<?php endif; ?>
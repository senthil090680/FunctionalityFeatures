<?php  e($form->error('Answer.answer', null, array('class' => 'message'))); ?>
<?php  e($form->error('Answer.answerer', null, array('class' => 'message'))); ?>

<h2><?php e($question['Question']['question']) ?>?</h2>
<div id="questioner"><div><span><?php e($question['Question']['questioner']) ?></span></div></div>

<?php e($form->create('Answer', array('url' => array('controller' => 'questions', 'action' => 'show', $question['Question']['id']))));?>
	<fieldset>
		<?php e($form->hidden('question_id', array('value' => $question['Question']['id']))); ?>
		<label for="AnswerAnswer" class="questionlabel"><span>Your Answer</span></label>
		<?php e($form->text('answer', array('class' => 'fullwidth'))); ?><span class="big">!</span>
		<label for="AnswerAnswerer" class="questionerlabel"><span>Your Name</span></label>
		<?php e($form->text('answerer', array('class' => 'halfwidth'))); ?>
		<?php e($form->submit('Post Your Answer', array('div' => false, 'class' => 'submitbutton'))); ?>
	</fieldset>
<?php e($form->end()); ?>

<?php if(empty($question['Answer'])): ?>
	<p class="no_answer">No Answers yet. Be the first one to answer!</p>
<?php else: ?>
	<dl>
	<?php foreach($question['Answer'] as $answer) : ?>
		<dt><span><?php e($answer['answerer']); ?></span></dt>
		<dd><?php e($answer['answer']); ?></dd>
	<?php endforeach; ?>
	</dl>
<?php endif; ?>
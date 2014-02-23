<?php  e($form->error('Answer.answer', null, array('class' => 'message'))); ?>

<h2><?php e($question['Question']['question']) ?>?</h2>
<div id="questioner"><div><span><?php e($question['User']['username']) ?></span></div></div>

<?php if($loggedIn): ?>
	<?php e($form->create('Answer', array('url' => array('controller' => 'questions', 'action' => 'show', $question['Question']['id']))));?>
		<fieldset>
			<?php e($form->hidden('question_id', array('value' => $question['Question']['id']))); ?>
			<label for="AnswerAnswer" class="questionlabel"><span>Your Answer</span></label>
			<?php e($form->text('answer', array('class' => 'fullwidth'))); ?><span class="big">!</span>
			<?php e($form->submit('Post Your Answer', array('div' => false, 'class' => 'submitbutton'))); ?>
		</fieldset>
	<?php e($form->end()); ?>
<?php else: ?>
	<p>To post an answer, please login or signup.</p>
<?php endif; ?>

<?php if(empty($question['Answer'])): ?>
	<p class="no_answer">No Answers yet. Be the first one to answer!</p>
<?php else: ?>
	<dl>
	<?php foreach($question['Answer'] as $answer) : ?>
		<dt><span><?php e($answer['User']['username']); ?></span></dt>
		<dd><span id='answer_<?php e($answer['id']) ?>'><?php e($answer['answer']); ?></span></dd>
		<?php if(!empty($loggedIn) && $answer['user_id'] == $loggedIn): ?>
			<?php e($ajax->editor('answer_'.$answer['id'], array('controller' => 'questions', 'action' => 'edit_answer', $answer['id']), array('callback' => "return 'data[Answer][answer]=' + escape(value)"))); ?>
		<?php endif; ?>
	<?php endforeach; ?>
	</dl>
<?php endif; ?>
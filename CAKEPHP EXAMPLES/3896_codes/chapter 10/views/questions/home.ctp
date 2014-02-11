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
	<dl>
	<?php foreach ($questions as $question): ?>	
		<dt><span><?php e($question['User']['username']); ?></span></dt>
		<dd>
			<?php e($html->link($question['Question']['question'].'?', array('controller' => 'questions', 'action' => 'show', $question['Question']['id']))); ?>
			<?php
				$answer_count = count($question['Answer']);
				if(!$answer_count)
					e("(no answers yet)");
				else if($answer_count == 1)
					e("(1 answer)");
				else 
					e("(".$answer_count." answers)");
			?>
		</dd>
	<?php endforeach; ?>
	</dl>
<?php endif; ?>
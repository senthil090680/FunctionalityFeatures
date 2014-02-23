<?php  e($form->error('Question.question', null, array('class' => 'message'))); ?>
<?php  e($form->error('Question.questioner', null, array('class' => 'message'))); ?>

<?php e($form->create('Question', array('action' => 'home')));?>
	<fieldset>
		<label for="QuestionQuestion" class="questionlabel"><span>Your Question</span></label>
		<?php e($form->text('question', array('class' => 'fullwidth'))); ?><span class="big">?</span>
		<label for="QuestionQuestioner" class="questionerlabel"><span>Your Name</span></label>
		<?php e($form->text('questioner', array('class' => 'halfwidth'))); ?>
		<?php e($form->submit('Post Your Question', array('div' => false, 'class' => 'submitbutton'))); ?>
	</fieldset>
<?php e($form->end()); ?>

<?php if(empty($questions)): ?>
	<p class="no_answer">No Questions yet. Be the first one to post a Question!</p>
<?php else: ?>
	<dl>
	<?php foreach ($questions as $question): ?>	
		<dt><span><?php e($question['Question']['questioner']); ?></span></dt>
		<dd>
			<?php e($html->link($question['Question']['question'].'?', array('action' => 'show', $question['Question']['id']))); ?>
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
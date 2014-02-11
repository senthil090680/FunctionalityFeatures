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
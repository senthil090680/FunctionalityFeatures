<?php if(isset($nouser)) : ?>
	<p class="no_answer">No such user found</p>
<?php else: ?>
	<?php if(empty($questions)): ?>
		<p class="no_answer">No question asked by this user.</p>
	<?php else: ?>
		<?php e($this->renderElement('question_list')); ?>
	<?php endif; ?>
<?php endif; ?>
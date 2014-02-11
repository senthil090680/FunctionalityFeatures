<ul>
<?php foreach($usernames as $username): ?>
	<li><?php e($username['User']['username']); ?></li>
<?php endforeach; ?>
</ul>
Hi <?php e($name); ?>,<br />
Thank you for signing up in Quickwall. To complete the sign up process please click on the link below:<br />
<a href="http://<?php e($server_name) ?><?php e($html->url(array('controller' => 'users', 'action' => 'confirm'))) ?>/<?php e($id) ?>/<?php e($code) ?>">Confirm your account</a>
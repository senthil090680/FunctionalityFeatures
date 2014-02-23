<h1>Welcome to CakeTooDoo</h1>
<p>CakeTooDoo is a simple but useful application to keep a record of all the things that you need to do. Using CakeTooDoo, you can:</p>
<ul>
   	<li><?php echo $html->link(''List all your tasks'', array(''controller'' => ''tasks'', ''action''=>''index'')); ?></li>
   	<li><?php echo $html->link(''List your completed tasks'', array(''controller'' => ''tasks'', ''action''=>''index'',/''done'')); ?></li>
   	<li><?php echo $html->link(''List your pending tasks'', array(''controller'' => ''tasks'', ''action''=>''index'', /''pending'')); ?></li>
   	<li><?php echo $html->link(''Add new Tasks'', array(''controller'' => ''tasks'', ''action''=>''add'')); ?></li>
   	<li>Edit tasks</li>
   	<li>Delete tasks</li>
</ul>
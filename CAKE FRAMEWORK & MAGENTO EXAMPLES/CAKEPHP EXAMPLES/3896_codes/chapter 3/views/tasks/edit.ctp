<?php echo $form->create(''Task'');?>
   	<fieldset>
      		<legend>Edit Task</legend>
      		<?php
         			echo $form->hidden(''id'');
         			echo $form->input(''title'');
         			echo $form->input(''done'');
      		?>
   	</fieldset>
<?php echo $form->end(''Save'');?>
<?php echo $html->link(''List All Tasks'', array(''action''=>''index'')); ?><br />
<?php echo $html->link(''Add Task'', array(''action''=>''add'')); ?>
<?php echo $html->link(''List Done Tasks'', array(''action''=>''index'', /''done'')); ?><br />
<?php echo $html->link(''List Pending Tasks'', array(''action''=>''index'', /''pending'')); ?><br />
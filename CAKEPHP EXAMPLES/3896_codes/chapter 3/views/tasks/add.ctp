<?php echo $form->create(''Task'');?>
   	<fieldset>
       		<legend>Add New Task</legend>
      		<?php
         			echo $form->input(''title'');
         			echo $form->input(''done'');
      		?>
   	</fieldset>
<?php echo $form->end(''Add Task'');?>
<?php 
echo $html->link(''List All Tasks'', array(''action''=>''index'')); ?>
<?php echo $html->link(''List Done Tasks'', array(''action''=>''index'', /''done'')); ?><br />
<?php echo $html->link(''List Pending Tasks'', array(''action''=>''index'', /''pending'')); ?><br />

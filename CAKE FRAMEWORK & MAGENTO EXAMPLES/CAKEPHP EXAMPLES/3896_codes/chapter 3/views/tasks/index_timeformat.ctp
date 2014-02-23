<h2>Tasks</h2>
<?php if(empty($tasks)): ?>
   	There are no tasks in this list
<?php else: ?>
   	<table>
      		<tr>
         			<th>Title</th>
         			<th>Status</th>
         			<th>Created</th>
         			<th>Modified</th>
         			<th>Actions</th>
      		</tr>
      		<?php foreach ($tasks as $task): ?>
         			<tr>
            				<td>
               					<?php echo $task[''Task''][''title''] ?>
            				</td>
            				<td>
               					<?php 
                  						if($task[''Task''][''done'']) echo ""Done""; 
                  						else echo ""Pending"";
               					?>
            				</td>
            				<td>
               					<?php echo $time->niceShort($task[''Task''][''created'']) ?>
            				</td>
            				<td>
               					<?php echo $time->niceShort($task[''Task''][''modified'']) ?>
            				</td>
            				<td>
               				 	<?php echo $html->link(''Edit'', array(''action''=>''edit'', $task[''Task''][''id''])); ?>  
						<?php echo $html->link(''Delete'', array(''action''=>''delete'', $task[''Task''][''id'']), null, ''Are you sure you want to delete this task?''); ?>           			
					</td>
         			</tr>
      		<?php endforeach; ?>
   	</table>
<?php endif; ?>
<?php echo $html->link(''Add Task'', array(''action''=>''add'')); ?>
<?php if($status): ?>
   	<?php echo $html->link(''List All Tasks'', array(''action''=>''index'')); ?><br />
<?php endif;?>
<?php if($status != ''done''): ?>
   	<?php echo $html->link('List Done Tasks', array('action'=>'index/done')); ?><br /><?php echo $html->link(''List Done Tasks'', array(''action''=>''index'', ''done'')); ?><br />
<?php endif;?>
<?php if($status != ''pending''): ?>
   	<?php echo $html->link('List Pending Tasks', array('action'=>'index/pending')); ?><br /><?php echo $html->link(''List Pending Tasks'', array(''action''=>''index'', ''pending'')); ?><br />
<?php endif;?> 

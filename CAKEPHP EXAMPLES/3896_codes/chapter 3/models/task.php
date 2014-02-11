<?php
class Task extends AppModel {

   	var $name = ''Task'';
   	var $validate = array(
      		''title'' => array(
         			''rule'' => VALID_NOT_EMPTY,
         			''message'' => ''Title of a task cannot be empty''
      		)
   	);
   	
}
?>
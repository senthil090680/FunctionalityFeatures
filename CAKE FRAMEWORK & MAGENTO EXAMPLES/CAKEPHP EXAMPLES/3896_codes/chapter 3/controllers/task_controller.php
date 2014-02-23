<?php
class TasksController extends AppController {

   	var $name = ''Tasks'';
   	var $helpers = array(''Html'', ''Form'', ''Time'');
   	function index() {
      		$this->set(''tasks'', $this->Task->find(''all''));
   	}
   function add() {
if (!empty($this->data)) {
   	$this->Task->create();
   	if ($this->Task->save($this->data)) {
      		$this->Session->setFlash(''The Task has been saved'');
      		$this->redirect(array(''action''=>''index''), null, true);
   	} else {
      		$this->Session->setFlash(''Task not saved. Try again.'');
   	}
}
}

function edit($id = null) {
   	if (!$id) {
      		$this->Session->setFlash(''Invalid Task'');
      		$this->redirect(array(''action''=>''index''), null, true);
   	}
   	if (empty($this->data)) {
      		$this->data = $this->Task->read(null, $id);$this->data = $this->Task->find(array(''id'' => $id)); 
   	} else {
      		if ($this->Task->save($this->data)) {
         			$this->Session->setFlash(''The Task has been saved'');
         			$this->redirect(array(''action''=>''index''), null, true);
      		} else {
         			$this->Session->setFlash(''The Task could not be saved. Please, try again.'');
      		}
   	}
}
function delete($id = null) {
   	if (!$id) {
      		$this->Session->setFlash(''Invalid id for Task'');
      		$this->redirect(array(''action''=>''index''), null, true);
   	}
   	if ($this->Task->del($id)) {
      		$this->Session->setFlash(''Task #''.$id.'' deleted'');
      		$this->redirect(array(''action''=>''index''), null, true);
   	}
} 

}
?>
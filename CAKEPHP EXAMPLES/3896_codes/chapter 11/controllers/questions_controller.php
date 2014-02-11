<?php
class QuestionsController extends AppController {

	var $name = 'Questions';

	function home() {
		
		if (!empty($this->data) && $this->Auth->user('id')) {
			$this->data['Question']['user_id'] = $this->Auth->user('id');
			$this->Question->create();
			if ($this->Question->save($this->data)) {
				$this->Session->setFlash('Your Question has been added');
				$this->redirect(array('action'=>'home'), null, true);
			} else {
				$this->Session->setFlash('The Question could not be saved. Please, try again.');
			}
		}
		
		$this->Question->recursive = 1;
		$this->set('questions', $this->Question->find('all'));
	}

	function show( $id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Question.');
			$this->redirect(array('action'=>'home'));
		}
		
		if (!empty($this->data) && $this->Auth->user('id')) {
			$this->data['Answer']['user_id'] = $this->Auth->user('id');
			$this->Question->Answer->create();
			if ($this->Question->Answer->save($this->data)) {
				$this->Session->setFlash('The Answer has been saved');
				$this->redirect(array('action' => 'show', $id), null, true);
			} else {
				$this->Session->setFlash('The Answer could not be saved. Please, try again.');
			}
		}

		$this->Question->recursive = 2;
		$this->set('question', $this->Question->read(null, $id));
	}
	
	function search() {
		
	}
	
	function user_questions($user_id = null) {
		$this->layout = 'ajax';
		Configure::write('debug', '0');
		
		if(empty($user_id)) {
			if($this->data['User']['username']) {
				$user = $this->Question->User->findByUsername($this->data['User']['username']); 
				if(isset($user['User']['id'])){
					$user_id = $user['User']['id'];
				} else {
					$this->set('nouser', true);
				}
			} else {
				$user_id = $this->Auth->user('id');
			}
		} 
		
		$this->set('questions', $this->Question->find('all', array('conditions' => array('user_id' => $user_id))));
	}
	
	function edit_answer($answer_id = null) {
		$this->layout = 'ajax';
		Configure::write('debug', '0');
		
		$answer = $this->Question->Answer->findById($answer_id);
		echo $this->data['Answer']['answer'];
		exit();
		if(!empty($this->data['Answer']['answer']) && $answer['Answer']['user_id'] == $this->Auth->user('id')) {
			$this->Question->Answer->id = $answer_id;
			$this->Question->Answer->saveField('answer', $this->data['Answer']['answer']);
			$this->set('answer', $this->data['Answer']['answer']);
		} else {
			$this->set('answer', $answer['Answer']['answer']);
		}
	}

}
?>
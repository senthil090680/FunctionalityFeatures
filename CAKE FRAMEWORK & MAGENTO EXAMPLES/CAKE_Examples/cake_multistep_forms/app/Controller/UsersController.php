<?php
/**
 * @author Antonio Madonna www.ergotaxio.net
 **/
class UsersController extends AppController {
	
	/**
	 * use beforeRender to send session parameters to the layout view
	 */
	public function beforeRender() {
		parent::beforeRender();
		$params = $this->Session->read('form.params');
		$this->set('params', $params);
	}
	
	/**
	 * delete session values when going back to index
	 * you may want to keep the session alive instead
	 */
	public function msf_index() {
		$this->Session->delete('form');
	}
	
	/**
	 * this method is executed before starting the form and retrieves one important parameter:
	 * the form steps number
	 * you can hardcode it, but in this example we are getting it by counting the number of files that start with msf_step_
	 */
	public function msf_setup() {
		App::uses('Folder', 'Utility');
		$usersViewFolder = new Folder(APP.'View'.DS.'Users');
		$steps = count($usersViewFolder->find('msf_step_.*\.ctp'));
		$this->Session->write('form.params.steps', $steps);
		$this->Session->write('form.params.maxProgress', 0);
		$this->redirect(array('action' => 'msf_step', 1));
	}
	
	/**
	 * this is the core step handling method
	 * it gets passed the desired step number, performs some checks to prevent smart users skipping steps
	 * checks fields validation, and when succeding, it saves the array in a session, merging with previous results
	 * if we are at last step, data is saved
	 * when no form data is submitted (not a POST request) it sets this->request->data to the values stored in session
	 */
	public function msf_step($stepNumber) {
		
		/**
		 * check if a view file for this step exists, otherwise redirect to index
		 */
		if (!file_exists(APP.'View'.DS.'Users'.DS.'msf_step_'.$stepNumber.'.ctp')) {
			$this->redirect('/users/msf_index');
		}
		
		/**
		 * determines the max allowed step (the last completed + 1)
		 * if choosen step is not allowed (URL manually changed) the user gets redirected
		 * otherwise we store the current step value in the session
		 */
		$maxAllowed = $this->Session->read('form.params.maxProgress') + 1;
		if ($stepNumber > $maxAllowed) {
			$this->redirect('/users/msf_step/'.$maxAllowed);
		} else {
			$this->Session->write('form.params.currentStep', $stepNumber);
		}
		
		/**
		 * check if some data has been submitted via POST
		 * if not, sets the current data to the session data, to automatically populate previously saved fields
		 */
		if ($this->request->is('post')) {
			
			/**
			 * set passed data to the model, so we can validate against it without saving
			 */
			$this->User->set($this->request->data);
			
			/**
			 * if data validates we merge previous session data with submitted data, using CakePHP powerful Hash class (previously called Set)
			 */
			if ($this->User->validates()) {
				$prevSessionData = $this->Session->read('form.data');
				$currentSessionData = Hash::merge( (array) $prevSessionData, $this->request->data);
				
				/**
				 * if this is not the last step we replace session data with the new merged array
				 * update the max progress value and redirect to the next step
				 */
				if ($stepNumber < $this->Session->read('form.params.steps')) {
					$this->Session->write('form.data', $currentSessionData);
					$this->Session->write('form.params.maxProgress', $stepNumber);
					$this->redirect(array('action' => 'msf_step', $stepNumber+1));
				} else {
					/**
					 * otherwise, this is the final step, so we have to save the data to the database
					 */
					$this->User->save($currentSessionData);
					$this->Session->setFlash('Account created!');
					$this->redirect('/users/msf_index');
				}
			}
		} else {
			$this->request->data = $this->Session->read('form.data');
		}
		
		/**
		 * here we load the proper view file, depending on the stepNumber variable passed via GET
		 */
		$this->render('msf_step_'.$stepNumber);
	}
}
?>
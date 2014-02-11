<?php
class BooksController extends AppController {
	var $name = 'Books';
	var $scaffold;
	
	function index() {
		$this->Book->recursive = 1;
		$books = $this->Book->find('all');
		$this->set('books', $books);
	}
}
?>

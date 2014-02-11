<?php
class BooksController extends AppController {

	var $name = 'Books';
	var $uses = array();
	var $helpers = array('format');
	
	var $books	= array (
							0 => array (
									'book_title' => 'Object Oriented Programming with PHP5',
									'author'	   => 'Hasin Hayder',
									'isbn' 		   => '1847192564',
									'release_date' => 'December 2007'
							),
							1 => array (
									'book_title'   => 'Building Websites with Joomla! v1.0',
									'author'	   => 'Hagen Graf',
									'isbn' 		   => '1904811949',
									'release_date' => 'March 2006'
							),
							2 => array (
									'book_title'   => 'Moodle E-Learning Course Development',
									'author'	   => 'William Rice',
									'isbn' 		   => '1904811299',
									'release_date' => 'October 2006'
							)
			  		);
					
	function index() {
		$this->set('books', $this->books );
		$this->pageTitle = 'Welcome to the Packt Book Store!';
	}
	
	function view() {
		$date_str = $this->data['Book']['release_date']['year'].'-'.
					$this->data['Book']['release_date']['month'] .'-'.
					$this->data['Book']['release_date']['day'];
					
		$this->data['Book']['release_date'] = date( 'M Y', strtotime( $date_str ) );
		
		$this->set('book', $this->data['Book'] );
		$this->pageTitle = 'Welcome to the Packt Book Store!';
	}
	
	function add() {
		$this->pageTitle = 'Welcome to the Packt Book Store!';
	}

}
?>
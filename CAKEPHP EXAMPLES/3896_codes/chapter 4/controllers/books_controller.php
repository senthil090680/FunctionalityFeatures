<?php
class BooksController extends AppController {

	var $name = 'Books';
	var $uses = array();
	var $components = array('Util');
	
	function index( $id = 0 ) {
		$books	= array (
							'0' => array (
									'book_title'   => 'Object Oriented Programming with PHP5',
									'author'	   => 'Hasin Hayder',
									'isbn' 		   => '1847192564',
									'release_date' => 'December 2007'
							),
							'1' => array (
									'book_title'   => 'Building Websites with Joomla! v1.0',
									'author'	   => 'Hagen Graf',
									'isbn' 		   => '1904811949',
									'release_date' => 'March 2006'
							)
			  		);
		
		$id = $this->Util->strip_and_clean($id, $books);
		
		$this->set($books[$id] );
		$this->set('page_heading', 'Book Store');
		$this->pageTitle = 'Welcome to the Packt Book Store!';
	}
}
?>
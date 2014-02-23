<?php
class Book extends AppModel
{
	var $name = 'Book';
	
	 var $hasAndBelongsToMany = array(
        'Author' =>
            array('className'            => 'Author',
                'joinTable'              => 'authors_books',
                'foreignKey'             => 'author_id',
                'associationForeignKey'  => 'book_id',
				'fields'				 => array('name')
            )
        );
}
?>

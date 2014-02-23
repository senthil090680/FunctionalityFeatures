<?php
class Author extends AppModel
{
	var $name = 'Author';
	
	 var $hasAndBelongsToMany = array(
        'Book' =>
            array('className'            => 'Book',
                'joinTable'              => 'authors_books',
                'foreignKey'             => 'book_id',
                'associationForeignKey'  => 'author_id'
            )
        );
}
?>
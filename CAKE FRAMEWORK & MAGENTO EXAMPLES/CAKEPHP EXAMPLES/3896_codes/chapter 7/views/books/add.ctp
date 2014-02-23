<?php 
echo $form->create(null, array('url' => '/books/view', 'type' => 'post'));
echo $form->input('Book.book_title', array('type'=>'text'));
echo $form->input('Book.author', array('type'=>'text'));
echo $form->input('Book.isbn', array('type'=>'text'));
echo $form->input('Book.release_date', array('type'=>'date'));
echo $form->end('Submit');
?>
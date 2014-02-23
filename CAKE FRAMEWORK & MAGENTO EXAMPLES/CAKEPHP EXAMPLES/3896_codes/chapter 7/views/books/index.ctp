<h2>Book Store (All Books)</h2>
<?php
foreach ($books as $book) :
echo $this->element('book_info', array('book' => $book));
endforeach;
?>
<?php pr($this->params['controller']); ?>
<dl>
<dt class="header"><?php echo $book['book_title']; ?></dt>
<dt>Author:</dt><dd><?php echo $book['author']; ?></dd>
<dt>ISBN:</dt><dd><?php echo $format->hyphenateISBN($book['isbn']); ?></dd>
<dt>Release Date:</dt><dd><?php echo $format->shortenDate($book['release_date']); ?></dd>
</dl>
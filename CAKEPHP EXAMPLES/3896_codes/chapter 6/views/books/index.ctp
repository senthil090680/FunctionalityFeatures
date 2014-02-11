<?php foreach($books as $book): ?>
<h2><?php echo $book['Book']['title'] ?></h2>
<hr />
<p><?php echo $book['Book']['description'] ?></p>
<h3>Author(s):</h3>
<ul>
<?php foreach($book['Author'] as $author): ?>
<li><?php echo $author['name'] ?></li>
<?php endforeach; ?>
</ul>
<?php endforeach; ?>
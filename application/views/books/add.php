<h3>Add Book</h3>
<?= validation_errors(); ?>
<?= $this->message->display();?>
<?= form_open_multipart('books/add') ?>
<label for="book_name">Book Name: </label>
<input type="text" name="book_name"><br>
<label for="book_desc">Book Description: </label>
<input type="text" name="book_desc"><br>
<label for="userfile">Upload book: </label>
<input type="file" name="userfile"><br>
<input type="submit" value="Add Book">
<?= form_close() ?>
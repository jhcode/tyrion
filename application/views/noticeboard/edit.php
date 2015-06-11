<div class="base-container scroll-area">
	<div class="slider">

<?php if($type === 'article'): ?>
	<?= validation_errors(); ?>
    <?= $this->message->display();?>
    <?= form_open_multipart(); ?>
    <label for="title">Notice Title</label>
	<input type="text" name="title" value="<?= $all->title; ?>"><br><br>
	<label for="details">Notice details</label>
	<textarea rows="8" cols="50" name="details">
		<?= $all->description; ?>
	</textarea><br><br>
	<input type="submit" value="update notice">
    <?= form_close(); ?>
    <br><a href="<?= site_url(); ?>/noticeboard/manage">Go back to management</a>

<?php elseif($type === 'image'): ?>
	<?= validation_errors(); ?>
    <?= $this->message->display();?>
    <?= form_open_multipart(); ?>
    <label for="title">Caption</label>
	<input type="text" size="50" name="title" value="<?= $all->title; ?>"><br><br>
	<img src="./uploads/<?= $all->image1; ?>" alt="<?= $all->title; ?>" class="thumbnails"><br>
	<label for="file">Replace image:</label>
	<input type="file" name="file"><br>
	<input type="submit" value="update notice">
    <?= form_close(); ?>
    <br><a href="<?= site_url(); ?>/noticeboard/manage">Go back to management</a>


<?php elseif($type === 'video'): ?>
	<?= validation_errors(); ?>
    <?= $this->message->display();?>
    <?= form_open_multipart(); ?>
    <label for="title">Caption</label>
	<input type="text" size="60" name="title" value="<?= $all->title; ?>"><br><br>
	<label for="details">Video URL:</label>
	<input type="text" size="60" name="details" value="<?= $all->description; ?>"><br>
	<input type="submit" value="update notice">
	<?= form_close(); ?>
	<br><a href="<?= site_url(); ?>/noticeboard/manage">Go back to management</a>


<?php elseif($type === 'gallery'): ?>
	<?= validation_errors(); ?>
    <?= $this->message->display();?>
	<?= form_open_multipart(); ?>
	<label for="title">Gallery Title</label>
	<input type="text" size="60" name="title" value="<?= $all->title; ?>"><br><br>
	<label for="details">Gallery Description</label>
	<input type="text" size="60" maxlength="70" name="details" value="<?= $all->description; ?>">
	<br><br>
	<?php $j = 0; for($i = 1; $i < 6; $i++): ?>
	<?php if(!empty($all->{'image'.$i})): ?>
	<?php $j++; ?>
	<img src="./uploads/<?= $all->{'image'.$i}; ?>" class="thumbnails" />
	<?php endif; ?>
	<?php endfor; ?>
	<?php if ($j < 5): ?>
	<br><br>
	<div id="notice_table" class="row-set">
		<input class="row-temp" type="file" name="files[]">
		<a href="#" role="link" class="add-more">Add more</a><br>	
	</div><br>		
	<?php endif; ?>
	<br>
	<input type="submit" value="update notice">
	<?= form_close(); ?>
	<br><a href="<?= site_url(); ?>/noticeboard/manage">Go back to management</a>

<? endif; ?>
	</div>
</div>
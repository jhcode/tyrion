<!--Display for Article posts -->
<?php if($type === 'article'): ?>
	<div class="base-container scroll-area">
		<div class="slider">
			<?= validation_errors(); ?>
			<?= $this->message->display(); ?>
			<?= form_open_multipart('noticeboard/create/'.$type); ?>
			<label for="title">Notice Title</label>
			<input type="text" name="title"><br><br>
			<label for="details">Notice details</label>
			<textarea rows="8" cols="50" name="details">
			</textarea><br><br>
			<input type="submit" value="paste notice">
			<?= form_close(); ?>
			<br><a href="<?= site_url(); ?>/noticeboard/manage">Go back to management</a>
		</div>
	</div>

<!-- Display for Image posts -->
<?php elseif($type === 'image'): ?>
	<div class="base-container scroll-area">
		<div class="slider">
			<?= validation_errors(); ?>
			<?= $this->message->display(); ?>
			<?= form_open_multipart('noticeboard/create/'.$type); ?>
			<label for="title">Caption</label>
			<input type="text" size="60" name="title"><br><br>
			<label for="details">Chooose Image</label>
			<input type="file" name="file"><br>
			<input type="submit" value="paste notice">
			<?= form_close(); ?>
			<br><a href="<?= site_url(); ?>/noticeboard/manage">Go back to management</a>
		</div>
	</div>

<!-- Display for Video posts -->
<?php elseif($type === 'video'): ?>
	<div class="base-container scroll-area">
		<div class="slider">
			<?= validation_errors(); ?>
			<?= $this->message->display(); ?>
			<?= form_open_multipart('noticeboard/create/'.$type); ?>
			<label for="title">Caption</label>
			<input type="text" size="60" name="title"><br><br>
			<label for="details">Add video URL</label>
			<input type="url" name="details" size="60" placeholder="https://www.youtube.com/watch?v=ip6RvnlmLsE">
			<br><br>
			<input type="submit" value="paste notice">
			<?= form_close(); ?>
			<br><a href="<?= site_url(); ?>/noticeboard/manage">Go back to management</a>
		</div>
	</div>

<!-- Display for Gallery posts -->
<?php elseif($type === 'gallery'): ?>
<div class="base-container scroll-area">
	<div class="slider">
		<div style="color: #fff">
			<?= validation_errors(); ?>
		    <?= $this->message->display(); ?>
			<?= form_open_multipart('noticeboard/create/'.$type); ?>
			<label for="title">Gallery Title</label>
			<input type="text" maxlength="30" size="60" name="title"><br><br>
			<label for="details">Gallery Description</label>
			<input type="text" size="60" maxlength="70" name="details">
			<br><br>
			<!-- Cover image upload -->
			<label for="files">Upload Photos Photo:</label>
			<div id="notice_table" class="row-set">
				<input class="row-temp" id="photoimg" type="file" name="files[]">
				<a href="#" role="link" class="add-more">Add more</a><br>	
			</div><br>	
			<input type="submit" value="paste notice">
			<?= form_close(); ?>
			<div class="bx-slider"></div>
			<div id="preview"></div>
			<br><a href="<?= site_url(); ?>/noticeboard/manage">Go back to management</a>
		</div>
	</div>
</div>
<?php endif; ?>
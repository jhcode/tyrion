<div class="base-container scroll-area">
	<div class="slider">
		<h3>Edit <?= str_replace("_"," ",ucfirst($type)); ?></h3>
		<?= validation_errors(); ?>
		<?= $this->message->display(); ?>
		<?= form_open(); ?>
		
		<label for="title">Title: </label><br>
		<input type="text" name="title" size="50" value="<?= $course->title; ?>"><br>

		<? if($type === "note"): ?>
		<label for="content">Note: </label><br>
		<textarea cols="50" rows="3" name="content"><?= $course->content; ?></textarea><br>
		<? elseif($type === "video"): ?>
		<label for="content">Video URL: </label><br>
		<input type="url" name="content" size="60" value="<?= $course->content; ?>"><br>
		<? elseif($type === "assignment"): ?>
		<label for="content">Assignment: </label><br>
		<textarea cols="50" rows="3" name="content"><?= $course->content; ?></textarea><br>
		<? elseif($type === "quiz"): ?>
		<label for="content">Quiz:</label><br>
		<textarea cols="50" rows="3" name="content"><?= $course->content; ?></textarea><br>
		<? elseif($type === "announcement"): ?>
		<label for="content">Announcement: </label><br>
		<textarea cols="50" rows="3" name="content"><?= $course->content; ?></textarea><br>
		<? elseif($type === "live_class"): ?>
		<input type="hidden" name="content" value="active">
		<? else: redirect(site_url()."/courses"); ?>
		<? endif; ?>
		<br><button type="submit">Update</button>
		<?= form_close(); ?>
		<? if (isset($_SERVER['HTTP_REFERER'])): ?>
		<a href="<?= $_SERVER['HTTP_REFERER'] ?>">Go back to your course</a>
		<? else: ?>
		<a href="<?= site_url(); ?>/courses">Go back to courses</a>
		<? endif; ?>
	</div>
</div>
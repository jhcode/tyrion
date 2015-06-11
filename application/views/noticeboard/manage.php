<div class="base-container scroll-area">
	<div class="slider">
		<h3>Select the type of notice you want to add</h3>
		<ul style="list-style:none">
			<li><a href="<?= site_url(); ?>/noticeboard/create/article">Article</a></li>
			<li><a href="<?= site_url(); ?>/noticeboard/create/image">Image</a></li>
			<li><a href="<?= site_url(); ?>/noticeboard/create/video">Video</a></li>
			<li><a href="<?= site_url(); ?>/noticeboard/create/gallery">Gallery (Multi-Featured)</a></li>
		</ul>
		<h4>Existing notices</h4>
		<ul>
		<?php
			foreach ($all as $field) {
				echo '<li>'.$field->title." [{$field->type}] (".date('D, j M, H:i:s', $field->created).")
				<a href='./index.php/noticeboard/remove/".$field->id."'>
				<button>Delete</button></a>
				<a href='./index.php/noticeboard/edit/{$field->type}/{$field->id}'><button>Edit</button></a>
				</li>";
			}
		?>
		</ul>
	</div>
</div>
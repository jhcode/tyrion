<div class="base-container scroll-area">
	<div class="slider">
		<h3>Add New Course</h3>
		<a href="<?= site_url(); ?>/courses/add/note">Add Note</a><br>
		<a href="<?= site_url(); ?>/courses/add/video">Add Video</a><br>
		<a href="<?= site_url(); ?>/courses/add/quiz">Add Quiz / Poll</a><br>
		<a href="<?= site_url(); ?>/courses/add/assignment">Add Assignment</a><br>
		<a href="<?= site_url(); ?>/courses/add/announcement">Add Announcement</a><br>
		<h3>Existing Courses</h3>
		<? foreach($courses as $course): ?>
		<ul>
			<li>
		<?= $course->title." [".$course->type."]  by ".$course->author." on ".date('d/m/Y', $course->created); ?>
		<a href="<?= site_url(); ?>/courses/edit/<?= $course->type."/".$course->id; ?>"><button>Edit</button></a>
		<a href="<?= site_url(); ?>/courses/remove/<?= $course->id ?>"><button>Delete</button></a>
			</li>
		</ul>
		<? endforeach; ?>
	</div>
</div>
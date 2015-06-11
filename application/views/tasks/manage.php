<div class="base-container scroll-area">
	<div class="slider">
		<a href="<?= site_url(); ?>/tasks/add">Add New Task</a>
		<br>
		<h3>Tasks</h3>
		<? foreach($all as $tasks): ?>
		<ul>
			<li>
				<?= $tasks->day.": ".$tasks->activity." ".$tasks->time; ?>
				<a href="<?= site_url()."/tasks/edit/".$tasks->id; ?>"><button>Edit</button></a>
				<a href="<?= site_url()."/tasks/remove/".$tasks->id; ?>"><button>Delete</button></a>
			</li>
		</ul>
		<? endforeach; ?>
	</div>
</div>
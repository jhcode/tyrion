<div class="base-container scroll-area">
	<div class="slider">
		<h3>Edit a task</h3>

		<?= validation_errors(); ?>
		<?= $this->message->display(); ?>
		<?= form_open(); ?>
		<label for="date">Date: </label>
		<input id="datepicker" type="text" name="date" value="<?= $all->day; ?>"><br>
		<label for="time">Time: </label> <?= $all->time; ?>
		<select name="time">
			<option>1:00</option>
			<option>2:00</option>
			<option>3:00</option>
			<option>4:00</option>
			<option>5:00</option>
			<option>6:00</option>
			<option>7:00</option>
			<option>8:00</option>
			<option>9:00</option>
			<option>10:00</option>
			<option>11:00</option>
			<option>12:00</option>
		</select>
		<select name="meridian">
			<option>AM</option>
			<option>PM</option>
		</select>
		<br>
		<label for="activity">Activity</label>
		<input type="text" name="activity" value="<?= $all->activity; ?>"><br>
		<button type="submit">Update Task</button>
		<?= form_close(); ?>
	</div>
</div>
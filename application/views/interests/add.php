	
<div class="slider">
	<div style="width:500px;">
		<?= validation_errors();?>
		<?=form_open('interests/add');?>
		<h3>Add Interests</h3>

		<div class="data-context">
			<div class="row-temp">
				<input type="text" name="name[]"/>
			</div>

			<div>
				<button data-context = "data-context" class="btn btn-large btn-primary add-more">Add More interests</button>
				<input type="submit" class="btn btn-large btn-success" value="Save Interests">
			</div>
		</div>
		<?=form_close();?>
	</div>
</div>
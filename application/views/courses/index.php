<div class="base-container scroll-area">
	<div class="slider">
		<!-- Widget Column -->
		<div class="widget-column">
			<div class="widget greenish course-create">
            	<h1>Create a Course</h1>
				<?= form_open(); ?>
				<label class="lead" for="title">Course Title: </label><br>
				<input type="text" name="title"><br><br>
				<select name="privacy">
					<option>Public</option>
					<option>Private</option>
				</select>
				<label class="lead" for="overview">Course Overview: &nbsp;
					<span class="fa fa-info-circle" title="A short description of what your course is about"></span>
				</label><br>
				<textarea id="status" maxlength="200" rows="4" name="overview"></textarea>
				<span class="txtright" id="text_counter"></span><div class="clear"></div>
				<button class="btn btn-primary" type="submit">Create Course</button><br>&nbsp;
				<?= form_close(); ?>
			</div>
		</div>

		<!-- Widget Column -->
		<div class="widget-column">
            <div class="widget">
                <div class="calendarbox">
                      <div class="title row">
                            <div class="course-title">
                            	<span class="fa fa-list-alt"></span> Courses you created
                            </div>
                      </div>
                </div>
                <div class='courses'>
					<div class="magfull">
					    <div class="courses-inner vert-scroll scroll-area">
					        <ul>
					        	<? foreach($created as $creation): ?>
					        	<li>
					        		<a href="<?= site_url('/courses/view/'.$creation->id); ?>"><?= $creation->title; ?></a>
					        		<i class="txtright"><?= $creation->privacy; ?></i>
					        	</li>
					        	<? endforeach; ?>
					        </ul>
					    </div>
					</div>
				</div>
    		</div>
		</div>

		<!-- Widget Column -->
		<div class="widget-column">
            <div class="widget">
                <div class="boxgreen">
                      <div class="title row">
                            <div class="course-title">
                            	<span class="fa fa-list-alt"></span> Courses you have joined
                            </div>
                      </div>
                </div>
                <div class='courses'>
					<div class="magfull">
					    <div class="courses-inner vert-scroll scroll-area">
					        <ul>
					        	<? foreach($members as $member): ?>
					        	<? $course = $this->course->get($member->course_id); ?>
					        	<li>
					        		<a href="<?= site_url('/courses/view/'.$course->id); ?>"><strong><?= $course->title;  ?></strong></a>
					        		<i class="txtright"><?= $course->privacy; ?></i>
					        		<span>By <? $name = $this->user->get($course->founder); echo say_you($sess_name,$name->firstname." ".$name->lastname); ?></span>
					        	</li>
					        	<? endforeach; ?>
					        </ul>
					    </div>
					</div>
				</div>
    		</div>
		</div>

		<!-- Widget Column -->
		<div class="widget-column">
            <div class="widget">
                <div class="crimson">
                      <div class="title row">
                            <div class="course-title">
                            	<span class="fa fa-list-alt"></span> Suggested Courses
                            </div>
                      </div>
                </div>
                <div class='courses'>
					<div class="magfull">
					    <div class="courses-inner vert-scroll scroll-area">
					        <ul>
					        	<? foreach($suggestion as $suggested): ?>
					        	<li><a href="<?= site_url('/courses/view/'.$suggested->id); ?>"><strong><?= $suggested->title; ?></strong></a>
					        		<i class="txtright"><? $count = ($this->member->get_many_by(['course_id'=>$suggested->id]));
					        		if(count($count) == 1){echo count($count)." member";}else{echo count($count)." members";} ?></i>
					        		<span>By <? $name = $this->user->get($suggested->founder); echo say_you($sess_name,$name->firstname." ".$name->lastname); ?></span>
					        	</li>
					        	<? endforeach; ?>
					        </ul>
					    </div>
					</div>
				</div>
    		</div>
		</div>

	</div>
</div>
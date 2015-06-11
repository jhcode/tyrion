<div class="base-container scroll-area">
	<div class="slider">
    
		<div class="widget-column">
        
			<div class="widget adminboard">
				<p>Welcome <strong><?= ucfirst($user->firstname); ?></strong></p>
				<div></div>
			</div>
			<div class="widget whiteback" >
				<div class="profile-content">
					<div class="rounded-image">
						<?= check_image($user->image); ?>
					</div>
					<h1><?= ucfirst($user->firstname)." ".ucfirst($user->lastname); ?></h1>					
					<div class="status-information">
						<p style="text-transform:uppercase">Profile Completion: 80%</p>
						<div class="progress-graphs radius">
							<div class="bar" style="width:80%"></div>
						</div>
					</div>
					<p align="right"><a href="#" data-reveal-id="ApplicationModal">Edit Profile</a></p>
				</div>
			</div>
			<div class="widget whiteback" >
				<div class="profile-content adminlocate">
					<a><i class="fa fa-globe"></i> Quick Updates</a>
					<p> No available updates</p>					
				</div>
			</div>
		</div>		
		
		<!-- Courses WIDGET -->
		<div class="widget-column">
			<div class="widget crimson-text courses">
				<div class="title row">
					<div class="col-md-12"><span class="glyphicon glyphicon-list"></span> Courses</div>
				</div>
				<div class="content">
					<h1><a href="#" class="remove-default" data-reveal-id="LargeModal"><i class="fa fa-plus-square-o fa-2x"></i></a></h1>
					<div class="fcenter">You have not started or joined any Courses yet.</div>

				</div>
			</div>
		</div>
		
		<!-- Courses WIDGET -->
        <div class="widget-column ">
			<div class="widget classroom groups">
				<div class="title row">
					<div class="col-md-12 net"><span class="glyphicon glyphicon-book"></span> Groups</div>
				</div>
				<div class="content">
					<h1><a href=""><i class="fa fa-plus-square-o fa-2x"></i></a></h1>
					<p>You have not started or joined any groups yet.</p>
				</div>                  
			</div>
		</div>

		<div class="widget-column">	

			<!-- TASKS WIDGET -->
			<div class="widget todo-area">
				<div class="title row">
					<div class="col-md-8 white"><span class="glyphicon glyphicon-list-alt"></span> Tasks</div>
					<div class="col-md-4 blacktitleright"><a href="<?= site_url(); ?>/tasks/add">Add <i class="fa fa-plus-square-o"></i></a></div>
				</div>
				<div id="tiles" class="live-tile" data-delay="3500" data-mode="carousel" data-swap="html">
				    <? foreach($tasks as $task): ?>
			        <div>
				      	<h4 class="todo-day">
				      		<?php
				      		/* Getting the page to display yesterday, today, tomorrow, or interval of the task
				      		from present date */
				      		$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
				      		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
				      		if($task->day === date('d/m/Y')){
				      			echo "Today";
				      		}elseif($task->day === date('d/m/Y', $tomorrow)){
				      			echo "Tomorrow";
				      		}elseif($task->day === date('d/m/Y', $yesterday)){
				      			echo "Yesterday";
				      		}else{
				      			$reset = str_replace('/', '-', $task->day);
				      			$datetime1 = date_create(date('d-m-Y'));
								$datetime2 = date_create($reset);
				      			$interval = date_diff($datetime1, $datetime2);
				      			echo $interval->format('%R%a days');
				      		}
				      		echo " ".$task->day; 
				      		?>
				      	</h4>

				      	<div class="pad10">
					      	<ul>
					      		<li><span class="todo-time">8:00am</span>French</li>
					      		<li><span class="todo-time">10:00am</span>Economics</li>
					      		<li><span class="todo-time">12:00pm</span>Chemistry</li>
					      		<li><span class="todo-time">2:00pm</span>Geography</li>
					      	</ul>
					    </div>
			        </div>
			  		<? endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="base-container scroll-area">
	<div class="slider">
    
		<div class="widget-column">
        
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
					<p align="right"><a href="#">Edit Profile</a></p>
				</div>
			</div>
			<div class="widget whiteback" >
				<div class="profile-content">
					<p class="status-title">LAST LOGIN</p>
					<div class="status-information">
						<p><?= date('dS \of F, Y',$user->last_login); ?></p>						
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="widget-column">
			<div class="widget">
				<div class="title row">
					<div class="col-md-8 bluetitle"><span class="glyphicon glyphicon-bullhorn"></span> Noticeboard
                    </div>                                    
					<div class="col-md-4 small-add-btn"></span><a href="<?= site_url(); ?>/noticeboard/manage">Add <i class="fa fa-plus-square-o"></i></a></div>
				</div>
				<div class="notification-image">
					<div class="notification-text">
						<h1>New Library:</h1>
						<h2>Construction Underway</h2>
					</div>
				</div>
			</div>
			<div class="row widget greenish darkbluback" >
				<div class="title"><i class="fa fa-chart"></i> Student Population</div>							                   		
        		<div class="col-sm-3">
    				<h1>88</h1> 
    				<p class="populate">Students</p>                           
       			</div>
        		<div class="charts col-sm-9">
        			
                 	<div class="col-sm-8 progress-graph greens" style="">
						<div class="bar crimson" style="width:50%"></div>                                   
					</div>
					<div class="col-sm-4">Male (20)</div>
					
            		<div class="col-sm-8 progress-graph greens">
                     	<div class="bar orange" style="width:100%"></div>                                   
					</div>
					<div class="col-sm-4">Female (68)</div>
        		</div>                         	                       							
			</div>
        </div> -->
		
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
		
		<!-- Groups WIDGET -->
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
			<!-- STORE WIDGET -->
			<div class="widget orange orangeback">
				<div class="title row">
					<div class="col-md-12"><span class="glyphicon glyphicon-th-large"></span> Store</div>
				</div>
				<div class="content">
					<div class="peek">
						<div class="text">
							<div class="image"><?= img('http://ostrich-dev.com/images/profile.jpg'); ?></div>
							<h1>MY AUTOBIOGRAPHY: ALEX FERGUSON</h1>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip.
							<div class="buttons">
								<a href="#"><i class="fa fa-money"></i> BUY</a><a href="#"><i class="fa fa-money"></i> RENT</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End of STORE WIDGET -->

			<!-- TASKS WIDGET -->
			<div class="widget todo-area">
				<div class="title row">
					<div class="col-md-8 white"><span class="glyphicon glyphicon-list-alt"></span> Tasks</div>
					<div class="col-md-4 blacktitleright"><a data-reveal-id="addTask">Add <i class="fa fa-plus-square-o"></i></a></div>
				</div>
				<div id="tiles" class="live-tile" data-delay="3500" data-mode="carousel" data-swap="html">
					<ul class="bx-slider task-container">
						<?php foreach($tasks as $task): ?>
						<li>
					        <div>
						      	<h4 class="todo-day"><?= exact_day($task->created); ?>
						      		<span><?= " ".date('d/m/Y',$task->created); ?></span>
						      	</h4>

						      	<div class="pad10">
							      	<ul class="todo-subjects">
							      		<li><span class="todo-time">8:00am</span>French</li>
							      		<li><span class="todo-time">10:00am</span>Economics</li>
							      		<li><span class="todo-time">12:00pm</span>Chemistry</li>
							      		<li><span class="todo-time">2:00pm</span>Geography</li>
							      	</ul>
							    </div>
					        </div>
				    	</li>
				  		<?php endforeach; ?>    
			  		</ul>
				</div>
			</div>
			<!-- // Tasks Widget -->
		</div>
	</div>
</div>

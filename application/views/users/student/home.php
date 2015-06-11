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
					<p align="right"><a href="#">Edit Profile</a></p>
				</div>
			</div>
			<div class="widget whiteback" >
				<div class="profile-content adminlocate">
					<a href=""><i class="fa fa-globe"></i> myschool.com</a>
					<p><i class="fa fa-map-marker"></i> 134, Frankfurt street, Abule-Egba, India</p>
				</div>
			</div>
		</div>

		<div class="widget-column">
			<div class="widget notif-box">
				<div class="title row">
					<div class="col-md-8 bluetitle"><span class="glyphicon glyphicon-bullhorn"></span> Noticeboard
                    </div>                                    
					<div class="col-md-4 small-add-btn"></div>
				</div>
				<div class="notification-image">
					<ul class="notification-slide">
						<li><?= img(base_url('assets/imgs/yum.jpg')); ?></li>
						<li><?= img(base_url('assets/imgs/yum.jpg')); ?></li>
					</ul>
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
        </div>

        <div class="widget-column">
        	<!-- Reports Widget -->
        	<div class="widget admin-reports">
        		<div class="title row">
					<div class="col-md-8 bluetitle"><span class="fa fa-folder-open"></span> Reports
                    </div>                                    
					<div class="col-md-4 small-add-btn"></div>
				</div>
				<div class="myclass"><h6>My Class (SS3 Diamond)</h6></div>
				<!-- Report Node -->
				<div class="report-node">
					<div class="pull-left">
						<h2>189<sup>%</sup></h2>
						<p>Academic Average</p>
					</div>
					<div class="pull-left">
						<div class="progress progress-striped">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
							</div>
						</div>
						<div class="progress progress-striped">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
							</div>
						</div>
					</div>
					<div class="pull-left">
						<span>Male</span>
						<span>Female</span>
					</div>
				</div>
				<!-- Report Node -->
				<div class="report-node">
					<div class="pull-left">
						<h2>95<sup>%</sup></h2>
						<p>Attendance Average</p>
					</div>
					<div class="pull-left">
						<div class="progress progress-striped">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
							</div>
						</div>
						<div class="progress progress-striped">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
							</div>
						</div>
					</div>
					<div class="pull-left">
						<span>Male</span>
						<span>Female</span>
					</div>
				</div>
        	</div>
        	<!-- // Reports Widget -->
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

		<!-- Courses WIDGET -->
		<div class="widget-column">
			<div class="widget crimson-text courses">
				<div class="title row">
					<div class="col-md-12"><span class="glyphicon glyphicon-list"></span> Courses</div>
				</div>
				<div class="content">
					<h1><a href="#" class="remove-default" data-reveal-id="LargeModal"><i class="fa fa-plus-square-o fa-2x"></i></a></h1>
					<div class="fcenter">You have not started or joined any Courses yet.</div>
					<h6>Suggested Courses</h6>
					<div class="courses-inner">
						<ul class="tile">
							<li>
								<?= img(base_url('assets/imgs/avatar.png')); ?>
								<h3>Public Speaking 112</h3>
								<aside>By Dr. Arinze Eze</aside>
								<i class="fa fa-plus txtright"></i>
							</li>
							<li>
								<?= img(base_url('assets/imgs/avatar.png')); ?>
								<h3>Public Speaking 112</h3>
								<aside>By Dr. Arinze Eze</aside>
								<i class="fa fa-plus txtright"></i>
							</li>
							<li>
								<?= img(base_url('assets/imgs/avatar.png')); ?>
								<h3>Public Speaking 112</h3>
								<aside>By Dr. Arinze Eze</aside>
								<i class="fa fa-plus txtright"></i>
							</li>
						</ul>
					</div>
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

	</div>
</div>

<!-- Modals -->
<div id="addTask" class="lightbox reveal-modal invite small" data-reveal>

      <h1>Add New Task</h1>
          <section>
                <div class="sec-row">
                      <?= form_open('tasks/add',['class'=>'taskform']); ?>
                      <div class="sub-row">
                      		<p></p>
                      		<div><?= validation_errors(); ?><?= $this->message->display(); ?></div>
                      </div>
                      <div class="sub-row">
                           
                            <p>Date</p>                            
                            <div class="form-group row">
								<div class="col-xs-8">
									<div class="input-group date" id="dp3" data-date="<?= date('d-m-Y',time()); ?>" data-date-format="dd-mm-yyyy">
										<input class="form-control" type="text" readonly="" value="<?= date('d-m-Y',time()); ?>" name="date">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
									</div>
								</div>
							</div>
                      </div>
                      <div class="sub-row">
                            <p>Time</p>
                            <select name="time" class="ios-button inheritance">
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
                            <select name="meridian" class="ios-button inheritance">
                            	<option>AM</option>
                            	<option>PM</option>
                            </select>
                      </div>
                      <div class="sub-row">
                            <p>Activity</p>
                            <input type="text" name="activity" placeholder="e.g Mathematics">
                      </div>
                      <div class="sub-row">
                            <p></p>
                            <button class="btn btn-info">Create Task</button>
                      </div>
                      <?= form_close(); ?>
                </div>
          </section>

      <a class="close-reveal-modal">&#215;</a>
</div>
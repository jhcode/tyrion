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
					<a href="" data-reveal-id="AdminPeopleModal"><i class="fa fa-globe"></i> myschool.com</a>
					<a href="" data-reveal-id="AdminDashboardModal"><p><i class="fa fa-map-marker"></i> 134, Frankfurt street, Abule-Egba, India</p></a>
				</div>
			</div>
		</div>

		<div class="widget-column">
			<div class="widget notif-box">
				<div class="title row">
					<div class="col-md-8 bluetitle">
						<a class="nochange" href="noticeboard"><span class="glyphicon glyphicon-bullhorn"></span> Noticeboard</a>
                    </div>                                    
					<div class="col-md-4 small-add-btn"></span><a data-reveal-id="manageNotice">Add <i class="fa fa-plus-square-o"></i></a></div>
				</div>
				<div class="notification-image">
					<ul class="notification-slide">
						<? if(count($notices) === 0): ?>
						<div class="notice-box"><h1>Oops!</h1><h2>There are no notices available.</h2></div>
						<? else: ?>
						<? foreach($notices as $notice): ?>
						<?php if($notice->type === 'image' OR $notice->type === 'gallery'): ?>
						<?php $image = json_decode($notice->info); ?>
						<li><?= img(base_url('./uploads/notices/'.$image[0])); ?>
							<div class="notification-text">
								<h1>Caption:</h1>
								<h2><?= $notice->title; ?></h2>
							</div>
						</li>
						<? elseif($notice->type === 'video'): ?>
						<li>
							<iframe src="//www.youtube.com/embed/<?= $notice->details; ?>" frameborder="0" allowfullscreen>
							</iframe>
						</li>
						<? else: ?>
						<li>
							<div class="notice-box">
								<h2><?= $notice->title; ?></h2>
								<?= $notice->details; ?>
							</div>
						</li>
						<?php endif; ?>
						<? endforeach; ?>
						<? endif; ?>
					</ul>
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
						<div class="bar crimson" role="progressbar" data-width="50%"></div>                                   
					</div>
					<div class="col-sm-4">Male (20)</div>
					
            		<div class="col-sm-8 progress-graph greens">
                     	<div class="bar orange" role="progressbar" data-width="70%"></div>                                   
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
				<!-- Report Node -->
				<div class="report-node">
					<div class="pull-left">
						<h2>80<sup>%</sup></h2>
						<p>Academic Average</p>
					</div>
					<div class="pull-left">
						<div class="progress progress-striped">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" data-width="60%">
							</div>
						</div>
						<div class="progress progress-striped">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" data-width="25%">
							</div>
						</div>
					</div>
					<div class="pull-left">
						<span>Equal/Above</span>
						<span>Below</span>
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
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" data-width="40%">
							</div>
						</div>
						<div class="progress progress-striped">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" data-width="68%">
							</div>
						</div>
					</div>
					<div class="pull-left">
						<span>Equal/Above(67%)</span>
						<span>Below(33%)</span>
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
					<? if(count($tasks) === 0): ?>
					<p class="lead">There are no tasks created yet. Start adding</p>
					<? else: ?>
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
			  		<? endif; ?>
				</div>
			</div>
        </div>
		
		<div class="widget-column">
			<!-- Classroom ZigZag Widget Container -->
			<div class="widget zigzag-edges">
        		<div class="title row">
					<div class="col-md-8 bluetitle"><span class="fa fa-sitemap fa-2x"></span> Classes
                    </div>                                    
					<div class="col-md-4 small-add-btn"></div>
				</div>
				<div class="content">
					<h1><a href=""><i class="fa fa-plus-square-o fa-2x"></i></a></h1>
					<p><a>Add Classes</a></p>
				</div>
				<ul class="bx-slider" style="padding:0;list-style:none">
					<li>
						<!-- ZigZag Node -->
						<div class="zigzag-node">
							<div>
								<h4>SS2 Ruby</h4>
								<strong>Class Teacher</strong>
								<p><a href="">Adebowale Francis</a></p>
							</div>
							<div>
								<h3 class="<?= color_code('24'); ?>">24</h3>
								<p>Class Average</p>
							</div>
						</div>
						<!-- ZigZag Node -->
						<div class="zigzag-node">
							<div>
								<h4>SS2 Ruby</h4>
								<strong>Class Teacher</strong>
								<p><a href="">Adebowale Francis</a></p>
							</div>
							<div>
								<h3 class="<?= color_code('37'); ?>">37</h3>
								<p>Class Average</p>
							</div>
						</div>
						<!-- ZigZag Node -->
						<div class="zigzag-node">
							<div>
								<h4>SS2 Ruby</h4>
								<strong>Class Teacher</strong>
								<p><a href="">Adebowale Francis</a></p>
							</div>
							<div>
								<h3 class="<?= color_code('60'); ?>">60</h3>
								<p>Class Average</p>
							</div>
						</div>
					</li>
					<li>
						<!-- ZigZag Node -->
						<div class="zigzag-node">
							<div>
								<h4>SS2 Ruby</h4>
								<strong>Class Teacher</strong>
								<p><a href="">Adebowale Francis</a></p>
							</div>
							<div>
								<h3 class="<?= color_code('80'); ?>">80</h3>
								<p>Class Average</p>
							</div>
						</div>
						<!-- ZigZag Node -->
						<div class="zigzag-node">
							<div>
								<h4>SS2 Ruby</h4>
								<strong>Class Teacher</strong>
								<p><a href="">Adebowale Francis</a></p>
							</div>
							<div>
								<h3 class="<?= color_code('12'); ?>">12</h3>
								<p>Class Average</p>
							</div>
						</div>
						<!-- ZigZag Node -->
						<div class="zigzag-node">
							<div>
								<h4>SS2 Ruby</h4>
								<strong>Class Teacher</strong>
								<p><a href="">Adebowale Francis</a></p>
							</div>
							<div>
								<h3 class="<?= color_code('49'); ?>">49</h3>
								<p>Class Average</p>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>

		<!-- Widget Column -->
		<div class="widget-column">
			<!-- Defaulters Widget -->
			<div class="widget defaulters">
                <div class="calendarbox">
                      <div class="title row">
                            <div class="course-title">
                            	<span class="fa fa-money fa-2x"></span> Defaulters Safe
                            </div>
                      </div>
                </div>
				<div>
			        <ul class="accordion-container">                                    
                        <li class="accordion clearfix">
                            <div class="col-md-8"><a class="class-desc" data-toggle-panel="panel-inf1">SSS1 (20)</a></div>
                            <div class="col-md-4"><a class="pull-right" data-toggle-panel="panel-inf1"><i class="fa fa-chevron-down"></i></a></div>
                            <div id="panel-inf1" class="content panel-size" style="display:block">                                                                                                                                                                                                                                                                                                
                                                                                                                                            	                            								
								
                            </div>                                                
                        </li>     
                         <li class="accordion clearfix">
                            <div class="col-md-8"><a class="class-desc" data-toggle-panel="panel-inf1">SSS2 (27)</a></div>
                            <div class="col-md-4"><a class="pull-right" data-toggle-panel="panel-inf1"><i class="fa fa-chevron-down"></i></a></div>
                            <div id="panel-inf1" class="content panel-size">                                                                                                                                                                                                                                                                                                
                                                                                                                                            	                            								
								
                            </div>                                                
                        </li>     
                         <li class="accordion clearfix">
                            <div class="col-md-8"><a class="class-desc" data-toggle-panel="panel-inf1">SSS3 (25)</a></div>
                            <div class="col-md-4"><a class="pull-right" data-toggle-panel="panel-inf1"><i class="fa fa-chevron-down"></i></a></div>
                            <div id="panel-inf1" class="content panel-size">                                                                                                                                                                                                                                                                                                
                                                                                                                                            	                            								
								
                            </div>                                                
                        </li>                                                                            
                  	</ul>
			    </div>
    		</div>
    		<!-- // Defaulters Safe -->
		</div>

		<div class="widget-column">
			<!-- Staff List -->
        	<div class="widget staff-list">
        		<div class="title row">
					<div class="col-md-8 bluetitle"><span class="fa fa-paste"></span> Staff Lists
                    </div>                                    
					<div class="col-md-4 small-add-btn"></div>
				</div>
					<ul class="staff-slider">
						<li>
							<strong><a href="">Pharell Williams</a></strong>
							<span class="pull-right"><a href=""><i class="fa fa-eye-slash"></i> deactivate</a></span>
							<div>Math (JSS1A), English (SS3C), French (SS5B)</div>
						</li>
						<li>
							<strong><a href="">Pharell Williams</a></strong>
							<span class="pull-right"><a href=""><i class="fa fa-eye-slash"></i> deactivate</a></span>
							<div>Math (JSS1A), English (SS3C), French (SS5B)</div>
						</li>
						<li>
							<strong><a href="">Pharell Williams</a></strong>
							<span class="pull-right"><a href=""><i class="fa fa-eye-slash"></i> deactivate</a></span>
							<div>Math (JSS1A), English (SS3C), French (SS5B)</div>
						</li>
						<li>
							<strong><a href="">Pharell Williams</a></strong>
							<span class="pull-right"><a href=""><i class="fa fa-eye-slash"></i> deactivate</a></span>
							<div>Math (JSS1A), English (SS3C), French (SS5B)</div>
						</li>
						<li>
							<strong><a href="">Pharell Williams</a></strong>
							<span class="pull-right"><a href=""><i class="fa fa-eye-slash"></i> deactivate</a></span>
							<div>Math (JSS1A), English (SS3C), French (SS5B)</div>
						</li>
					</ul>
        	</div>
        	<!-- // Staff list -->
		</div>

	</div>
</div>

<!--Add Task Modal-->
<div id="addTask" class="lightbox reveal-modal invite small" data-reveal>

      <h1>Add New Task</h1>
          <section>
                <div class="sec-row">
                      <?= form_open('tasks/add',['class'=>'taskform']); ?>
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
                            <input type="text" name="activity" placeholder="e.g Do my laundry...">
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
<div id="manageNotice" class="lightbox reveal-modal" data-reveal>               
      
      <h1>Manage Noticeboard</h1>           
      
      <div class="row content tab-area">
            <div class="large-3 columns">
                  <ul class="nav tabs" data-tab-content="course-settings">
                        <li class="active">
                              <a class="tab" data-tab-id = "all-notice">All Notices</a>
                        </li>
                        <li>
                              <a class="tab" data-tab-id = "article">Add Article</a>
                        </li>
                        <li>
                              <a class="tab" data-tab-id = "image">Add Image</a>
                        </li>
                        <li>
                              <a class="tab" data-tab-id = "video">Add Video</a>
                        </li>
                        <li>
                              <a class="tab" data-tab-id = "gallery">Add Gallery</a>
                        </li>
                  </ul>
            </div>
            <div class="large-9 columns tab-content" id="course-settings">
                  <div id="all-notice" class="active">
                        
                        <h2 class="pg-title"><i class="fa fa-bullhorn"></i> All Notices</h2>
                        <!--Table-->
                        <div class="tbl tbl-6">

                              <!--Header-->
                              <div class="tbl-row header">
                              		<div></div>
                                    <div><h4>TITLE</h4></div>
                                    <div><h4>DETAILS</h4></div>
                                    <div><h4>TYPE</h4></div>
                                    <div><h4>DATE</h4></div>
                                    <div><h4>ACTIONS</h4></div>
                              </div>
                            <? foreach($notices as $key => $notice): ?>
                              <!-- Row -->
                              <div class="accordion row-temp">
                                    <div class="tbl-row">
                                    	<div></div>
										<div><p class="title-mirror"><?= $notice->title; ?></p></div>
										<div><p class="desc-mirror"><?= $notice->details; ?></p></div>
										<div><p><?= $notice->type; ?></p></div>
										<div><p title="<?= date('d/m/Y',$notice->created); ?>"><?= date('d/m/Y',$notice->created); ?></p></div>
										<div>
										    <a data-toggle-panel="panel1"><i class="fa fa-edit"></i>Edit</a>
										    <a href="noticeboard/remove/<?= $notice->id ?>"><i class="fa fa-trash-o"></i>Delete</a>
										</div>                                    
                                    </div>
                              </div>
                              <!-- // Row -->
                          	<? endforeach; ?>
                        </div>
                        
                  </div><!--End the All Notices Tab-->

                  <div id="article">
                        
                        <h2 class="pg-title"><i class="fa fa-file-text"></i> Add Article</h2>
						<div class="sec-row">
						    <?= form_open('noticeboard/create/article'); ?>
						    <div class="sub-row">
						          <p>Title</p>
						          <input type="text" name="title">
						    </div>
						    <div class="sub-row">
						          <p>Details</p>
						          <textarea name="details"></textarea>
						    </div>
						    <br>
						    <div class="tbl-row">
						          <button class="ios-button nature edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
						    </div>
						    <?= form_close(); ?>
						</div>
                  </div><!--End Article Tab-->

                  <div id="image">
                        
                        <h2 class="pg-title"><i class="fa fa-file-image-o"></i> Add Image</h2>
						<div class="sec-row">
						    <?= form_open_multipart('noticeboard/create/image'); ?>
						    <div class="sub-row">
						          <p>Title</p>
						          <input type="text" name="title">
						    </div>
						    <div class="sub-row">
						        <p>Upload Image</p>
						        <input type="file" name="file">
						    </div>
						    <br>
						    <div class="tbl-row">
						          <button class="ios-button nature edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
						    </div>
						    <?= form_close(); ?>
						</div>
                  </div><!--End Image Tab-->

                  <div id="video">
                        
                        <h2 class="pg-title"><i class="fa fa-file-video-o"></i> Add Video</h2>
						    <?= form_open_multipart('upload/upload_video/notice'); ?>
						<div class="sec-row">
						    <div class="sub-row">
						          <p>Title</p>
						          <input type="text" name="title">
						    </div>
						    <div class="sub-row">
						    	<p>Upload Video:</p>
						    	<input type="file" name="file">
						    </div>
						    <div class="sub-row">
						    	<span class="acenter">OR</span>
						    </div>
						    <div class="sub-row">
						          <p>Enter video URL:</p>
						          <input type="url" name="details" size="60" placeholder="https://www.youtube.com/watch?v=ip6RvnlmLsE" value="https://www.youtube.com/watch?v=ip6RvnlmLsE">
						    </div>
						    <br>
						    <input type="hidden" name="type" value="video">
						    <div class="tbl-row">
						          <button class="ios-button nature edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
						    </div>
						    <?= form_close(); ?>
						</div>
                  </div><!--End Video Tab-->

                  <div id="gallery">
                        
                        <h2 class="pg-title"><i class="fa fa-file-archive-o"></i> Add Gallery</h2>
						<div class="sec-row">
						    <?= form_open_multipart('noticeboard/create/gallery'); ?>
						    <div class="sub-row">
						          <p>Title</p>
						          <input type="text" name="title">
						    </div>
						    <div class="sub-row">
						          <p>Details</p>
						          <textarea name="details"></textarea>
						    </div>
						    <div class="sub-row">
									<input class="row-temp" id="photoimg" type="file" name="files[]" multiple="multiple">
						    </div>
						    <br>
						    <div class="tbl-row">
						          <button class="ios-button nature edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
						    </div>
						    <?= form_close(); ?>
						</div>
                  </div><!--End Gallery Tab-->

                </div>

                  <a class="close-reveal-modal">&#215;</a>                         
            </div>
      </div>

<!-- Application Lightbox -->
<div id="AdminPeopleModal" class="lightbox reveal-modal" data-reveal>			
	
	<h1>People</h1>		
	
	<div class="row content tab-area">
		<div class="large-3 columns">
			<ul class="nav tabs" data-tab-content="admin-people">
				<li class="active">
					<a class="tab" data-tab-id = "students">Students</a>
				</li>
				<li>
					<a class="tab" data-tab-id = "staff">Staff</a>
				</li>
				<li>
					<a class="tab" data-tab-id = "report">Report Sheet</a>
				</li>
			</ul>
		</div>
		<div class="large-9 columns tab-content" id="admin-people">
			<!-- Students -->
			<div id="students" class="active">
				<h2 class="pg-title"><i class="fa fa-money"></i> Students</h2>

				<!--Table-->
				<div class="tbl">

					<!--Header-->
					<div class="tbl-row header">
						<div></div>
						<div><h4>NAME</h4></div>
						<div><h4>CLASS</h4></div>
						<div><h4>GENDER</h4></div>
						<div><h4>PHONE NUMBER</h4></div>
						<div><h4>ACTIONS</h4></div>
					</div>
					
					<section>
						<!--Row-->
						<div class="accordion row-temp">
							<div class="tbl-row">
								<div><p>1.</p></div>
								<div><p class="title-mirror">My Name</p></div>
								<div><p class="desc-mirror">SS3 C</p></div>
								<div><p>M</p></div>
								<div><p>08034567676</p></div>
								<div>
									<p>
										<a data-toggle-panel="panel90"><i class="fa fa-edit"></i>Edit</a>
										<a><i class="fa fa-trash-o"></i>Delete</a>
									</p>
								</div>
							</div>
							<div id="panel90" class="content">
                                <div class="sec-row">
                                	<div class="sub-row">
                                        <p>Name</p>
                                        <input type="text" value="" name="title" class="text-mirror" data-mirror="title-mirror"/>
                                    </div>
                                    <div class="sub-row">
                                        <p>Class</p>
                                        <div>
											<select name="classes">
	                                              <option>SS1 A</option>
	                                              <option>SS2 B</option>
	                                              <option>SS3 C</option>
	                                        </select>
										</div>	
                                    </div>
                                    <div class="sub-row">
                                      	<p>Gender</p>
                                        <div>
                                            <div>                                                             
                                                <input type="radio" name="subscription"/>                                                 
                                                    <label>Male</label>                                                                 
                                                </div>
                                                <div>
                                                    <input type="radio" name="subscription"/>                                                 
                                                    <label>Female</label>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="sub-row">
                                        <p>Parent's/Gaurdian's Phone Number</p>
                                        <input type="text" value="" name="title" class="text-mirror" data-mirror="title-mirror"/>
                                    </div>

                                    <div class="tbl-row">
                                        <button class="ios-button citrus edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
                                    </div>
                                </div>
                         	</div>
                     	</div>

                     	<!--Template Row-->
						<div class="accordion row-temp template">
							<div class="tbl-row">
								<div><p>1.</p></div>
								<div><p class="title-mirror">My Name</p></div>
								<div><p class="desc-mirror">SS3 C</p></div>
								<div><p>M</p></div>
								<div><p>08034567676</p></div>
								<div>
									<p>
										<a data-toggle-panel="panel91"><i class="fa fa-edit"></i>Edit</a>
										<a><i class="fa fa-trash-o"></i>Delete</a>
									</p>
								</div>
							</div>
							<div id="panel91" class="content">
                                <div class="sec-row">
                                	<div class="sub-row">
                                        <p>Name</p>
                                        <input type="text" value="" name="title" class="text-mirror" data-mirror="title-mirror"/>
                                    </div>
                                    <div class="sub-row">
                                        <p>Class</p>
                                        <div>
											<select name="classes">
	                                              <option>SS1 A</option>
	                                              <option>SS2 B</option>
	                                              <option>SS3 C</option>
	                                        </select>
										</div>	
                                    </div>
                                    <div class="sub-row">
                                      	<p>Gender</p>
                                        <div>
                                            <div>                                                             
                                                <input type="radio" name="subscription"/>                                                 
                                                    <label>Male</label>                                                                 
                                                </div>
                                                <div>
                                                    <input type="radio" name="subscription"/>                                                 
                                                    <label>Female</label>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="sub-row">
                                        <p>Parent's/Gaurdian's Phone Number</p>
                                        <input type="text" value="" name="title" class="text-mirror" data-mirror="title-mirror"/>
                                    </div>

                                    <div class="tbl-row">
                                        <button class="ios-button citrus edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
                                    </div>
                                </div>
                         	</div>
                     	</div>
                     	<!--Template Row-->

					</section>

					<div class="tbl-row">
						<button class="ios-button nature add-more"><i class="fa fa-plus-square-o"></i> Add More</button>
					</div>
				</div>
			</div><!--End Student Tab-->

			<!-- Staff -->
			<div id="staff">
				
				<h2 class="pg-title"><i class="fa fa-user"></i> Staff</h2>

				<!--Table-->
				<div class="tbl tbl-5">

					<!--Header-->
					<div class="tbl-row header">
						<div></div>
						<div><h4>NAME</h4></div>
						<div><h4>ROLE</h4></div>
						<div><h4>PHONE NUMBER</h4></div>
						<div><h4>ACTIONS</h4></div>
					</div>

					<section>
						<!--Row-->
						<div class="accordion row-temp">
							<div class="tbl-row">
								<div><p>1.</p></div>
								<div><p class="title-mirror">My Name</p></div>
								<div><p class="desc-mirror">Teacher</p></div>
								<div><p>08034567676</p></div>
								<div>
									<p>
										<a data-toggle-panel="panel92"><i class="fa fa-edit"></i>Edit</a>
										<a><i class="fa fa-trash-o"></i>Delete</a>
									</p>
								</div>
							</div>
							<div id="panel92" class="content">
	                            <div class="sec-row">
	                            	<div class="sub-row">
	                                    <p>Name</p>
	                                    <input type="text" value="" name="title" class="text-mirror" data-mirror="title-mirror"/>
	                                </div>
	                                <div class="sub-row">
	                                    <p>Role</p>
	                                    <div>
											<select name="roles">
	                                              <option>Teacher</option>
	                                              <option>Proprietor</option>
	                                        </select>
										</div>	
	                                </div>
	                                <div class="sub-row">
	                                    <p>Phone Number</p>
	                                    <input type="text" value="" name="number" class="text-mirror" data-mirror="title-mirror"/>
	                                </div>

	                                <div class="tbl-row">
	                                    <button class="ios-button citrus edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
	                                </div>
	                            </div>
	                     	</div>
	                 	</div>

	                 	<!--Template Row-->
						<div class="accordion row-temp template">
							<div class="tbl-row">
								<div><p>1.</p></div>
								<div><p class="title-mirror">My Name</p></div>
								<div><p class="desc-mirror">Teacher</p></div>
								<div><p>08034567676</p></div>
								<div>
									<p>
										<a data-toggle-panel="panel94"><i class="fa fa-edit"></i>Edit</a>
										<a><i class="fa fa-trash-o"></i>Delete</a>
									</p>
								</div>
							</div>
							<div id="panel94" class="content">
	                            <div class="sec-row">
	                            	<div class="sub-row">
	                                    <p>Name</p>
	                                    <input type="text" value="" name="title" class="text-mirror" data-mirror="title-mirror"/>
	                                </div>
	                                <div class="sub-row">
	                                    <p>Role</p>
	                                    <div>
											<select name="roles">
	                                              <option>Teacher</option>
	                                              <option>Proprietor</option>
	                                        </select>
										</div>	
	                                </div>
	                                <div class="sub-row">
	                                    <p>Phone Number</p>
	                                    <input type="text" value="" name="number" class="text-mirror" data-mirror="title-mirror"/>
	                                </div>

	                                <div class="tbl-row">
	                                    <button class="ios-button citrus edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
	                                </div>
	                            </div>
	                     	</div>
	                 	</div>
	                 	<!--Template Row-->

					</section>

					<div class="tbl-row">
						<button class="ios-button nature add-more"><i class="fa fa-plus-square-o"></i> Add More</button>
					</div>
				</div>
			</div><!--End Staff-->


			<!-- Report -->
			<div id="report">
				
				<h2 class="pg-title"><i class="fa fa-book"></i> Report Sheet</h2>


					<div class="report-tbls">
						<!--Name Table-->
						<table class="table-report">

					    	<tr class="row-light-green">
					        	<th colspan="2">Student</th>
					      	</tr>

					      	<tr class="row-light-green">
					          	<th>S/N</th>
					          	<th>Name</th>
					      	</tr>

					      	<tr>
					          	<td>1</td>
					          	<td>Abike Dabiri</td>
					      	</tr>
					      	<tr>
					          	<td>2</td>
					          	<td>Nnamdi Chikwu</td>
					      	</tr>
					      	<tr>
					          	<td>3</td>
					          	<td>Jaja Okpobo</td>
					      	</tr>
					      	<tr>
					          	<td>4</td>
					          	<td>John Doe</td>
					      	</tr>
					      	<tr>
					          	<td>5</td>
					          	<td>John Doe</td>
					      	</tr>
					      	<tr>
					          	<td>6</td>
					          	<td>John Doe</td>
					      	</tr>
					      	<tr>
					          	<td>7</td>
					          	<td>John Doe</td>
					      	</tr>
					  	</table>
					  	<!-- Name Table -->
					  	<!--Overall Table-->
						<table class="table-report">

					    	<tr class="row-pink">
					          	<th colspan="4">Overall Performance</th>
					      	</tr>

					      	<tr class="row-pink">
					          	<th style="width:20px;">No. of Subjects</th>
					          	<th>Total</th>
					          	<th>Average</th>
					          	<th>Position</th>
					      	</tr>

					      	<tr>
					          	<td>8</td>
					          	<td>847</td>
					          	<td>54</td>
					          	<td>2</td>
					      	</tr>
					      	<tr>
					          	<td>8</td>
					          	<td>847</td>
					          	<td>54</td>
					          	<td>2</td>
					      	</tr>
					      	<tr>
					          	<td>8</td>
					          	<td>847</td>
					          	<td>54</td>
					          	<td>2</td>
					      	</tr>
					      	<tr>
					          	<td>8</td>
					          	<td>847</td>
					          	<td>54</td>
					          	<td>2</td>
					      	</tr>
					      	<tr>
					          	<td>8</td>
					          	<td>847</td>
					          	<td>54</td>
					          	<td>2</td>
					      	</tr>
					      	<tr>
					          	<td>8</td>
					          	<td>847</td>
					          	<td>54</td>
					          	<td>2</td>
					      	</tr>
					      	<tr>
					          	<td>8</td>
					          	<td>847</td>
					          	<td>54</td>
					          	<td>2</td>
					      	</tr>
					  	</table>
					  	<!--Overall Table -->

					  	<!--Subject Table-->
						<table class="table-report">

					    	<tr class="row-light-green">
					        	<th colspan="3">Mathematics</th>
					      	</tr>

					      	<tr class="row-light-green">
					          	<th>Score</th>
					          	<th>Grade</th>
					          	<th>Position</th>
					      	</tr>

					      	<tr>
					          	<td>54</td>
					          	<td>C4</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>62</td>
					          	<td>B3</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>39</td>
					          	<td>E6</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>54</td>
					          	<td>C4</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>62</td>
					          	<td>B3</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>39</td>
					          	<td>E6</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>39</td>
					          	<td>E6</td>
					          	<td>8</td>
					      	</tr>
					  	</table>
					  	<!-- Subject Table -->

						<!--Subject Table-->
						<table class="table-report">

					    	<tr class="row-light-green">
					        	<th colspan="3">Mathematics</th>
					      	</tr>

					      	<tr class="row-light-green">
					          	<th>Score</th>
					          	<th>Grade</th>
					          	<th>Position</th>
					      	</tr>

					      	<tr>
					          	<td>54</td>
					          	<td>C4</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>62</td>
					          	<td>B3</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>39</td>
					          	<td>E6</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>54</td>
					          	<td>C4</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>62</td>
					          	<td>B3</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>39</td>
					          	<td>E6</td>
					          	<td>8</td>
					      	</tr>
					      	<tr>
					          	<td>39</td>
					          	<td>E6</td>
					          	<td>8</td>
					      	</tr>
					  	</table>
					  	<!-- Subject Table -->
					</div>
				</div>
			</div><!--End Report->


		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
</div>

<!-- Application Lightbox -->
<div id="AdminDashboardModal" class="lightbox reveal-modal" data-reveal>			
	
	<h1>Jagbajantis High School</h1>		
	
	<div class="row content tab-area">
		<div class="large-3 columns">
			<ul class="nav tabs" data-tab-content="admin-dashboard">
				<li class="active">
					<a class="tab" data-tab-id = "school-profile">School Profile</a>
				</li>
				<li>
					<a class="tab" data-tab-id = "academic-calendar">Academic Calendar</a>
				</li>
				<li>
					<a class="tab" data-tab-id = "admin-account">Admin Account</a>
				</li>
			</ul>
		</div>
		<div class="large-9 columns tab-content" id="admin-dashboard">
			<!-- School Profile -->
			<div id="school-profile" class="active">
				<h2 class="pg-title"><i class="fa fa-user"></i> School Profile</h2>
				<section>    

					<!--Section Row-->
					<div class="sec-row">
						<div class="sub-row">
							<p>School Name*</p>
							<div>
								<input type="text" placeholder="My School Name"/>	
							</div>								
						</div>					
					</div>

					<!--Section Row-->
					<div class="sec-row">
						<div class="sub-row">
							<p>About Us</p>
							<div>
								<textarea placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"></textarea>
							</div>
						</div>							
					</div>

					<!--Section Row-->
					<div class="sec-row">
						<div class="sub-row">
							<p>Address</p>
							<div>
								<input type="text" placeholder="My Address"/>	
							</div>						
						</div>						
					</div>

					<!--Section Row-->
					<div class="sec-row">
						<div class="sub-row">
							<p>Proprietor Name</p>
							<div>
								<input type="text" placeholder="My Name"/>	
							</div>						
						</div>                               
					</div>

					<!--Section Row-->
					<div class="sec-row">
						<div class="sub-row">
							<p>Phone Number</p>
							<div>
								<input type="text" placeholder="+2348076564535"/>	
							</div>						
						</div>	                            
					</div>

					<!--Section Row-->
					<div class="sec-row">
						<div class="sub-row">
							<p>Website</p>
							<div>
								<input type="text" placeholder="My Website"/>	
							</div>						
						</div>	
					</div>

					<!--Section Row-->
                    <div class="sec-row">
                        <div class="sub-row">
                            <p>School Logo*</p>
                            <div>
                                <div>             
                                      <div class="passport"><?= check_image($user_details->image); ?></div>
                                </div>
                                <div>             
                                      <h4></h4>
                                      <p><a href="#" class="upload">Upload Photo  <i class="fa fa-upload"></i></a></p>
                                </div>      
                            </div>                              
                        </div>                                              
                    </div> 
				</section>

				<div class="tbl-row">
                    <button class="ios-button citrus edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
                </div>
			</div><!--End School Profile Tab-->

			<!-- Academic Calendar -->
			<div id="academic-calendar">
				
				<h2 class="pg-title"><i class="fa fa-calendar"></i> Academic Calendar</h2>
				<section>
					<!--Section Row-->
					<div class="sec-row">
						<p class="subtitle">Specify any subject or fields you are interested in:</p>
						<div class="sub-row">
							<p>Current Session</p>
							<div>
								<select name="session">
                                    <option>2013 / 2014</option>
                                </select>
							</div>								
						</div>
						<div class="sub-row">
							<p>Current Term</p>
							<div>
								<select name="term">
                                    <option>1st Term</option>
                                    <option>2nd Term</option>
                                    <option>3rd Term</option>
                                </select>
							</div>
						</div>	
						<div class="sub-row">
							<p>Term Start Date</p>
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
							<p>Term End Date</p>
							<div class="form-group row">
                                  <div class="col-xs-8">
                                        <div class="input-group date" id="dp3" data-date="<?= date('d-m-Y',time()); ?>" data-date-format="dd-mm-yyyy">
                                              <input class="form-control" type="text" readonly="" value="<?= date('d-m-Y',time()); ?>" name="date">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                  </div>
                            </div>						
						</div>							
					</div>

				</section>

				<div class="tbl-row">
                    <button class="ios-button citrus edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
                </div>
			</div><!--End Academic Calendar-->

			<!-- Admin Account -->
			<div id="admin-account">
				
				<h2 class="pg-title"><i class="fa fa-calendar"></i> Admin Account Settings</h2>
				<section>
					<!--Section Row-->
					<div class="sec-row">
						<p class="subtitle">Set the username and password for your school's admin:</p>
						<div class="sub-row">
							<p>Email</p>
							<div>
								<input type="text" placeholder="myemail@mail.com"/>	
							</div>						
						</div>	
						<div class="sub-row">
							<p>Password</p>
							<div>
								<input type="password" placeholder="My Email"/>	
							</div>						
						</div>	
						<div class="sub-row">
							<p>Confirm Password</p>
							<div>
								<input type="password" placeholder="My Email"/>	
							</div>						
						</div>								
					</div>

				</section>

				<div class="tbl-row">
                    <button class="ios-button citrus edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
                </div>
			</div><!--End Admin Account-->				
		</div>
	</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
</div>
<div class="lightbox walkthrough-content">
	<h1>Account Setup Guide</h1>		
			
	<div class="row content tab-area">
		<div class="large-3 columns">
			<ul class="nav tabs" data-tab-content="walkthrough-tab-content">
				<li class="active">
					<a class="tab" data-tab-id = "walkthrough-welcome">Welcome</a>
				</li>
				<li>
					<a class="tab" data-tab-id = "step1">Step <span class="step-count">1</span></a>
				</li>
				<li>
					<a class="tab" data-tab-id = "step2">Step <span class="step-count">2</span></a>
				</li>
				<li>
					<a class="tab" data-tab-id = "step3">Step <span class="step-count">3</span></a>
				</li>
				<li>
					<a class="tab" data-tab-id = "step4">Step <span class="step-count">4</span></a>
				</li>
				<li>
					<a class="tab" data-tab-id = "step5">Step <span class="step-count">5</span></a>
				</li>
				<li>
					<a class="tab" data-tab-id = "step6">Step <span class="step-count">6</span></a>
				</li>
				<li>
					<a class="tab get-level-grade-list" data-tab-id = "step7">Step <span class="step-count">7</span></a>
				</li>
				<li>
					<a class="tab get-level-arm-list" data-tab-id = "step8">Step <span class="step-count">8</span></a>
				</li>
			</ul>
		</div>
		<div class="large-9 columns tab-content" id="walkthrough-tab-content">
	
			<!-- Welcome -->
			<div id="walkthrough-welcome" class="active">

				<section>						
					<p>Hi, <strong><?=$user_full_name;?></strong></p>	
				   	<p class="simer">Welcome to <strong>Simer!</strong></p>			
				   	<p>The next few steps will help you setup your account properly</p>
				   	<a class="btn btn-large ios-button next nature">Start Account Setup Guide Now <i class="fa fa-paper-plane"></i></a>			
				</section>
			</div><!--End Welcome-->

			<!-- Step 1 -->
			<div id="step1">
				
				<h2 class="pg-title"><i class="fa fa-user"></i> School Profile</h2>

				<section>    

					<!--Section Row-->
                    <div class="sec-row">
                        <div class="sub-row">
                            <p>School Logo*</p>
                            <div>
                                <div>             
                                    <div class="dropzone-previews passport"><img class = "dropzone-previews" id = "passport-img" src=""/></div>
                                </div>
                                <div>             
                                      <h4></h4>
                                      <p><a data-url = "<?=site_url('/home');?>" class="form-photo upload">Upload Photo  <i class="fa fa-upload"></i></a></p>
                                </div>      
                            </div>                              
                        </div>                                              
                    </div> 

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
						
						<div class="col-md-4">							
							<p>Country</p>
							<div>
								<select>
									<option>Option 1</option>
								</select>	
							</div>	
						</div>
						<div class="col-md-4">							
							<p>State</p>
							<div>
								<select>
									<option>Option 1</option>
								</select>	
							</div>	
						</div>
						<div class="col-md-4">							
							<p>Local Govt. Area</p>
							<div>
								<select>
									<option>Option 1</option>
								</select>	
							</div>	
						</div>

						<div class="sub-row col-md-12">
							<p>Address</p>
							<div>
								<textarea>
									
								</textarea>
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
							<p>Email</p>
							<div>
								<input type="text" placeholder="My Email"/>	
							</div>						
						</div>
						<div class="sub-row">
							<p>Website</p>
							<div>
								<input type="text" placeholder="My Website"/>	
							</div>						
						</div>	
					</div>				
					<div class="sec-row">                        	                                            	
                    	<button class="ios-button nature pull-right next">Next <i class="fa fa-arrow-right"></i></button>
						<button class="ios-button citrus pull-right previous"><i class="fa fa-arrow-left"></i> Previous</button>		                    
	                </div>
			</div><!--End Step 1-->										

			<!-- Step 2 -->
			<div id="step2">
				
				<h2 class="pg-title"><i class="fa fa-calendar"></i> Academic Calendar</h2>

				<section>
					<!--Section Row-->
					<div class="sec-row">																		
						<div class="row mag-bottom">
							<div class="col-md-6">
								<p>Current Session</p>
								<div>
									<?=get_session_dropdown();?>
								</div>		
	                        </div>		
	                        <div class="col-md-6">
								<p>Current Term</p>
								<div>
									<select name="term">
	                                    <option>1st Term</option>
	                                    <option>2nd Term</option>
	                                    <option>3rd Term</option>
	                                </select>
								</div>						
							</div>			
						</div>
						<div class="row mag-bottom">
							<div class="col-md-6">
								<p>Term Start Date</p>
								<div class="form-group row">
	                                  <div class="col-xs-12">
	                                        <div class="input-group date" id="dp3" data-date="<?= date('d-m-Y',time()); ?>" data-date-format="dd-mm-yyyy">
	                                              <input class="form-control" type="text" readonly="" value="<?= date('d-m-Y',time()); ?>" name="date">
	                                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	                                        </div>
	                                  </div>
	                            </div>	
	                        </div>		
	                        <div class="col-md-6">
								<p>Term End Date</p>
								<div class="form-group row">
	                                  <div class="col-xs-12">
	                                        <div class="input-group date" id="dp3" data-date="<?= date('d-m-Y',time()); ?>" data-date-format="dd-mm-yyyy">
	                                              <input class="form-control" type="text" readonly="" value="<?= date('d-m-Y',time()); ?>" name="date">
	                                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	                                        </div>
	                                  </div>
	                            </div>						
							</div>			
						</div>																
					</div>
					<div class="sec-row">                        	                                            	
                    	<button class="ios-button nature pull-right next">Next <i class="fa fa-arrow-right"></i></button>
						<button class="ios-button citrus pull-right previous"><i class="fa fa-arrow-left"></i> Previous</button>		                    
	                </div>
				</section>                       
			</div><!--End Step 2-->

			<!-- Step 3 -->
			<div id="step3">
				
				<h2 class="pg-title"><i class="fa fa-clipboard"></i> Assessment Format</h2>
                <div class="alert alert-info"><i class="fa fa-info-circle"></i> Specify the assessment format for your school. Click Edit to Change The Default Values.</div>                  

				<section class="section-control">

	                <!--Table-->
	                <div class="tbl tbl-3">

		                <!--Header-->
	                    <div class="tbl-row header">
	                        <div></div>
	                        <div><h4>TITLE</h4></div>
	                        <div><h4>MAX SCORE</h4></div> 
	                        <div><h4>ACTIONS</h4></div> 
	                    </div>
	                   	<section>
		                    <!-- Template Row-->
		                    <div class="accordion row-temp">
		                          <div class="tbl-row">
		                                
		                                <div></div>
		                                <div><p class="title-mirror" data-toggle-panel="panelca">Continous Assessment</p></div>
		                                <div><p class="max-score-show" data-toggle-panel="panelca">30</p></div>
		                                <div>
		                                    <a data-toggle-panel="panelca"><i class="fa fa-edit"></i>Edit</a>                                                      
		                                </div> 
		                          </div>
		                          <div id="panelca" class="content panel-size">
		                                
		                                <div class="sec-row">
			                                <div class="sub-row">
			                                    <p>MAX SCORE</p>
			                                    <input type="text" name="max-score" class="text-mirror" data-mirror-context="accordion" data-mirror="max-score-show"/>
			                                </div>
			                                <div class="sub-row">
			                                      <div class="alert alert-danger"><i class="fa fa-info-circle"></i> Add Assessments That Should Comprise The Continious Assessment.</div>

			                                      <!--Table-->
			                                      <div class="tbl tbl-2">
			                                            <!--Header-->
			                                            <div class="tbl-row header">
			                                                <div></div>
			                                                <div><h4>Name</h4></div>
			                                                <div><h4>Abbreviation</h4></div>		                                                  
			                                                <div><h4>Marks</h4></div>
			                                            </div>

			                                            <div class="tbl-row row-temp">
			                                                <div><p></p></div>
			                                                <div><input type="text" placeholder="Assignment 1" name="title"/></div>
			                                                <div><input type="text" placeholder="ASS1" name="title"/></div> 		                                                  
			                                                <div><input type="number" placeholder="30"></div>                                  
			                                            </div>  

			                                            <div class="tbl-row">			                                            	
															<button class="ios-button nature add-more" data-context="tbl"><i class="fa fa-plus-square"></i> Add More Assessments</button>
			                                            </div>             	                                                  
			                                      </div>
			                                </div>
			                            </div>                                                
		                          </div>
		                    </div>
		                    <!-- // Template Row -->

		                    <!-- Template Row-->
		                    <div class="accordion row-temp">
		                          <div class="tbl-row">
		                                
		                                <div></div>
		                                <div><p data-toggle-panel="panelexam" class="title-mirror">Examination</p></div>
		                                <div><p data-toggle-panel="panelexam" class="max-exam-score-show">70</p></div>
		                                <div>
		                                    <a data-toggle-panel="panelexam"><i class="fa fa-edit"></i>Edit</a>                                                      
		                                </div> 
		                          </div>
		                          <div id="panelexam" class="content panel-size">
		                                <div class="sec-row">                                               
			                                <div class="col-md-4"><p>MAX SCORE</p></div>
			                                <div class="col-md-4"><input type="text" name="max-score" class="text-mirror" data-mirror-context="accordion" data-mirror="max-exam-score-show"/></div>                                                                                                                                    
			                            </div>
		                          </div>
		                    </div>
		                    <!-- // Template Row -->
		            	</section>
	                </div>
	                <div class="sec-row">                        	                                            	
                    	<button class="ios-button nature pull-right next">Next <i class="fa fa-arrow-right"></i></button>
						<button class="ios-button citrus pull-right previous"><i class="fa fa-arrow-left"></i> Previous</button>		                    
	                </div>
	            </section>				                    
			</div><!--End Step 3-->

			<!-- Step 4 -->
			<div id="step4">
				
				<h2 class="pg-title"><i class="fa fa-list-alt"></i> Subjects</h2>
				<div class="alert alert-info"><i class="fa fa-info-circle"></i> Add Subjects You Do In Your School.</div>

				<section class="section-control">
					                                    
                    <!--Table-->
                    <div class="tbl tbl-2">

                          <!--Header-->
                          <div class="tbl-row header">
                                <div></div>
                                <div><h4>NAME</h4></div>
                                <div><h4>ACTIONS</h4></div>
                          </div>

                          <section class="subject-section">

                                <!-- Row -->
                                <div class="accordion row-temp go-parent">
                                      <div class="tbl-row">
                                            <div><p><span class="increment">1</span>.</p></div>
                                            <div data-toggle-panel="panel-subject"><p class="subject-name">Name</p></div>
                                            <div>
                                                  <a data-toggle-panel="panel-subject"><i class="fa fa-edit"></i>Edit</a>
                                                  <a class="unsmart-go"><i class="fa fa-trash-o"></i>Delete</a>
                                            </div>                                    
                                      </div>
                                      <div id="panel-subject" class="content panel-size">
                                            <div class="sec-row">
                                                <div class="sub-row">
                                                    <p>Title</p>
                                                    <input type="text" value="" name="title" class="text-mirror" data-mirror-context="accordion" data-mirror="subject-name"/>
                                                  </div>
                                            </div>
                                      </div>
                                </div>

                                <!--Section Row-->
								<div class="sec-row">
									<button class="ios-button nature add-more" data-context="subject-section"><i class="fa fa-plus-square"></i> Add New Subject</button>
									<button class="ios-button nature edit-save-change next pull-right">Next <i class="fa fa-arrow-right"></i></button>
									<button class="ios-button citrus edit-save-change previous pull-right"><i class="fa fa-arrow-left"></i> Previous</button>	                    
				                </div>
                          </section>
                    </div> 
										
                </section>                       
			</div><!--End Step 4-->

			<!-- Step 5 -->
			<div id="step5">
				
				<h2 class="pg-title"><i class="fa fa-cubes"></i> Grading Systems</h2>
                <div class="alert alert-info"><i class="fa fa-info-circle"></i> Create Grading Systems To Be Assigned The Different Levels In Your School.</div>                  
				

				<section class="section-control">
					                                    
                    <!--Table-->
                    <div class="tbl tbl-2">
                       
                        <section class="subject-section">

                            <!-- Row -->
                            <div class="accordion row-temp go-parent">
                                <div class="tbl-row">
                                        <div><input class="grade-standard-choice" type="checkbox" checked></div>
                                        <div><p class="grade-standard" data-toggle-panel="panel-grades">WAEC SENIOR STANDARD</p></div>
                                        <div>
                                              <a data-toggle-panel="panel-grades"><i class="fa fa-edit"></i>Edit</a>
                                              <a class="unsmart-go"><i class="fa fa-trash-o"></i>Delete</a>
                                        </div>                                    
                                </div>
                                <div id="panel-grades" class="content panel-size">
                                        <div class="sec-row">

                                        	<div class="tbl grades-table">

                                        		<div class="sub-row">
                                                    <p>Title</p>
                                                    <input type="text" name="title" value="" class="text-mirror" data-mirror="grade-standard" data-mirror-context="accordion"/>
                                                </div>

	                                          	<!--Header-->
						                        <div class="tbl-row header">  
						                            <div></div>                                                                    
						                            <div><h4>GRADE</h4></div>
						                        	<div><h4>MINIMUM</h4></div>
						                            <div><h4>REMARKS</h4></div>
						                        </div>

						                        <div class="tbl-row row-temp"> 
						                            <div></div>                                                                       
						                            <div><input type="text" placeholder="A1" name="title"/></div>
						                            <div><input type="number" min="0" max="100" placeholder="70" name="title"/></div> 
						                            <div><input type="text" placeholder="Excellent" name="title"/></div>                                   
						                        </div>

						                        <button class="ios-button nature pull-right add-more" data-context="grades-table"><i class="fa fa-plus-square"></i> Add New Grade</button>
						                    </div>
                                        </div>
                                </div>
                            </div>

                            <!--Section Row-->
							<div class="sec-row">
								<button class="ios-button nature add-more" data-context="subject-section"><i class="fa fa-plus-square"></i> Add New Grade Standard</button>
								<button class="ios-button nature edit-save-change next pull-right">Next <i class="fa fa-arrow-right"></i></button>
								<button class="ios-button citrus edit-save-change previous pull-right"><i class="fa fa-arrow-left"></i> Previous</button>	                    
			                </div>
                        </section>
                    </div> 							
                </section>                                    
			</div><!--End Step 5-->

			<!-- Step 6 -->
			<div id="step6">
				
				<h2 class="pg-title"><i class="fa fa-institution"></i> Class Level Standard</h2>
				<div class="alert alert-info"><i class="fa fa-info-circle"></i> Tick to choose the naming convention of the different levels in your school or edit any of the standards below.</div> 

				<section class="section-control">				

                        <!--Table-->
                        <div class="tbl levels-table tbl-3">

                            <!--Header-->
                            <div class="tbl-row header">
                                <div></div>
                                <div><h4>NAME</h4></div>
                                <div><h4>LEVEL LIST</h4></div>
                                <div><h4>ACTIONS</h4></div>
                            </div>
                            
                            <!--loop over default levels-->
                            <?$count = 0;?>
                            <?foreach($levels as $level_name=>$level_list):?>
                              	<?$count++?>

                              	<!-- Row -->
                                 
                                <div class="tbl-row row-temp">
                                      <div><p><input type="radio" name="level-choice" <?=($count == 1)?"checked":""?>/></p></div>
                                      <div data-toggle-panel="panel-level<?=$count;?>"><p class="level-name"><?= ucwords($level_name);?></p></div>
                                      <div data-toggle-panel="panel-level<?=$count;?>"><p class="level-list"><?= implode(', ',$level_list);?></p></div>
                                      <div>
                                            <a data-toggle-panel="panel-level<?=$count;?>"><i class="fa fa-edit"></i>Edit</a>                                                      
                                      </div>                       
                                      <div id="panel-level<?=$count;?>" style="display:none" class="content panel-size">
                                            <div class="sec-row">
                                                <div class="sub-row">
                                                    <p>Title</p>
                                                    <input type="text" name="title" value="<?=$level_name;?>" class="text-mirror" data-mirror="level-name" data-mirror-context="tbl-row"/>
                                                </div>
                                                <p>Level List</p>
                                                <div class="sub-row">
                                                        
                                                    <div>
                                                        <ol type="1" class="list text-compound-mirror" data-mirror="level-list" data-mirror-context="levels-table">

                                                            <?foreach($level_list as $level):?>
                                                                <li class="row-temp">
                                                                    <div class="input-constraint-100"><input class="level-concat" type="text" value="<?=$level?>"/></div>                                                                             
                                                                </li>
                                                            <?endforeach;?>
                                                            	<button class="ios-button nature pull-right add-more" data-context="list"><i class="fa fa-plus-square"></i> Add Extra Levels</button>
                                                        </ol>                                                        
                                                    </div>                                                                        
                                                </div>
                                            </div>
                                      </div>             
                                </div>
                                  
                                <!--End Row-->
                            <?endforeach;?>                               
                        </div>
                        <div class="sec-row">                        	                        
                        	<button class="ios-button nature add-more" data-context="section-control"><i class="fa fa-plus-square"></i> Add Your Own Standard</button>                                                                                                                                                              
                        	<button data-tab-id="step7" class="ios-button nature pull-right get-level-grade-list next">Next <i class="fa fa-arrow-right"></i></button>
							<button class="ios-button citrus pull-right previous"><i class="fa fa-arrow-left"></i> Previous</button>		                    
		                </div>

                </section>                       
			</div><!--End Step 6-->

			<!-- Step 7 -->
			<div id="step7">
				
				<h2 class="pg-title"><i class="fa fa-cubes"></i> Add Grading Systems per Class Level</h2>
				<div class="alert alert-info"><i class="fa fa-info-circle"></i> Add grading systems to the levels in your school.</div>

				<section class="section-control">
					<ul class="accordion-container">                                    
                        <li class="accordion clearfix temp">
                            <div class="col-md-8"><a class="class-desc" data-toggle-panel="panel-inf1">JSSS 1</a></div>
                            <div class="col-md-4"><a class="pull-right" data-toggle-panel="panel-inf1"><i class="fa fa-chevron-down"></i></a></div>
                            <div id="panel-inf1" class="content panel-size" style="display:none">                                                                                                                                                                                                                                                                                                
                                                                                                                                            	                            								
								<div class="col-md-10 temp">
									<input type="radio" name="grade-level-choice"/>
									<span class="grade-level-choice"></span>
								</div>								
                            </div>                                                
                        </li>                                                    
                  	</ul>
                  	<div class="sec-row">                        	                                            	
                    	<button data-tab-id="step8" class="ios-button nature pull-right get-level-arm-list next">Next <i class="fa fa-arrow-right"></i></button>
						<button class="ios-button citrus pull-right previous"><i class="fa fa-arrow-left"></i> Previous</button>		                    
	                </div>
				</section>		                      
			</div><!--End Step 7-->		

			<!-- Step 8 -->
			<div id="step8">
				
				<h2 class="pg-title"><i class="fa fa-sitemap"></i> Create Class Arms</h2>
				<div class="alert alert-info"><i class="fa fa-info-circle"></i> Add Different Arms To The Levels In Your School.</div>

				<section class="section-control">
					<ul class="accordion-container">                                    
                        <li class="accordion clearfix temp">
                            <div class="col-md-8"><a class="class-desc" data-toggle-panel="panel-inf1">JSSS 1</a></div>
                            <div class="col-md-4"><a class="pull-right" data-toggle-panel="panel-inf1"><i class="fa fa-chevron-down"></i></a></div>
                            <div id="panel-inf1" class="content panel-size">                                                                                                                                                                                                                                                                                                
                                                                                                                                            	                            								
								<div class="col-md-10 row-temp level-arm-cont">
									<span class="class-desc"></span><input type="text" name="level-arm-desc" placeholder="ENTER LEVEL ARM NAME">									
								</div>								
								<button class="ios-button nature level-arm-add-more add-more" data-context="panel-size"><i class="fa fa-plus-square"></i> Add New Level Arm</button>
                            	
                            </div>                                                
                        </li>                                                                            
                  	</ul>
                  	<div class="sec-row">                        	                                            	
                    	<button class="ios-button nature pull-right next">Next <i class="fa fa-arrow-right"></i></button>
						<button class="ios-button citrus pull-right previous"><i class="fa fa-arrow-left"></i> Previous</button>		                    
	                </div>
				</section>				              
			</div><!--End Step 8-->	

			<!-- finish -->
			<div id="walkthrough-finish">

				<section>						
					<p>Good Work, <strong><?=$user_full_name;?></strong></p>	
				   	<p class="simer">You have successfully finished setting up your account on <strong>Simer!</strong></p>			
				   	
				   	<a class="ios-button nature" href="<?=site_url('/home');?>">Go To Your Dashboard Now <i class="fa fa-paper-plane"></i></a>			
				</section>
			</div><!--End finish-->								
		</div>
		<a class="close-walkthrough" href="<?=site_url('/users/home');?>">&#215;</a>
	</div>
</div>

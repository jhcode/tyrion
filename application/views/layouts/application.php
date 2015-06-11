<!DOCTYPE html>
<html lang="en">

	<head>
	    <title><?= $title; ?></title>

	    <!-- Responsive layout meta tag -->

	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <base href = "<?= site_url();?>" />

	    <!-- CSS Includes -->	   
	    <link rel="stylesheet" href='<?= "$foundation_css"; ?>'/>
	    <link rel="stylesheet" href='<?= "$bootstrap_css"; ?>'/>
	    <link rel="stylesheet" href="<?= "$fa_css"; ?>">
	    <link rel="stylesheet" href="<?= "$token_css"; ?>">
	    <link rel="stylesheet" href="<?= "$datepicker_css"; ?>">
	    <link rel="stylesheet" href="<?= "$jscroll"; ?>" />	    
	    <link rel="stylesheet" type="text/css" href='<?= "$app_css"; ?>'/>

	    <link rel="x-icon" type = "image/png" href = "<?= "$simer_ico"; ?>" />

		<!-- Google Fonts -->
	    <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900,100italic,300italic,700italic,900italic' rel='stylesheet'> 
	    <!-- End of CSS Includes -->	  	   
	</head>
	<body>

		<div id="loading-icon"><?= img('assets/imgs/loading_icon.gif'); ?></div>

		<!--Le Header-->
	    <header>

	    	<!--Le Header-->
	    	<div id="logo" class="mycol-2">
	    		<a href="<?= site_url(); ?>"><?= img(base_url('assets/imgs/simer_logo.png')); ?></a>
	    	</div>
	    	<div id="search">	    	
	    		<?= form_open(); ?>
	    			<span class="glyphicon glyphicon-search"></span><?= form_input(array('placeholder'=>'SEARCH FOR EVERYTHING...')); ?>
	    		<?= form_close(); ?>
	    	</div>

	    	<div id="quickies">
	    		<div id="quickie-icons">
                    <a href="" class="quickie-icon glyphicon glyphicon-envelope toggle-notifications" id="quickie-msg"> <span></span></a>
		    		<a href="" class="quickie-icon glyphicon glyphicon-bell toggle-notifications" id="quickie-notifications"> <span></span> </a>		    				    		
	    			<div id ="profile-group">
			    		<div id="profile-stroke">
			    			<a class="profile-pic toggle-notifications"><?= check_image($this->user_details->image); ?></a>
			    		</div>                     
			    	</div>
	    		</div>                                  
	    	</div>
	    	<div class="yield-box">
	    		<div class="content">
                	<div id="bar-notifications">
                        <div class="title">Notifications</div>
                        <span class="scroller">
                        </span>
                    </div>
                    <div id="bar-profile-pic">
                        <span class="signed-in-as">Signed in as <a><?= ucfirst($user_details->firstname)." ".ucfirst($user_details->lastname); ?></a></span>
                        <span class="scroller">
                        	
                        	<div class="bell-box"><a data-reveal-id="ApplicationModal"><i class="fa fa-cogs"></i> Settings</a></div>                        																		
							<div class="bell-box"><a><i class="fa fa-question-circle"></i> Help Center</a></div>
							<div class="bell-box"><a><i class="fa fa-wrench"></i> Report Problem</a></div>						
							<div class="bell-box"><a href="./logout"><i class="fa fa-sign-out"></i>  Logout</a></div>
                        </span>
                    </div>
                    <div id="bar-messages">
                        <div class="title">Messages</div>
                        <span class="scroller">
                        </span>
                        <div class="view-all"><a href="<?=site_url('/messages/home');?>" class="ios-button">View All Messages</a></div>
                    </div>     
	    		</div>
	    	</div>
	    </header><!--End Header-->

    	<!--Le Nav-->
    	<?= $custom_nav?>    	
    	<!--End Nav-->

    	<!--Le Content-->
    	<div class="base-container scroll-area">		
		   	<?= $yield; ?>
		</div>	    		
	    <!--End content-->
	    
		<div id="bottom_clouds"></div>

		<!--Define all modals and Dropdowns bewlow this line-->

		<!-- Search Lightbox -->		
		<div id="SearchModal" class="lightbox reveal-modal" data-reveal>
			
			<h1>Search for Everthing</h1>

			<p>
				Keep Typing...
			</p>

			<h2 class="pg-title" id="typing"></h2>

			<br>

			<div class="row content srch">
				<div class='category'>
					<div class="title">
						<p><i class="fa fa-archive"></i> Shelf</p>
					</div>
					<div class="results">
						<ul>
							<li>Result 1</li>
							<li>Result 2</li>
							<li>Result 3</li>
							<li>Result 4</li>
							<li>Result 1</li>
						</ul>
					</div>
				</div>

				<div class='category'>
					<div class="title">
						<p><i class="fa fa-film"></i> Videos</p>
					</div>
					<div class="results">
						<ul>
							<li>Result 1</li>
							<li>Result 2</li>
							<li>Result 3</li>
							<li>Result 4</li>
						</ul>
					</div>
				</div>

				<div class='category'>
					<div class="title">
						<p><i class="fa fa-file-text-o"></i> Notes</p>
					</div>
					<div class="results">
						<ul>
							<li>Result 1</li>
							<li>Result 2</li>
							<li>Result 3</li>
							<li>Result 4</li>
						</ul>
					</div>
				</div>

				<div class='category'>
					<div class="title">
						<p><i class="fa fa-book"></i> Books</p>
					</div>
					<div class="results">
						<ul>
							<li>Result 1</li>
							<li>Result 2</li>
							<li>Result 3</li>
							<li>Result 4</li>
						</ul>
					</div>
				</div>

				<div class='category'>
					<div class="title">
						<p><i class="fa fa-gamepad"></i> Apps/Games</p>
					</div>
					<div class="results">
						<ul>
							<li>Result 1</li>
							<li>Result 2</li>
							<li>Result 3</li>
							<li>Result 4</li>
						</ul>
					</div>
				</div>
			</div>


			<a class="close-reveal-modal">&#215;</a>
		</div>

		<!-- Application Lightbox -->
		<div id="ApplicationModal" class="lightbox reveal-modal" data-reveal>			
			
			<h1>Settings</h1>		
			
			<div class="row content tab-area">
				<div class="large-3 columns">
					<ul class="nav tabs" data-tab-content="main-settings">
						<li class="active">
							<a class="tab" data-tab-id = "basic-info">Basic info</a>
						</li>
						<li>
							<a class="tab" data-tab-id = "password">Password</a>
						</li>
						<li>
							<a class="tab" data-tab-id = "location">Location</a>
						</li>
						<li>
							<a class="tab" data-tab-id = "social">Social</a>
						</li>
						<li>
							<a class="tab" data-tab-id = "interests">Interests</a>
						</li>
					</ul>
				</div>
				<div class="large-9 columns tab-content" id="main-settings">

					<!-- Basic Information -->
					<div id="basic-info" class="active">
						
						<h2 class="pg-title"><i class="fa fa-user"></i> Basic Info</h2>

						<section>
							<!--Section Row-->
                            <div class="sec-row">
                                <div class="sub-row">
                                    <p>My Photo</p>
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

							<!--Section Row-->
							<div class="sec-row">
								<div class="sub-row">
									<p>Surname</p>
									<div>
										<input type="text" placeholder="My Surname"/>	
									</div>								
								</div>
								<div class="sub-row">
									<p>Firstname</p>
									<div>
										<input type="text" placeholder="My First Name"/>
									</div>
								</div>	
								<div class="sub-row">
									<p>Middle Name</p>
									<div>
										<input type="text" placeholder="My Middle Name"/>	
									</div>						
								</div>													
							</div>						
						
							<!--Section Row-->
							<div class="sec-row">
								<div class="sub-row">
									<p>Email</p>
									<div>
										<input type="email"/>
									</div>
								</div>	
								<div class="sub-row">
									<p>Phone</p>
									<div>
										<input type="email"/>
									</div>
								</div>
								<div class="sub-row">
									<p>About Me</p>
									<div><textarea placeholder="About Me"></textarea></div>	
								</div>							
							</div>     

							<!--Section Row-->
							<div class="sec-row">										
								<button class="ios-button nature"><i class="fa fa-save"></i> Save Changes</button>			
							</div>                   							      
						</section>

					</div><!--End Basic-->										

					<!-- Password -->
					<div id="password">
						
						<h2 class="pg-title"><i class="fa fa-lock"></i> Password</h2>

						<section>
							<!--Section Row-->
                            <div class="sec-row">                                
                                <div class="alert alert-info"><i class="fa fa-info-circle"></i> Change Your Password Here.</div>
                                <!--Section Row-->
								<div class="sec-row">
									<div class="sub-row">
										<p>Current Password</p>
										<div>
											<input type="password"/>	
										</div>								
									</div>
									<div class="sub-row">
										<p>New Password</p>
										<div>
											<input type="password"/>	
										</div>
									</div>	
									<div class="sub-row">
										<p>Re-type New Password</p>
										<div>
											<input type="password"/>	
										</div>
									</div>													
								</div>            

								<!--Section Row-->
								<div class="sec-row">										
									<button class="ios-button nature"><i class="fa fa-save"></i> Save Changes</button>			
								</div                         
                            </div>  
                            
                        </section>                       
					</div><!--End Password Tab-->
	
					<!-- Location -->
					<div id="location">
						
						<h2 class="pg-title"><i class="fa fa-map-marker"></i> Location</h2>

						<section>
							<!--Section Row-->
                            <div class="sec-row">                                
                                <div class="alert alert-info"><i class="fa fa-info-circle"></i> Describe your current Location here.</div>
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
									<button class="ios-button nature"><i class="fa fa-save"></i> Save Changes</button>			
								</div                         
                            </div>                             
                        </section>                       
					</div><!--End Password Tab-->

					<!-- Social -->
					<div id="social">
						
						<h2 class="pg-title"><i class="fa fa-group"></i> Social</h2>

						<section>

							<!--Section Row-->
                            <div class="sec-row">                                
                                <div class="alert alert-info"><i class="fa fa-info-circle"></i> Be Social. Connect your Social Accounts to Simer.</div>  
                                <div class="row post-options">
                                    <div class="post-option facebook">
                                        <a class="icon"><i class="fa fa-facebook"></i></a>
                                        <div class="post-option-info">
                                        	<p>Username</p>
                                        	<p>Not Connected</p>
                                        </div>
                                    </div>
                                    <div class="post-option twitter">
                                        <a class="icon"><i class="fa fa-twitter"></i></a>
                                        <div class="post-option-info">
                                        	<p>@Username</p>
                                        	<p>Not Connected</p>
                                        </div>
                                    </div>
                                    <div class="post-option google-plus">
                                        <a class="icon"><i class="fa fa-google-plus"></i></a>
                                        <div class="post-option-info">
                                        	<p>Username</p>
                                        	<p>Not Connected</p>
                                        </div>
                                    </div>                                                     
                                </div>                                       
                            </div>  
							<!--Section Row-->
							<div class="sec-row">										
								<button class="ios-button nature"><i class="fa fa-save"></i> Save Changes</button>			
							</div
                        </section>                       
					</div><!--End Social Tab-->

					<div id="interests" class="tab-area">
						<h2 class="pg-title"><i class="fa fa-heart"></i> Interests</h2>
						
						<section>
							<!--Section Row-->
							<div class="sec-row">
								<div class="alert alert-info"><i class="fa fa-info-circle"></i> Specify any subjects or fields you are interested in.</div>
								<div class="sub-row">									
									<div class="choose-interests">
										<input type="text" placeholder="Start typing any of your interests here..."/>
									</div>								
								</div>														
							</div>   
							<!--Section Row-->
							<div class="sec-row">										
								<button class="ios-button nature"><i class="fa fa-save"></i> Save Changes</button>			
							</div
							                           
						</section>	
					</div><!--End Interests-->					
				</div>
				<a class="close-reveal-modal">&#215;</a>
			</div>
		</div>
		</div>	

		<!--Show Walkthrough If Applicable-->
		<?if(isset($walkthrough)):?>
			
			<!-- Walkthrough Lightbox -->
			<div id="walkthrough">
				<?= $walkthrough; ?>
			</div>

		<?endif;?>
		<!-- JS Includes -->

	    <script src="<?= "$jquery_js"; ?>"></script>   
        
        <script src="<?= "$modernizer_js"; ?>"></script>

	    <script src='<?= "$bootstrap_js"; ?>'></script>

	    <script src='<?= "$foundation_js"; ?>'></script>

	    <script src='<?= "$bxslider_js"; ?>'></script>

	    <script src='<?= "$datepicker_js"; ?>'></script>

	    <script src='<?= "$jscroll_js"; ?>'></script>

	    <script src='<?= "$mousewheel"; ?>'></script>

	    <script src='<?= "$mwheel"; ?>'></script>	    

	    <script src='<?= "$token_js"; ?>'></script>	    

	    <script src='<?= "$shiftenter_js"; ?>'></script>

	    <script src='<?= "$dropzone_js"; ?>'></script>

	    <script src='<?= "$chart_js"; ?>'></script>

	    <script src='<?= "$app_js"; ?>'></script>
		
	    <!-- End of JS Includes -->
	</body>
</html>

		

<div class="base-container">
	<!-- First Line Row with S-Icons -->
	<div class="row linerow">
		<div class="col-md-10 sline">
			<i class="fa fa-user"></i> Profile
		</div>
		<div class="col-md-2">
			<ul class="social-icons">
				<li><a class="blue" href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a class="sky-blue" href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a class="black" href="#"><i class="fa fa-google-plus"></i></a></li>
				<li><a class="red" href="#"><i class="fa fa-youtube"></i></a></li>
			</ul>
		</div>
	</div>

	<!-- Parent Row for other contents -->
	<div class="row parent-others">
		<!-- Avatar and interest Col -->
		<div class="col-md-3">
			<div class="profile-avatar">
				<?= img(base_url('assets/imgs/avatar.png')); ?>
			</div>
			<div class="profile-interests">
				<h3>Interests</h3>
				<ul>
					<li>Basketball</li>
					<li>Trolling</li>
					<li>Coding</li>
					<li>Killing Zombies</li>
					<li>watching movies</li>
					<li>sleeping</li>
				</ul>
			</div>
		</div>

		<!-- Profile Data Col -->
		<div class="col-md-9">
			<div class="profile-data">
				<h2>Adrian Lamo</h2>
				<h3>Staff</h3>
				<h4>FooBar International School</h4>
				<button type="button" class="btn btn-default"> 
					<i class="fa fa-envelope"></i> Send Message
				</button>

				<!-- Tabs -->
				<ul class="nav nav-tabs os-tabs">
				  <li class="active"><a href="#academic" data-toggle="tab">Academic</a></li>
				  <li><a href="#groups" data-toggle="tab">Groups</a></li>
				  <li><a href="#programs" data-toggle="tab">Programs</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				  <!-- Academic Tab -->
				  <div class="tab-pane active" id="academic">
				  	<div class="row" style="height: 40px;">
				  		<div class="col-md-6" style="height: 40px;background: #555"></div>
				  		<div class="col-md-6" style="height: 40px;background: #888"></div>
				  	</div>
				  </div>
				  <!-- //Academic Tab -->

				  <!-- Groups Tab -->
				  <div class="tab-pane" id="groups">
					<div class="studentThumbs row">
						<div class="col-md-12 row">
							
							<div class="col-md-4 thumb-parent">
								<div class="student-thumb">
									<div class="thumb-item">
										<div class="thumb-image"><?= img(base_url('assets/imgs/thumb-image.png')); ?></div>
										<div class="thumb-name"><small>Digital<br>Electronics</small><br>
											<span class="teacher-name">By John Doe</span>
										</div>
									</div>
									<div class="thumb-details">
									</div>
								</div>
							</div>

							<div class="col-md-4 thumb-parent">
								<div class="student-thumb">
									<div class="thumb-item">
										<div class="thumb-image"><?= img(base_url('assets/imgs/thumb-image.png')); ?></div>
										<div class="thumb-name"><small>Digital<br>Electronics</small><br>
											<span class="teacher-name">By Sandra Doe</span>
										</div>
									</div>
									<div class="thumb-details">
									</div>
								</div>
							</div>

							<div class="col-md-4 thumb-parent">
								<div class="student-thumb">
									<div class="thumb-item">
										<div class="thumb-image"><?= img(base_url('assets/imgs/thumb-image.png')); ?></div>
										<div class="thumb-name"><small>Digital<br>Electronics</small><br>
											<span class="teacher-name">By Joseph Doe</span>
										</div>
									</div>
									<div class="thumb-details">
									</div>
								</div>
							</div>

						</div>
					</div>
				  </div>
				  <!-- //Groups Tab -->
				  <!-- Programs Tab -->
				  <div class="tab-pane" id="programs">Ugly</div>
				</div>

			</div>
		</div>
	</div>
</div>
<div class="base-container scroll-area">
	<div class="slider">
<? if(count($all) == 0): ?>
<h2 class="unavailable">THERE ARE NO NOTICES</h2>
<? else: ?>
<?php foreach($all as $item): ?>
<?php if($item->type === 'article'): ?>
	<!-- Widget Column -->
	<div class="widget-column">
		<div class="widget calendarbox addpostass">
			<div>                                                                     
			    <div class="col-md-12 addposttrash">
			    	<i class="glyphicon glyphicon-pushpin"></i>
			    </div>
			    <div class="greenish addmagone">
			          <div class="notif-text addhone">
			                <h1>Article:</h1><br>
			                <h2 class="addmagtwo" title="<?= $item->title; ?>"><?= $item->title; ?></h2>
			                <p class="white adddate"><?= date('jS M, H:i A', $item->created); ?></p>
			          </div>
			          <div class="notif-text vert-scroll scroll-area addhtwo">
			                <p class="white addtxt"><?= $item->details; ?></p>
			          </div>
			          <div>
			                <br>   
			          </div>
			    </div>
			</div>
	    </div>
	</div>
<?php elseif($item->type === 'image'): ?>
	<? $notice_data = $this->notice_detail->get_by(['notice_id'=>$item->id]); ?>
	<!-- Widget Column -->
	<div class="widget-column">
		<div class="widget notice-image">
			<div class="title row">
				<div class="col-md-12" align="right" style="color:#fff;">
					<i class="glyphicon glyphicon-pushpin"></i>
				</div>
			</div>
			<div class="pad10">
				<h1><?= $item->title; ?>:</h1>
				<h4><?= date('jS M, H:i A',$item->created); ?></h4>
			</div>
			<img src="./uploads/notices/<?= $notice_data->image_url; ?>" alt="<?= $item->title; ?>" >
		</div>
	</div>
<?php elseif($item->type === 'video'): ?>
	<!-- Widget Column -->
	<div class="widget-column">
		<div class="widget video-widget">
			<div class="boxgreen">
			    <div class="col-md-12 addposttrash">
			    	<i class="glyphicon glyphicon-pushpin"></i>
			    </div>
			    <div class="greenish addmagone">
			          <div class="notif-text addhone">
			                <h1>Video:</h1><br>
			                <h2 class="addmagtwo" title="<?= $item->title; ?>"><?= $item->title; ?></h2>
			                <p class="white adddate"><?= date('j M, H:i:s', $item->created); ?></p>
			          </div>
			    </div>
			</div>                                                                    
	        <div class="notif-text video-container">
	              <div class="video">
	                    <iframe src="//www.youtube.com/embed/<?= substr($item->details, -11); ?>"
	                    frameborder="0" allowfullscreen>
	                    </iframe>
	              </div>
	        </div>
	        <div>
	              <br>   
	        </div>
		</div>
	</div>
<?php elseif($item->type === 'gallery'): ?>
	<!-- Widget Column -->
	<div class="widget-column">
		<div class="mygallery widget notice-gallery">
			<div class="tn3 album">
			    <h4>Fixed Dimensions</h4>
			    <div class="tn3 description">Images with fixed dimensions</div>
			    <ol>
			    <?php for($i = 0; $i < 6; ++$i): ?>
				<?php if(!empty($item->{'image'.$i})): ?>
				<li>
				    <h3><?= $item->title; ?></h3>
				    <div class="tn3 description"><?= $item->details; ?></div>
				    <a href="./uploads/<?= $item->{'image'.$i} ?>">
					<img src="./uploads/<?= $item->{'image'.$i} ?>" />
				    </a>
				</li>
				<?php endif; ?>
				<?php endfor; ?>
			    </ol>
			</div>
	    </div>
	</div>
<?php endif; ?>
<? endforeach; ?>
<? endif; ?>
	<div class="widget-column"></div>
	</div>
</div>
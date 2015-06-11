<div class="base-container scroll-area">
	<div class="slider">
	     <div class="widget-column">
                  <div class="title row">
				<div class="col-md-12 classtitle">
                              <a class="nochange" href="<?= site_url(); ?>courses">Courses</a>
                              <span class="fa fa-angle-right magleftright1"></span>
                              <?= $course_info->title; ?>
                        </div>
			</div>  

                  <div class="widget">
                        <div class='boxcrimson padtop'>
                              <table class="purpletop margl">
                                    <tr>
                                          <td class='widthhun'>
                                                <div class="image">
                                                      <?= check_image($user_info->image); ?>
                                                </div>
                                          </td>
                                          <td>
                                                <h1>
                                                      <?= $user_info->firstname." ".$user_info->lastname; ?>
                                                </h1>
                                                <span>Course Instructor</span>
                                          </td>
                                    </tr>                                          
                              </table>
                        </div>
                  </div>

                  <div class="widget">
                        <div class="boxorange">
                              <div class="titleblur">
                              </div>
                              <div class="title row">
                                    <div class="col-md-8 colorwhite">Overview</div>
                                    <div class="col-md-4 boxorangeright">
                                    <? $owner_overview = "<a data-reveal-id='manageCourse'>Edit <i class='glyphicon glyphicon-edit'></i></a>"; ?>
                                          <?= no_access($user_info->id, $this->user_details->id,$owner_overview); ?>
                                    </div>
                              </div>
                              <div class="dtxtorange">
                                    <?= $course_info->overview; ?>
                              </div>
                        </div>
                  </div>

                  <div class="widget">
                        <div class="darkblue">
                              <div class="titleblur">
                              </div>
                              <div class="title row">
                                    <div class="col-md-8 colorwhite">
                                          <span class="fa fa-users"></span>Members (<?= count($members); ?>)
                                    </div>
                                    <div class="col-md-4 boxorangeright">
                                          <? $owner_member = "<a data-reveal-id='memberEdit'>Spread the word <i class='glyphicon glyphicon-edit'></i></a>";
                                             $user_member = "<a href=".site_url()."/courses/join/".$this->user_details->id."/".$course_info->id.">Join <i class='fa fa-plus-square'></i></a>";
                                          ?>
                                          <?= no_access($user_info->id,$this->user_details->id,$owner_member,$user_member); ?>
                                    </div>
                              </div>
                              <div>
                                    <div class="darkblutxt courses-inner vert-scroll scroll-area">
                                          <ul>
                                                <? foreach($members as $member): ?>
                                                <? if($member->user_id === $this->user_details->id): ?>
                                                <li>
                                                      <div class="txtleft">
                                                            <div class="image">
                                                                  <? $name = $this->user->get($member->user_id); echo check_image($name->image); ?>
                                                            </div>
                                                      </div>
                                                      <div class="txtright member-list">
                                                            <div class="txtleft">
                                                            <h4><?= $name->firstname." ".$name->lastname; ?></h4>
                                                            <span>Joined <?= date('jS M, Y',$member->joined); ?></span>
                                                            </div>
                                                            <div class="txtright darkblutwo">
                                                                  <span class="fa fa-circle online"></span>
                                                            </div>
                                                            <div class="clear"></div>
                                                      </div>
                                                      <div class="clear"></div>
                                                </li>
                                                <? else: ?>
                                                <li>
                                                      <div class="txtleft">
                                                            <div class="image">
                                                                  <? $name = $this->user->get($member->user_id); echo check_image($name->image); ?>
                                                            </div>
                                                      </div>
                                                      <div class="txtright member-list">
                                                            <div class="txtleft">
                                                            <h4><?= $name->firstname." ".$name->lastname; ?></h4>
                                                            <span>Joined <?= date('jS M, Y',$member->joined); ?></span>
                                                            </div>
                                                            <div class="txtright darkblutwo">
                                                                  <span class="fa fa-circle offline"></span>
                                                            </div>
                                                            <div class="clear"></div>
                                                      </div>
                                                      <div class="clear"></div>
                                                </li>
                                                <? endif; ?>
                                                <? endforeach; ?>
                                          </ul>
                                    </div>
                              </div>
                        </div>
                  </div>            
            </div>

            <div class="widget-column">
                  <div class="title row">
                              <div class="col-md-12 classtitle"><span class="magright"></span></div>
                  </div>
                  <div class="widget">
                        <div class="boxgreen">
                        <div class="title row">
                            <div class="course-title">Courses Outline</div>
                        </div>
                        </div>
                        <div class='courses'>
                              <div class="magfull">
                                  <div class="courses-inner inner-outline vert-scroll scroll-area">
                                    <? if(count($outlines) == 0):?>
                                    <? $posts_owner = "<p class='lead'>There is no course outline for your course yet</p>";
                                       $posts_viewer = "<p class='lead'>There is no course outline for this course yet</p>"; ?>
                                    <?= no_access($user_info->id, $this->user_details->id, $posts_owner, $posts_viewer); ?>
                                    <? endif; ?>
                                      <ul>
                                          <? foreach($outlines as $outline): ?>
                                          <li data-id="<?= $outline->id; ?>">
                                                <h4><?= $outline->outline;  ?></h4>
                                                <i class="txtright"><input type="checkbox" name="done-outline" value="<?= $outline->done; ?>" <?= $outline->done == 1? 'checked':'' ?>></i>
                                                <span><?= week_diff($outline->time); ?></span>
                                          </li>
                                          <? endforeach; ?>
                                      </ul>
                                  </div>
                              </div>
                        </div>
                  </div>


                  <div class="widget">
                        <div class="calendarbox">
                        <div class="title row">
                            <div class="course-title">Calendar</div>
                        </div>
                        </div>
                        <div class='courses'>
                              <div class="magfull">
                                  <div class="courses-inner inner-calendar vert-scroll scroll-area">
                                      <ul>
                                          <li>
                                                <h4 class="calendartext">Assignment Submission</h4>
                                                <span>January 28, 2014 10:00pm</span>
                                          </li>
                                          <li>
                                                <h4 class="calendartext">Assignment Submission</h4>
                                                <span>January 28, 2014 10:00pm</span>
                                          </li>
                                          <li>
                                                <h4 class="calendartext">Assignment Submission</h4>
                                                <span>January 28, 2014 10:00pm</span>
                                          </li>
                                          <li>
                                                <h4 class="calendartext">Assignment Submission</h4>
                                                <span>January 28, 2014 10:00pm</span>
                                          </li>
                                          <li>
                                                <h4 class="calendartext">Assignment Submission</h4>
                                                <span>January 28, 2014 10:00pm</span>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                        </div>
                  </div>
                                                
            </div>

            <div class="widget-column">
                  
                  <? if(count($courses) == 0): ?>
                  <div class="widget-column">
                   <? $postsg_owner = 
                  "<div class='addpost'>
                        <a data-reveal-id='manageCourse'><i class='fa fa-plus-square-o'></i></a>
                        <h1 class='white'>There are no posts in your course yet.<br>add posts now</h1>
                  </div>";
                  $postsg_user =
                  "<div class='addpost'>
                        <h1 class='unavailable'>There are no posts in this course yet</h1>
                  </div>"; ?>
                  <?= no_access($user_info->id, $this->user_details->id, $postsg_owner, $postsg_user); ?>
                  </div>
                  <? else: ?>
                  <div class="title row navstyle">
                        <ul class="nav nav-tabs os-tabs">
                              <li class="active"><a href="#"  data-toggle="tab">All Posts (<?= count($courses); ?>)</a></li>
                              <li><a href="#"  data-toggle="tab">Notes(<?= count($notes); ?>)</a></li>
                              <li><a href="#"  data-toggle="tab">Live Classes (<?= count($live_class); ?>)</a></li>
                              <li><a href="#"  data-toggle="tab">Videos (<?= count($videos); ?>)</a></li>
                              <li><a href="#"  data-toggle="tab">Assignments (<?= count($assignments); ?>)</a></li>
                              <li><a href="#"  data-toggle="tab">Quizzes(<?= count($quizzes); ?>)</a></li>
                              <li><a href="#"  data-toggle="tab">Announcements (<?= count($announcements); ?>)</a></li>
                        </ul>
                  </div>
                  <div class="widget-column">
                  <? $owner_add =
                        "<div class='addpost'>
                              <a data-reveal-id='manageCourse'><i class='fa fa-plus-square-o'></i></a>
                        </div>"; ?>
                  <?= no_access($user_info->id, $this->user_details->id, $owner_add); ?>
                  </div>
                  <? foreach($courses as $course): ?>
                  <div class="widget-column course-posts">
                        <? if($course->type === 'assignment'): ?>
                        <!-- Assignment -->
                        <div class="widget greenish addpostass">
                              <div>                                                                     
                                    <div class="col-md-12 addposttrash">
                                          
                                          <?
                                          $ownerpost =
                                          "
                                          <a class='nochange' data-reveal-id='editPost' data-post-id='".$course->id."'>
                                                <span class='fa fa-edit'></span>
                                          </a>&nbsp;&nbsp;
                                          <a class='nochange delete-widget' href='".site_url()."courses/remove/".$course_info->id.'/'.$course->id."'>
                                                <span class='fa fa-trash-o'></span>
                                          </a>";
                                          $userpost = "<span class='fa fa-edit'></span>&nbsp;&nbsp;<span class='fa fa-trash-o'></span>";
                                          ?>
                                          <?= no_access($user_info->id,$this->user_details->id,$ownerpost,$userpost); ?>
                                    </div>
                                    <div class="greenish addmagone">
                                          <div class="notif-text addhone">
                                                <h1>Assignment:</h1><br>
                                                <h2 class="addmagtwo"><?= $course->title; ?></h2>
                                                <p class="white adddate"><?= date('M jS, Y h:i A', $course->created); ?></p>
                                          </div>
                                          <div class="notif-text vert-scroll scroll-area addhtwo">
                                                <p class="white addtxt">
                                                      <?= $course->details; ?>
                                                </p>
                                          </div>
                                          <div>
                                                <br>   
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <!-- // Assignment -->
                        <? elseif($course->type === 'announcement'): ?>
                        <!-- Announcement -->
                        <div class="widget crimson addpostass">
                              <div>                                                                     
                                    <div class="col-md-12 addposttrash">
                                          <?
                                          $ownerpost =
                                          "
                                          <a class='nochange' data-reveal-id='editPost' data-post-id='".$course->id."'>
                                                <span class='fa fa-edit'></span>
                                          </a>&nbsp;&nbsp;
                                          <a class='nochange delete-widget' href='".site_url()."courses/remove/".$course_info->id.'/'.$course->id."'>
                                                <span class='fa fa-trash-o'></span>
                                          </a>";
                                          $userpost = "<span class='fa fa-edit'></span>&nbsp;&nbsp;<span class='fa fa-trash-o'></span>";
                                          ?>
                                          <?= no_access($user_info->id,$this->user_details->id,$ownerpost,$userpost); ?>
                                    </div>
                                    <div class="greenish addmagone">
                                          <div class="notif-text addhone">
                                                <h1>Announcement:</h1><br>
                                                <h2 class="addmagtwo"><?= $course->title; ?></h2>
                                                <p class="white adddate"><?= date('M jS, Y h:i A', $course->created); ?></p>
                                          </div>
                                          <div class="notif-text vert-scroll scroll-area addhtwo">
                                                <p class="white addtxt">
                                                      <?= $course->details; ?>
                                                </p>
                                          </div>
                                          <div>
                                                <br>   
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <!-- // Announcement -->
                        <? elseif($course->type === 'video'): ?>
                         <!-- Video -->
                        <div class="widget video-widget">
                              <div class="boxgreen">
                                    <div class="col-md-12 addposttrash">
                                          <?
                                          $ownerpost =
                                          "
                                          <a class='nochange' data-reveal-id='editPost' data-post-id='".$course->id."'>
                                                <span class='fa fa-edit'></span>
                                          </a>&nbsp;&nbsp;
                                          <a class='nochange delete-widget' href='".site_url()."courses/remove/".$course_info->id.'/'.$course->id."'>
                                                <span class='fa fa-trash-o'></span>
                                          </a>";
                                          $userpost = "<span class='fa fa-edit'></span>&nbsp;&nbsp;<span class='fa fa-trash-o'></span>";
                                          ?>
                                          <?= no_access($user_info->id,$this->user_details->id,$ownerpost,$userpost); ?>
                                    </div>
                                    <div class="greenish addmagone">
                                          <div class="notif-text addhone">
                                                <h1>Video:</h1><br>
                                                <h2 class="addmagtwo" title="<?= $course->title; ?>"><?= strlen($course->title) > 28 ? substr($course->title, 0, 25).'...':$course->title; ?></h2>
                                                <p class="white adddate"><?= date('M jS, Y h:i A', $course->created); ?></p>
                                          </div>
                                    </div>
                              </div>                                                                    
                                    <div class="notif-text video-container">
                                          <div class="video">
                                                <iframe src="//www.youtube.com/embed/<?= substr($course->details, -11); ?>"
                                                frameborder="0" allowfullscreen>
                                                </iframe>
                                          </div>
                                    </div>
                                    <div>
                                          <br>   
                                    </div>
                        </div>
                        <!-- // Video -->
                        <? elseif($course->type === 'note'): ?>
                        <!-- Notes -->
                        <div class="widget calendarbox addpostass">
                              <div>                                                                     
                                    <div class="col-md-12 addposttrash">
                                          <?
                                          $ownerpost =
                                          "
                                          <a class='nochange' data-reveal-id='editPost' data-post-id='".$course->id."'>
                                                <span class='fa fa-edit'></span>
                                          </a>&nbsp;&nbsp;
                                          <a class='nochange delete-widget' href='".site_url()."courses/remove/".$course_info->id.'/'.$course->id."'>
                                                <span class='fa fa-trash-o'></span>
                                          </a>";
                                          $userpost = "<span class='fa fa-edit'></span>&nbsp;&nbsp;<span class='fa fa-trash-o'></span>";
                                          ?>
                                          <?= no_access($user_info->id,$this->user_details->id,$ownerpost,$userpost); ?>
                                    </div>
                                    <div class="greenish addmagone">
                                          <div class="notif-text addhone">
                                                <h1>Note:</h1><br>
                                                <h2 class="addmagtwo" title="<?= $course->title; ?>"><?= strlen($course->title) > 25 ? substr($course->title, 0, 21).'...':$course->title; ?></h2>
                                                <p class="white adddate"><?= date('M jS, Y h:i A', $course->created); ?></p>
                                          </div>
                                          <div class="notif-text vert-scroll scroll-area addhtwo">
                                                <p class="white addtxt"><?= $course->details; ?></p>
                                          </div>
                                          <div>
                                                <br>   
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <!-- // Notes -->
                        <? elseif($course->type === 'quiz'): ?>
                        <!-- Quiz -->
                        <div class="txtleft">
                              <div class="widget quizbac addpostass">
                                    <div>                                                                     
                                          <div class="col-md-12 addposttrash">
                                                <?
                                                $ownerpost =
                                                "
                                                <a class='nochange' data-reveal-id='editPost' data-post-id='".$course->id."'>
                                                      <span class='fa fa-edit'></span>
                                                </a>&nbsp;&nbsp;
                                                <a class='nochange delete-widget' href='".site_url()."courses/remove/".$course_info->id.'/'.$course->id."'>
                                                      <span class='fa fa-trash-o'></span>
                                                </a>";
                                                $userpost = "<span class='fa fa-edit'></span>&nbsp;&nbsp;<span class='fa fa-trash-o'></span>";
                                                ?>
                                                <?= no_access($user_info->id,$this->user_details->id,$ownerpost,$userpost); ?>
                                          </div>
                                          <div class="greenish addmagone">
                                                <div class="notif-text addhone">
                                                      <h1>Quiz:</h1><br>
                                                      <h2 class="addmagtwo"><?= $course->title; ?></h2>
                                                      <p class="white adddate"><?= date('M jS, Y h:i A', $course->created); ?></p>
                                                </div>
                                                <div class="notif-text addhtwo" id="wrapquiz">
                                                      <? $q_details = json_decode($course->details); ?>
                                                      <h5>Instructions: <?= $q_details->instruction; ?></h5>
                                                      <h5>Duration: <?= minutes_only($q_details->duration); ?></h5>

                                                       <div class="buttons">
                                                            <a href="" id="take-quiz"><i class="fa fa-file"></i> TAKE QUIZ</a>
                                                            <a href="#"><i class="glyphicon glyphicon-th-list"></i>LEADERBOARD</a>
                                                      </div>
                                                </div>
                                                <!-- Questions -->
                                                <div class="questioncontainer">
                                                      <p class="white addtxt">
                                                            <strong>Question 1:</strong> <?= $q_details->questions->question; ?>
                                                            <ul class="quizoption">
                                                                  <? foreach($q_details->questions->options as $q_option): ?>
                                                                  <li data-option="<?= $q_option; ?>">
                                                                        <input type="radio" name="q_option"> <?= $q_option; ?>
                                                                  </li>
                                                                  <? endforeach; ?>
                                                            </ul>
                                                      </p>
                                                      <p class="white addtxt">
                                                            <strong>Time Left: <span class="timer" data-time="<? list($hrs, $mins) = explode(':', $q_details->duration); echo $mins; ?>" ></span></strong>
                                                      </p>
                                                      <div class="buttons">
                                                            <a href="javascript:void(0)" id="submit-quiz">SUBMIT <i class="fa fa-play"></i></a>
                                                            <a href="#" id="stop-quiz">STOP <i class="fa fa-clock-o"></i></a>
                                                      </div>
                                                </div>
                                                <!-- // Questions -->
                                                <!-- Answer -->
                                                <div class="answercontainer">
                                                      <h5 title="<?= $q_details->questions->options[implode($q_details->questions->answers) -1]; ?>">
                                                            Answer
                                                      </h5>
                                                </div>
                                                <!-- // Answer -->
                                          </div>
                                    </div>
                              </div>
                              <!-- Attach Comment -->
                              <div class="attachcomment">
                                    <div class='txtright'>
                                          <a href="#" name="show">Show Comments<span class="fa fa-caret-square-o-right margl"></span></a>
                                    </div>
                              </div>
                              <!-- // Attach Comment -->
                        </div>
                        <div class="hiddenquiz">
                              <div class="txtright">
                                    <div class="widget addpostass">
                                          <div class="boxpink">                                                                     
                                                <div class="col-md-12 addposttrash"><span class="fa space"></span></div>
                                                <div class="greenish addmagone txtpink">
                                                      <div class="notif-text addhone">
                                                            <h2 class="addmagtwo">Comments (23)</h2>
                                                            <p class="white adddate">Abike Dabiri, Tobi Makinwa, Ugo Okoye, Awili Uzo and 19 other people.</p>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="magright">
                                          <div class="addhthree">                                                                     
                                                <div class="dtxtpink vert-scroll scroll-area addhfour">
                                                      <ul>
                                                            <li>
                                                                  <div class="dline">
                                                                  <div class="txtleft">
                                                                        <div class="image">
                                                                              <?=img(base_url('assets/imgs/profile-pic.jpg'));?>
                                                                        </div>
                                                                  </div>                                                      
                                                                  <div class="txtright widthchat">
                                                                        <div class="txtleft" style="vertical-align:top">
                                                                              <h1>Abike Dabiri</h1>
                                                                        </div>
                                                                        <div class="txtright" style="vertical-align:top">
                                                                              <span class="fa fa-mail-reply"></span>
                                                                        </div>
                                                                        <div style="vertical-align:bottom">
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <p>Oh boooy!!! Dis quiz hard gaan! Haba Mr. Lecturer. Ko easy o! Ejo make ur exam easier o!</p>
                                                                              </div>
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <span class="magright">Jan 27, 2014 </span> <span>  8:23am</span>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                                  </div>
                                                            </li>
                                                            <li>
                                                                  <div class="dline">
                                                                  <div class="txtleft">
                                                                        <div class="image">
                                                                              <?=img(base_url('assets/imgs/profile-pic.jpg'));?>
                                                                        </div>
                                                                  </div>                                                      
                                                                  <div class="txtright widthchat">
                                                                        <div class="txtleft" style="vertical-align:top">
                                                                              <h1>Abike Dabiri</h1>
                                                                        </div>
                                                                        <div class="txtright" style="vertical-align:top">
                                                                              <span class="fa fa-mail-reply"></span>
                                                                        </div>
                                                                        <div style="vertical-align:bottom">
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <p>Oh boooy!!! Dis quiz hard gaan! Haba Mr. Lecturer. Ko easy o! Ejo make ur exam easier o!</p>
                                                                              </div>
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <span class="magright">Jan 27, 2014 </span> <span>  8:23am</span>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                                  </div>
                                                            </li>
                                                            <li> 
                                                                  <div class="dline">
                                                                  <div class="txtleft">
                                                                        <div class="image">
                                                                              <?=img(base_url('assets/imgs/profile-pic.jpg'));?>
                                                                        </div>
                                                                  </div>                                                      
                                                                  <div class="txtright widthchat">
                                                                        <div class="txtleft" style="vertical-align:top">
                                                                              <h1>Abike Dabiri</h1>
                                                                        </div>
                                                                        <div class="txtright" style="vertical-align:top">
                                                                              <span class="fa fa-mail-reply"></span>
                                                                        </div>
                                                                        <div style="vertical-align:bottom">
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <p>Oh boooy!!! Dis quiz hard gaan! Haba Mr. Lecturer. Ko easy o! Ejo make ur exam easier o!</p>
                                                                              </div>
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <span class="magright">Jan 27, 2014</span> <span>8:23am</span>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                                  </div>
                                                            </li>
                                                      </ul>
                                                </div>
                                                <div>
                                                      <br>   
                                                </div>
                                          </div>
                                                <div class="acenter addhfive">
                                                      <textarea rows="3" class="text-box" name="chat" placeholder="Type your comment here..."></textarea>
                                                </div>
                                          </div>                                    
                                    </div>
                              
                                    <div class="attachcomment">
                                          <div class='txtright'>
                                                <a href="#" name="hide">Hide Comments<span class="fa fa-caret-square-o-right margl"></span></a>
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <!-- // Quiz -->
                        <? elseif($course->type === "live_class"): ?>
                        <!-- Live Class -->
                        <div class="txtleft">
                              <div class="widget addpostass boxlightrange">
                                    <div class="boxrange">                                                                     
                                          <div class="col-md-12 addposttrash">
                                                <span class="glyphicon glyphicon-record veryverysmall magright"></span>
                                                <?
                                                $ownerpost =
                                                "
                                                <a class='nochange' data-reveal-id='editPost' data-post-id='".$course->id."'>
                                                      <span class='fa fa-edit'></span>
                                                </a>&nbsp;&nbsp;
                                                <a class='nochange delete-widget' href='".site_url()."courses/remove/".$course_info->id.'/'.$course->id."'>
                                                      <span class='fa fa-trash-o'></span>
                                                </a>";
                                                $userpost = "<span class='fa fa-edit'></span>&nbsp;&nbsp;<span class='fa fa-trash-o'></span>";
                                                ?>
                                                <?= no_access($user_info->id,$this->user_details->id,$ownerpost,$userpost); ?>
                                          </div>
                                          <div class="greenish addmagone">
                                                <div class="notif-text addhone">
                                                      <h1>Live Class:</h1><br>
                                                      <h2 class="addmagtwo"><?= $course->title; ?></h2>
                                                      <p class="white adddate"><?= date('F jS, Y',$course->created); ?></p>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="attachrpad boxlightrange">
                                    <div class="addhthree boxlightrange">                                                                     
                                          <div class="dtxtedorange vert-scroll scroll-area addhfour boxlightrange">
                                                <? if(count($chats) === 0): ?>
                                                <p>There are no conversations yet, Begin by typing</p>
                                                <? else: ?>
                                                <ul>
                                                <? foreach($chats as $chat): ?>
                                                      <li>
                                                            <div class="dline">
                                                            <div class="txtleft">
                                                                  <div class="image">
                                                                        <? $name = $this->user->get($chat->user_id); echo check_image($name->image); ?>
                                                                  </div>
                                                            </div>                                                      
                                                            <div class="txtright widthgchated trigrouple-isosceles left">
                                                                  <div class="col-md-7">
                                                                        <h1 title="<?= $name->firstname." ".$name->lastname; ?>"><?= $name->firstname." ".$name->lastname; ?></h1>
                                                                  </div>
                                                                  <div class="col-md-5">
                                                                        <small><? $interval = get_date_diff((int)time(),(int)$chat->time,1); echo strlen($interval) < 2 ? $interval: $interval.' ago' ?></small>
                                                                  </div>
                                                                  <div class="clear"></div>
                                                                  <div class="row">
                                                                        <div class="col-md-12">
                                                                              <p><?= wrap_links($chat->message); ?></p>
                                                                        </div>                                                                        
                                                                  </div>
                                                            </div>
                                                            </div>
                                                      </li>
                                                
                                                <? endforeach; ?>
                                                </ul>

                                                <? endif; ?>                                     
                                               
                                                
                                          </div>
                                          <div>
                                                <br> 
                                          </div>
                                    </div>
                                          <div class="acenter addhfive">
                                                <?= form_open(site_url()."courses/chat/".$course->id."/".$this->user_details->id); ?>
                                                <textarea rows="3" class="text-box liveinclass" name="chat" placeholder="Type your comment here..."></textarea>
                                                <?= form_close(); ?>
                                          </div>
                                    </div> 
                              </div>
                              <!-- Attach Comment -->
                              <div class="attachcomment">
                                    <div class='txtright'>
                                          <a href="#" name="show">Show Comments<span class="fa fa-caret-square-o-right margl"></span></a>
                                    </div>
                              </div>
                              <!-- // Attach Comment -->
                        </div>
                        <div class="hiddenclass">
                              <div class="txtright">
                                    <div class="widget addpostass">
                                          <div class="boxgrange">                                                                     
                                                <div class="col-md-12 addposttrash"><span class="fa space"></span></div>
                                                <div class="greenish addmagone white">
                                                      <div class="notif-text addhone">
                                                            <h2 class="addmagtwo">Comments (23)</h2>
                                                            <p class="white adddate">Abike Dabiri, Tobi Makinwa, Ugo Okoye, Awili Uzo and 19 other people.</p>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="magright">
                                          <div class="addhthree">                                                                     
                                                <div class="dtxtlightrange vert-scroll scroll-area addhfour">
                                                      <ul>
                                                            <li>
                                                                  <div class="dline">
                                                                  <div class="txtleft">
                                                                        <div class="image">
                                                                              <?=img(base_url('assets/imgs/profile-pic.jpg'));?>
                                                                        </div>
                                                                  </div>                                                      
                                                                  <div class="txtright widthchat">
                                                                        <div class="txtleft" style="vertical-align:top">
                                                                              <h1>Abike Dabiri</h1>
                                                                        </div>
                                                                        <div class="txtright" style="vertical-align:top">
                                                                              <span class="fa fa-mail-reply"></span>
                                                                        </div>
                                                                        <div style="vertical-align:bottom">
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <p>Oh boooy!!! Dis quiz hard gaan! Haba Mr. Lecturer. Ko easy o! Ejo make ur exam easier o!</p>
                                                                              </div>
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <span class="magright">Jan 27, 2014 </span> <span>  8:23am</span>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                                  </div>
                                                            </li>
                                                            <li>
                                                                  <div class="dline">
                                                                  <div class="txtleft">
                                                                        <div class="image">
                                                                              <?=img(base_url('assets/imgs/profile-pic.jpg'));?>
                                                                        </div>
                                                                  </div>                                                      
                                                                  <div class="txtright widthchat">
                                                                        <div class="txtleft" style="vertical-align:top">
                                                                              <h1>Abike Dabiri</h1>
                                                                        </div>
                                                                        <div class="txtright" style="vertical-align:top">
                                                                              <span class="fa fa-mail-reply"></span>
                                                                        </div>
                                                                        <div style="vertical-align:bottom">
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <p>Oh boooy!!! Dis quiz hard gaan! Haba Mr. Lecturer. Ko easy o! Ejo make ur exam easier o!</p>
                                                                              </div>
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <span class="magright">Jan 27, 2014 </span> <span>  8:23am</span>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                                  </div>
                                                            </li>
                                                            <li> 
                                                                  <div class="dline">
                                                                  <div class="txtleft">
                                                                        <div class="image">
                                                                              <?=img(base_url('assets/imgs/profile-pic.jpg'));?>
                                                                        </div>
                                                                  </div>                                                      
                                                                  <div class="txtright widthchat">
                                                                        <div class="txtleft" style="vertical-align:top">
                                                                              <h1>Abike Dabiri</h1>
                                                                        </div>
                                                                        <div class="txtright" style="vertical-align:top">
                                                                              <span class="fa fa-mail-reply"></span>
                                                                        </div>
                                                                        <div style="vertical-align:bottom">
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <p>Oh boooy!!! Dis quiz hard gaan! Haba Mr. Lecturer. Ko easy o! Ejo make ur exam easier o!</p>
                                                                              </div>
                                                                              <div class="txtright" style="vertical-align:top">
                                                                                    <span class="magright">Jan 27, 2014</span> <span>8:23am</span>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                                  </div>
                                                            </li>
                                                      </ul>
                                                </div>
                                                <div>
                                                      <br>   
                                                </div>
                                          </div>
                                                <div class="acenter addhfive">
                                                      <textarea rows="3" class="text-box" name="chat" placeholder="Type your comment here..."></textarea>
                                                </div>
                                          </div>                                    
                                    </div>
                              
                                    <div class="attachcomment">
                                          <div class='txtright'>
                                                <a href="#" name="hide">Hide Comments<span class="fa fa-caret-square-o-right margl"></span></a>
                                          </div>
                                    </div>
                              </div> 
                        </div>
                        <!-- // Live Class -->
                        <? endif; ?>

                        <? $attachments = $this->attachment->get_by(['resource_id'=>$course->id]); ?>
                        <? if((count($attachments) !== 0) and ($course->id == $attachments->resource_id)): ?>
                        <!-- Attachment -->
                        <div class="widget crimson-not attachone">
                              <table>
                                    <tr>
                                          <td class="attachtwo"><div class="glyphicon glyphicon-paperclip"></div></td>
                                          <td class="attachpad">
                                                <p><span class="attachweight"><?= count($attachments); ?> Attachment</span>
                                                </p>
                                          </td>                               
                                    </tr>
                                    <tr>
                                          <td></td>
                                          <td classs="attachpad">
                                                <p class="attachtop margl">
                                                <a class="nochange" href="./uploads/attachments/<?= $attachments->title; ?>">
                                                <?= $attachments->title; ?></a>
                                                <br><?= size_readable(filesize('./uploads/attachments/'.$attachments->title)); ?></p>
                                          </td>                               
                                    </tr>
                              </table>                    
                        </div>
                        <!-- // Attachment -->
                        <? endif; ?>
                  </div>
                  <? endforeach; ?>
                  <?endif;?>

            </div>

      </div>
</div>

<div id="memberEdit" class="reveal-modal" data-reveal>
      <h2>Edit Course Members</h2>
      <div class="course-exist vert-scroll scroll-area">
            <ul class="list-items">
            <? foreach ($members as $member): ?>
            <? if($member->user_id === $this->user_details->id): continue; endif; ?>
            <li>
                  <? $name = $this->user->get($member->user_id); echo $name->firstname." ".$name->lastname; ?>
                  <span class="txtright">
                        <button class="btn btn-primary">Assign as Instructor</button>
                        <button class="btn btn-primary">Remove from course</button>
                  </span>
            </li>
            <? endforeach; ?>
            </ul>
      </div>
      <a class="close-reveal-modal">&#215;</a>
</div>

<!--Manage Course-->
<div id="manageCourse" class="lightbox reveal-modal" data-reveal>               
      
      <h1><?= $course_info->title; ?></h1>           
      
      <div class="row content tab-area">
            <div class="large-3 columns">
                  <ul class="nav tabs" data-tab-content="course-settings">
                        <li class="active">
                              <a class="tab" data-tab-id = "general">General</a>
                        </li>
                        <li>
                              <a class="tab" data-tab-id = "course">Course Outline</a>
                        </li>
                        <li>
                              <a class="tab" data-tab-id = "calendar">Calendar</a>
                        </li>
                        <li>
                              <a class="tab" data-tab-id = "members">Members</a>
                        </li>
                        <li>
                              <a class="tab" data-tab-id = "posts">Create Posts</a>
                        </li>
                  </ul>
            </div>
            <div class="large-9 columns tab-content" id="course-settings">
                  <div id="general" class="active">
                        
                        <h2 class="pg-title"><i class="fa fa-cogs"></i> General</h2>

                        <section>
                              <!--Section Row-->
                              <div class="sec-row">
                                    <div class="sub-row">
                                          <p>Instructor</p>
                                          <div>
                                                <div>             
                                                      <div class="passport"><?= check_image($user_info->image); ?></div>
                                                </div>
                                                <div>             
                                                      <h4><?= $user_info->firstname." ".$user_info->lastname; ?></h4>
                                                      <p><?= $course_info->title; ?></p>
                                                </div>      
                                          </div>                              
                                    </div>
                              </div>

                              <div class="sec-row">
                                   <?= form_open('courses/edit_course'); ?>
                                    <div class="sub-row">
                                          <p>Course Title</p>
                                          <input name="title" value="<?= $course_info->title; ?>" type="text">
                                    </div>
                                    <div class="sub-row">
                                          <p>Description</p>
                                          <textarea name="desc"><?= $course_info->overview; ?></textarea>
                                    </div>                                                
                              </div>                                    

                              <!--Section Row-->
                              <div class="sec-row">
                                    <div class="sub-row">
                                          <p>Subscription</p>
                                          <div>
                                                <div>                                                             
                                                      <input type="radio" name="subscription"/>                                                 
                                                      <label>Free</label>                                                                 
                                                </div>
                                                <div>
                                                      <input type="radio" name="subscription"/>                                                 
                                                      <label>Paid</label>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="sub-row">
                                          <p>Fee</p>
                                          <div>
                                                <div>
                                                      <input type="number"/>  
                                                </div>            
                                                <div></div>                                                                                                                                     
                                          </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $course_info->id; ?>">                                              
                              </div>

                              <button class="ios-button nature"><i class="fa fa-save"></i> Save Changes</button>
                        <?= form_close(); ?>
                        </section>
                  </div><!--End general Tab-->

                  <div id="course">
                        
                        <h2 class="pg-title"><i class="fa fa-tasks"></i> Course Outline</h2>

                        <!--Table-->
                        <div class="tbl tbl-5">

                              <!--Header-->
                              <div class="tbl-row header">
                                    <div></div>
                                    <div><h4>TITLE</h4></div>
                                    <div><h4>DATE</h4></div>
                                    <div><h4>TIME</h4></div>
                                    <div><h4>ACTIONS</h4></div>
                              </div>
                              
                              <? if(count($outlines) == 0): ?>
                              <div class="sec-row">
                                    <?= form_open('courses/add_outline'); ?>
                                    <div class="sub-row">
                                          <p>Title</p>
                                          <input type="text" name="title" class="text-mirror" data-mirror="title-mirror"/>
                                    </div>
                                    <div class="sub-row">
                                          <p>Description</p>
                                          <textarea class="text-mirror" name="description" data-mirror="desc-mirror"></textarea>
                                    </div>
                                    <div class="sub-row">
                                          <p>Date</p>
                                          <div class="input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                                <input class="span2 datepicker" size="16" type="text" />
                                                <span class="add-on"><i class="icon-th"></i></span>
                                          </div>
                                    </div>
                                    <div class="tbl-row">
                                          <button class="ios-button citrus edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
                                    </div>
                                    <?= form_close(); ?>
                              </div>
                              <? else: ?>
                              <!-- Row -->
                              <? foreach($outlines as $key => $outline): ?>
                              <div class="accordion row-temp">
                                    <div class="tbl-row">
                                          <div><input type="checkbox" name="done-outline" value="<?= $outline->done ?>"></div>
                                          <div><p class="title-mirror"><?= $outline->outline; ?></p></div>
                                          <div><p><?= date('F D, Y',$outline->time); ?></p></div>
                                          <div><p><?= date('H:i A',$outline->time); ?></p></div>
                                          <div>
                                                <a data-toggle-panel="panel<?= $key + 1; ?>"><i class="fa fa-edit"></i>Edit</a>
                                                <a href="courses/delete_outline/<?= $outline->id; ?>"><i class="fa fa-trash-o"></i>Delete</a>
                                          </div>                                    
                                    </div>
                                    <div id="panel<?= $key + 1; ?>" class="content">
                                          <div class="sec-row">
                                                <?= form_open('courses/edit_outline/'.$outline->id); ?>
                                                <div class="sub-row">
                                                      <p>Title</p>
                                                      <input type="text" value="<?= $outline->outline; ?>" name="title" class="text-mirror" data-mirror="title-mirror"/>
                                                </div>
                                                <div class="sub-row">
                                                      <p>Date</p>
                                                      <input type="text">
                                                </div>
                                                <div class="tbl-row">
                                                      <button class="ios-button citrus edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
                                                </div>
                                                <?= form_close(); ?>
                                          </div>
                                    </div>
                              </div>
                              <? endforeach; ?>
                              <!-- // Row -->

                              <div class="tbl-row">
                                    <button class="ios-button nature add-more"><i class="fa fa-plus-square-o"></i> Add More</button>
                              </div>
                              <? endif; ?>
                        </div>
                  </div><!--End Course Tab-->

                  <div id="calendar">
                        
                        <h2 class="pg-title"><i class="fa fa-calendar"></i> Calendar</h2>

                        <!--Table-->
                        <div class="tbl tbl-6">

                              <!--Header-->
                              <div class="tbl-row header">
                                    <div></div>
                                    <div><h4>TITLE</h4></div>
                                    <div><h4>DESCRIPTION</h4></div>
                                    <div><h4>DATE</h4></div>
                                    <div><h4>TIME</h4></div>
                                    <div><h4>ACTIONS</h4></div>
                              </div>
                              
                              <!-- Row -->
                              <? foreach($outlines as $key => $outline): ?>
                              <div class="accordion row-temp">
                                    <div class="tbl-row">
                                          <div><input type="checkbox"/></div>
                                          <div><p class="title-mirror"><?= $outline->outline; ?></p></div>
                                          <div><p class="desc-mirror"><?= $outline->outline; ?></p></div>
                                          <div><p><?= date('F D, Y',$outline->time); ?></p></div>
                                          <div><p><?= date('H:i A',$outline->time); ?></p></div>
                                          <div>
                                                <a data-toggle-panel="panel<?= $key + 2; ?>"><i class="fa fa-edit"></i>Edit</a>
                                                <a href="courses/delete_outline/<?= $outline->id; ?>"><i class="fa fa-trash-o"></i>Delete</a>
                                          </div>                                    
                                    </div>
                                    <div id="panel<?= $key + 2; ?>" class="content">
                                          <div class="sec-row">
                                                <?= form_open('courses/edit_outline/'.$outline->id); ?>
                                                <div class="sub-row">
                                                      <p>Title</p>
                                                      <input type="text" value="<?= $outline->outline; ?>" name="title" class="text-mirror" data-mirror="title-mirror"/>
                                                </div>
                                                <div class="sub-row">
                                                      <label for="date">Date: </label>
                                                      <input id="datepicker" size="25" type="text" name="date"><br>
                                                      <label for="time">Time: </label>
                                                      <select name="time">
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
                                                      <select name="meridian">
                                                            <option>AM</option>
                                                            <option>PM</option>
                                                      </select>
                                                </div>
                                                <div class="tbl-row">
                                                      <button class="ios-button citrus edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
                                                </div>
                                                <?= form_close(); ?>
                                          </div>
                                    </div>
                              </div>
                              <? endforeach; ?>
                              <!-- // Row -->

                              <!-- Template Row -->
                              <div class="accordion row-temp template">
                                    <div class="tbl-row">
                                          <div><input type="checkbox"/></div>
                                          <div><p class="title-mirror">New Course</p></div>
                                          <div><p class="desc-mirror">Enter Description</p></div>
                                          <div><p><?= date('F D, Y', time()); ?></p></div>
                                          <div><p><?= date('H:i A', time()); ?></p></div>
                                          <div>
                                                <a data-toggle-panel="panel230"><i class="fa fa-edit"></i>Edit</a>
                                                <a href="#"><i class="fa fa-trash-o"></i>Delete</a>
                                          </div>                                    
                                    </div>
                                    <div id="panel230" class="content active">
                                          <div class="sec-row">
                                                <div class="sub-row">
                                                      <p>Title</p>
                                                      <input type="text" placeholder="Enter Course Name" name="title" class="text-mirror" data-mirror="title-mirror"/>
                                                </div>
                                                <div class="sub-row">
                                                      <p>Description</p>
                                                      <textarea class="text-mirror" placeholder="Enter Description" name="description" data-mirror="desc-mirror"></textarea>
                                                </div>
                                                <div class="tbl-row">
                                                      <button class="ios-button citrus edit-save-change"><i class="fa fa-save"></i> Save Changes</button>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                              <!-- // Template Row -->


                              <div class="tbl-row">
                                    <button class="ios-button nature add-more"><i class="fa fa-plus-square-o"></i> Add More</button>
                              </div>
                        </div>
                  </div><!--End Calendar Tab-->

                  <div id="members">
                        
                        <h2 class="pg-title"><i class="fa fa-users"></i> Members</h2>

                        <!--Table-->
                        <div class="tbl tbl-7">

                              <!--Header-->
                              <div class="tbl-row header">
                                    <div></div>
                                    <div></div>
                                    <div><h4>NAME</h4></div>
                                    <div><h4>JOINED</h4></div>
                                    <div><h4>TIME</h4></div>
                                    <div><h4>STATUS</h4></div>
                                    <div><h4>ACTIONS</h4></div>
                              </div>
                              
                              <!--Row-->
                              <? foreach($members as $count => $member): ?>
                              <div class="tbl-row">
                                    <div><p><?= $count+1; ?></p></div>
                                    <div><div class="passport"><? $name = $this->user->get($member->user_id); echo check_image($name->image); ?></div></div>
                                    <div><p><?= $name->firstname." ".$name->lastname; ?></p></div>                                             
                                    <div><p><?= date('F d, Y',$member->joined); ?></p></div>
                                    <div><p><?= date('H:i A', $member->joined); ?></p></div>
                                    <div><p>Online <i class="fa fa-circle"></i></p></div>
                                    <div>
                                          <p><!--Don't Know Why This Helped tho-->
                                                <a data-toggle-panel="" ><i class="fa fa-edit"></i>Edit</a>
                                                <a href="courses/delete_member/<?= $member->id; ?>"><i class="fa fa-trash-o"></i>Delete</a>
                                          </p>
                                    </div>
                              </div>
                              <? endforeach; ?>
                        </div>
                  </div><!--End Members Tab-->

                  <div id="posts" class="tab-area">
                        <h2 class="pg-title"><i class="fa fa-clipboard"></i> Create Post</h2>
                        
                        <ul class="guide tabs clearfix" data-tab-content="course-posts">
                              <li class="active">
                                    <a class="tab" href="#" data-tab-id="template">
                                          <div>1</div>
                                          Choose Template
                                    </a>
                              </li>
                              <li class="divide"></li>
                              <li class="">
                                    <a class="tab" href="#" data-tab-id="content">
                                          <div>2</div>
                                          Edit Content
                                    </a>
                              </li>
                              <li class="divide"></li>
                              <li>
                                    <a class="tab" href="#" data-tab-id="publish">
                                          <div>3</div>
                                          Publish
                                    </a>
                              </li>
                        </ul>
                                                            
                        <div class="tab-content" id="course-posts">

                                    <div id="template" class="active">
                                          <p class="subtitle">Choose a type of template for your post and click continue:</p>
                                          <div class="row post-options">
                                                <div class="post-option note">
                                                      <span><input type="radio" name="post_type" checked data-option="note"/></span>
                                                      <h4>Note</h4>
                                                      <div class="icon"><i class="fa fa-file"></i></div>
                                                </div>
                                                <div class="post-option assn">
                                                      <span><input type="radio" name="post_type" data-option="assignment"/></span>
                                                      <h4>Assignment</h4>
                                                      <div class="icon"><i class="fa fa-book"></i></div>
                                                </div>
                                                <div class="post-option announce">
                                                      <span><input type="radio" name="post_type" data-option="announcement"/></span>
                                                      <h4>Announcement</h4>
                                                      <div class="icon"><i class="fa fa-bullhorn"></i></div>
                                                </div>
                                                <div class="post-option live">
                                                      <span><input type="radio" name="post_type" data-option="live-class"/></span>
                                                      <h4>Live Class</h4>
                                                      <div class="icon"><i class="fa fa-comments"></i></div>
                                                </div>
                                                <div class="post-option video">
                                                      <span><input type="radio" name="post_type" data-option="vid"/></span>
                                                      <h4>Video</h4>
                                                      <div class="icon"><i class="fa fa-play"></i></div>
                                                </div>
                                                <div class="post-option quiz">
                                                      <span><input type="radio" name="post_type" data-option="quiz"/></span>
                                                      <h4>Quiz</h4>
                                                      <div class="icon"><i class="fa fa-question"></i></div>
                                                </div>                                                      
                                          </div>
                                    </div>

                                    <div id="content" class="dependent-options"><!--Edit Content-->
                                          <p class="subtitle">Edit Content and click continue:</p>

                                          <!--Notes-->
                                          <div class="content-scroller active" id="note">
                                                <div class="row">
                                                      <div class="col-md-8 column">
                                                            <?= form_open('courses/add/'.$course_info->id.'/note'); ?>
                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Title</h4>
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <input type="text" name="title">
                                                                  </div>
                                                            </div>
                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Content/Summary</h4>
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <textarea name="details"></textarea>
                                                                  </div>
                                                            </div>
                                                            <button>submit</button>
                                                            <?= form_close(); ?>
                                                      </div>
                                                      <div class="col-md-4 column">
                                                            <div class="col-md-12 attach-header">
                                                                  <h4 class="col-md-8">Attachments</h4>
                                                                  <a class="col-md-4">Add <i class="fa fa-plus-square-o"></i></a>                                              
                                                            </div>
                                                            <div class="col-md-12 clearfix">
                                                                  
                                                                  <p class="col-md-9">Students.docx</p>
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a> 

                                                                  <p class="col-md-9">Students.pdf</p>                                                         
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a>

                                                                  <p class="col-md-9">Students.jpg</p> 
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a>
                                                            </div>                                                                                         
                                                      </div>
                                                </div>
                                          </div>
                                          <!-- // Notes -->

                                          <!--Assignment-->
                                          <div class="content-scroller active" id="assignment">
                                                <div class="row">
                                                      <div class="col-md-8 column">
                                                            <?= form_open('courses/add/'.$course_info->id.'/assignment'); ?>
                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Title</h4>
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <input type="text" name="title">
                                                                  </div>
                                                            </div>
                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Content/Summary</h4>
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <textarea name="details"></textarea>
                                                                  </div>
                                                            </div>
                                                            <button>submit</button>
                                                            <?= form_close(); ?>
                                                      </div>
                                                      <div class="col-md-4 column">
                                                            <div class="col-md-12 attach-header">
                                                                  <h4 class="col-md-8">Attachments</h4>
                                                                  <a class="col-md-4">Add <i class="fa fa-plus-square-o"></i></a>                                              
                                                            </div>
                                                            <div class="col-md-12 clearfix">
                                                                  
                                                                  <p class="col-md-9">Students.docx</p>
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a> 

                                                                  <p class="col-md-9">Students.pdf</p>                                                         
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a>

                                                                  <p class="col-md-9">Students.jpg</p> 
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a>
                                                            </div>                                                                                         
                                                      </div>
                                                </div>
                                          </div>
                                          <!-- // Assignment -->

                                          <!-- Announcement -->
                                          <div class="content-scroller active" id="announcement">
                                                <div class="row">
                                                      <div class="col-md-8 column">
                                                            <?= form_open('courses/add/'.$course_info->id.'/announcement'); ?>
                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Title</h4>
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <input type="text" name="title">
                                                                  </div>
                                                            </div>
                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Content/Summary</h4>
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <textarea name="details"></textarea>
                                                                  </div>
                                                            </div>
                                                            <button>submit</button>
                                                            <?= form_close(); ?>
                                                      </div>
                                                      <div class="col-md-4 column">
                                                            <div class="col-md-12 attach-header">
                                                                  <h4 class="col-md-8">Attachments</h4>
                                                                  <a class="col-md-4">Add <i class="fa fa-plus-square-o"></i></a>                                              
                                                            </div>
                                                            <div class="col-md-12 clearfix">
                                                                  
                                                                  <p class="col-md-9">Students.docx</p>
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a> 

                                                                  <p class="col-md-9">Students.pdf</p>                                                         
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a>

                                                                  <p class="col-md-9">Students.jpg</p> 
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a>
                                                            </div>                                                                                         
                                                      </div>
                                                </div>
                                          </div>
                                          <!-- // Announcement -->

                                          <!-- Live Class -->
                                          <div class="content-scroller active" id="live-class">
                                                <div class="row">
                                                      <div class="col-md-8 column">
                                                            <?= form_open('courses/add/'.$course_info->id.'/live_class'); ?>
                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Title</h4>
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <input type="text" name="title">
                                                                  </div>
                                                            </div>
                                                            <input type="hidden" name="details" value="Live Class">
                                                            <button>submit</button>
                                                            <?= form_close(); ?>
                                                      </div>
                                                      <div class="col-md-4 column">
                                                            <div class="col-md-12 attach-header">
                                                                  <h4 class="col-md-8">Attachments</h4>
                                                                  <a class="col-md-4">Add <i class="fa fa-plus-square-o"></i></a>                                              
                                                            </div>
                                                            <div class="col-md-12 clearfix">
                                                                  
                                                                  <p class="col-md-9">Students.docx</p>
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a> 

                                                                  <p class="col-md-9">Students.pdf</p>                                                         
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a>

                                                                  <p class="col-md-9">Students.jpg</p> 
                                                                  <a class="col-md-3"><i class="fa fa-trash-o"></i></a>
                                                            </div>                                                                                         
                                                      </div>
                                                </div>
                                          </div>
                                          <!-- // Live-Class -->

                                          <!-- Video -->
                                          <div class="content-scroller" id="vid">
                                                <div class="row">
                                                      <div class="col-md-8 column">
                                                            <?= form_open_multipart('upload/upload_video/course'); ?>
                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Video Title</h4>
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <input type="text" name="title">
                                                                  </div>
                                                            </div>
                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Description</h4>
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <textarea name="details"></textarea>
                                                                  </div>
                                                            </div>
                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Source Options</h4>
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <h4><input type="radio" name="upload_option" value="upload" checked> Upload Video</h4>
                                                                        <input type="file" name="file">

                                                                        <h4><input type="radio" name="upload_option" value="link"> Youtube Link</h4>
                                                                        <input type="text" name="info">
                                                                  </div>
                                                            </div>
                                                            <input type="hidden" name="course_id" value="<?= $course_info->id; ?>">
                                                            <input type="hidden" name="type" value="video">
                                                            <button>submit</button>
                                                            <?= form_close(); ?>
                                                      </div>
                                                      <div class="col-md-4"></div>
                                                </div>
                                          </div>

                                          <!-- Quiz -->                                    
                                          <div class="content-scroller" id="quiz">
                                                <div class="row">
                                                      <div class="col-md-8 column">
                                                            <?= form_open('courses/add/'.$course_info->id.'/quiz'); ?>

                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Quiz Title</h4>
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <input type="text" name="title">
                                                                  </div>
                                                            </div>
                                                            <div class="clearfix">
                                                                  <div class="col-md-4">
                                                                        <h4>Instructions</h4>
                                                                  </div>
                                                                  <div class="col-md-8 edit-textbox">
                                                                        <textarea name="instruction"></textarea>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                            <h4>Time Allowed</h4>
                                                            <p><input type="checkbox"  id="use-timer"/> Use Timer</p>
                                                            <input type="number" disabled placeholder="HRS" name="time_hrs"><input disabled placeholder="MINS" name="time_mins" type="number">
                                                      </div>
                                                </div>
                                                <div class="sec-row">
                                                      <h4>Start Quiz Creation</h4>
                                                </div>
                                                <ol class="quizlist">
                                                      <li class="clearfix">
                                                            <div class="col-md-10"><input type="text" name="details" placeholder="Enter Question"></div>
                                                            <div class="col-md-2">
                                                                  <a class="orangelinks delete-question" href=""><i class="fa fa-trash-o"></i></a>
                                                            </div>
                                                            <ol class="col-md-6 quiz-options" type="a">
                                                                  <li class="clearfix">
                                                                        <div class="col-md-2"><input type="checkbox" data-option="1" id="answer" value="off" name="answer[]"></div>
                                                                        <div class="col-md-8"><input type="text" name="option[]"></div> 
                                                                        <div class="col-md-2"><a class="orangelinks delete-option">&#215;</a></div>                                                                      
                                                                  </li>

                                                                  <li class="clearfix">
                                                                        <div class="col-md-2"><input type="checkbox" data-option="2" id="answer" value="off" name="answer[]"></div>
                                                                        <div class="col-md-8"><input type="text" name="option[]"></div>       
                                                                        <div class="col-md-2"><a class="orangelinks delete-option">&#215;</a></div>                                                                 
                                                                  </li>

                                                                  <li class="clearfix">
                                                                        <div class="col-md-2"><input type="checkbox" data-option="3" id="answer" value="off" name="answer[]"></div>
                                                                        <div class="col-md-8"><input type="text" name="option[]"></div>
                                                                        <div class="col-md-2"><a class="orangelinks delete-option">&#215;</a></div>
                                                                  </li>

                                                                  <button class="ios-button nature add-option"><i class="fa fa-plus-square"></i> Add Option</button>
                                                                  <button class="ios-button nature add-question"><i class="fa fa-plus-square"></i> Add Question</button>
                                                            </ol>
                                                            <button>Submit</button>
                                                            <div class="col-md-6"></div>
                                                      </li>                                                                                                      
                                                </ol>
                                                <?= form_close(); ?>
                                          </div>                              
                                    </div>

                                    <div id="publish"></div> 

                                    <button class="ios-button nature continue pull-right" data-tab-control="course-posts">Continue <i class="fa fa-arrow-right"></i></button>
                                    <button class="ios-button citrus back pull-right" data-tab-control="course-posts"><i class="fa fa-arrow-left"></i> Back</button>                                          
                                    </div>
                              <? form_close(); ?>
                        </div>
                  </div><!--End Posts--> 
                  <a class="close-reveal-modal">&#215;</a>                         
            </div>
      </div>
</div>
<div id="editPost"  class="lightbox small reveal-modal" data-reveal>

      <h1>Edit Post</h1>
      <section>
            <div class="sec-row">
                  <div class="sub-row">
                        <input type="text">
                  </div>
            </div>
      </section>
      <input type="hidden" value="">
      <a class="close-reveal-modal">&#215;</a>
</div>
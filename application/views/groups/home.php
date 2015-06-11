<div class="base-container scroll-area">
	<div class="slider">
	     <div class="widget-column">
                  <div class="title row">
				<div class="col-md-12 classtitle"><span class="glyphicon glyphicon-comment magright"></span>
                                    Groups
                        </div>
			</div>  

                               

                  <div class="widget">
                        <div class="darkblueg">
                              <div class="titleblur">
                              </div>
                              <div class="title row">
                                    <div class="col-md-8 colorwhite">Joined(<?= count($joined_groups); ?>)</div>                                    
                              </div>
                              <div>
                                    <div class="courses-inner darkblutxtg vert-scroll scroll-area">
                                          <ul>
                                                <? foreach($joined_groups as $joined_group): ?>
                                                <li><a class="nochange show-group" href="groups/build_group/<?= $joined_group->group_id; ?>">
                                                      <div class="txtleft">
                                                            <div class="image">
                                                                  <? $group = $this->group->get($joined_group->group_id); echo check_group_image($group->avatar); ?>
                                                            </div>
                                                      </div>
                                                      <div class="txtright member-list">
                                                            <h4><?= $group->title; ?></h4>
                                                            <span><?= $group->overview; ?></span>
                                                      </div>
                                                      <div class="clear"></div></a>
                                                </li>
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
                        <div class="boxgreen calendarbox">
                              <div class="title row" >
                                    <div class="col-md-8 colorwhite">Invitation</div>
                              </div>
                        </div>
                        <div class='calendartxtg'>
                              <div class="magfull">
                                    <div class="courses-inner vert-scroll scroll-area calheightg">
                                    <? if(count($invitations) === 0): ?>
                                    <p>You have no group invites</p>
                                    <? else: ?>
                                          <ul>
                                                <? foreach($invitations as $invitation): ?>
                                                <li class="go-parent">
                                                      <a class="smart-go" href="groups/handle_invite/decline/<?= $invitation->place_id."/".$invitation->id; ?>"><i class="txtright orangelinks">Decline</i></a>
                                                      <a class="smart-go" href="groups/handle_invite/accept/<?= $invitation->place_id."/".$invitation->id; ?>"><i class="txtright magright10">Accept</i></a>
                                                      <h4><? $group = $this->group->get($invitation->place_id); echo $group->title; ?></h4>
                                                      <strong><? $name = $this->user->get($invitation->sender); echo $name->firstname." ".$name->lastname; ?></strong> invited you.
                                                      <span><?= date('F j, Y',$invitation->time); ?></span>
                                                </li>
                                                <? endforeach; ?>
                                          </ul>
                                    <? endif; ?>
                                    </div>
                              </div>
                        </div>
                  </div> 
                  <div class="widget">
                        <div class="boxgreen">
                              <div class="title row">
                                    <div class="col-md-8" style="color: #fff;">You might also like....</div>                                    
                              </div>
                        </div>
                        <div class='boxgreenwhiteg'>
                              <div class="magfull">
                                    <div class="courses-inner vert-scroll scroll-area boxgheight">
                                          <ul>
                                                <?if($suggested):?>
                                                      <? foreach($suggested as $group): ?>
                                                      <li>
                                                            <a href="groups/join/<?= $group->id; ?>"><i class="txtright">Join</i></a>
                                                            <h4><a href="javascript:void(0)" class="nochange pop" data-container="body" data-toggle="popover" data-placement="right" data-content="<?= $group->overview; ?>" data-original-title="<?= $group->title.' &bull; '; ?><? foreach($members[$group->id] as $member){ echo singular_count($member,'member'); } ?>"><?= $group->title; ?></a></h4>
                                                            <strong>Tolu Adegboyega</strong>,
                                                            <strong>Abike Dabiri</strong>, and
                                                            <strong>James Makanjuola</strong> are members.
                                                      </li>
                                                      <? endforeach; ?>
                                                <?else:?>

                                                      <p>No suggested groups, hit the add button to start a group.</p>
                                                <?endif;?>
                                          </ul>
                                    </div>
                              </div>
                        </div>
                  </div>
                                   
            </div>

            <div class="widget-column group-widget-container">
                   <div class="title row">
                        <div class="col-md-12 classtitle"><span class="magright"></span></div>
                  </div>

                  <div class="widget-column">
                        <div class="addpost">
                              <a data-reveal-id="addGroup"><i class="fa fa-plus-square-o"></i></a>
                        </div>
                  </div>

                  <!-- Start Groups TimeLine -->
                  <? foreach($joined_groups as $joined_group): ?>
                  <? $group = $this->group->get($joined_group->group_id); ?>
                  <div class="widget-column margl">
                        <div class="widget addpostassg">
                              <div class="<?= theme_pick($group->theme,'boxgrange','boxbrightgreen','boxbrightpurple'); ?>">                                                                     
                                    <div class="col-md-12 addpostclose"><a class="nochange delete-widget" href=""><span class="glyphicon glyphicon-remove"></span></a></div>
                                    <div class="greenish addmagrone">
                                          <div class="addgone gotif-text">
                                                <div class="col-md-2">
                                                      <div class="image">
                                                            <?= check_group_image($group->avatar); ?>
                                                      </div>
                                                </div>
                                                <div class="col-md-10">
                                                      <h2><?= $group->title; ?></h2>
                                                      <p><?= $group->overview; ?></p>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="txtleft <?= theme_pick($group->theme,'boxlightrange','boxbrightgreenl','boxbrightpurplel'); ?>">
                              <div class="widget addpostass
                              <?= theme_pick($group->theme,'boxlightrange','boxbrightgreenl','boxbrightpurplel'); ?>">                                     
                                    <div class="attachrpad padtops
                                    <?= theme_pick($group->theme,'boxlightrange','boxbrightgreenl','boxbrightpurplel'); ?>">
                                    <div class="addhthree">                                                                     
                                          <div class="vert-scroll scroll-area addhfour
                                          <?= theme_pick($group->theme,'dgtxtedorange boxlightrange','dgtxtedgreen boxbrightgreenl','dgtxtedpurple boxbrightpurplel'); ?>
                                          " id="gist-scroll">
                                          <? $chats = $this->chat->get_many_by(['type'=>'group','resource_id'=>$group->id]); ?>
                                                
                                          <? if(count($chats) === 0): ?>
                                          <p>No coversations started yet. Begin by typing</p>
                                          <? else: ?>
                                                <ul class="gist-list" data-url="<?= site_url('groups/get_thread/'.$joined_group->id); ?>">
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
                                                                        <h1 title="<?= $name->firstname." ".$name->lastname.""; ?>"><?= $name->firstname." ".$name->lastname; ?></h1>
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
                                                <?= form_open('groups/chat'); ?>
                                                <textarea class="groupchatbox" data-group-list = "gist-list-<?=$joined_group->id?>" data-grname="message" placeholder="Type your comment here..."></textarea>
                                                <input type="hidden" name="group_id" value="<?= $group->id; ?>">
                                                <?= form_close(); ?>
                                          </div>
                                    </div>                                    
                              </div>
                        </div>
                        <div class="txtright">
                              <div class="widget addpostass">
                                    <div class="<?= theme_pick($group->theme,'groupmbone','groupmbtwo','groupmbthree'); ?>">                                                                     
                                          <div class="title row">
                                                <div class="col-md-8 "></div>
                                                <? foreach($members[$group->id] as $member): ?>
                                                <div class="col-md-4 boxorangeright"><span>Members(<?= count($member); ?>)</span></div>
                                          </div>
                                    </div>
                                    <div class="magright">
                                    <div class="addghthree"> 
                                          
                                                                                               
                                          <div class="vert-scroll scroll-area addghfour <?= theme_pick($group->theme,'dgtxtlightrange','dgtxtlightgrange','dgtxtlightprange'); ?>">
                                                <ul>
                                                      <? foreach($member as $member_info): ?>
                                                      <li>
                                                            <div class='col-md-3'>
                                                                  <div class="image">
                                                                  <? $name = $this->user->get($member_info->user_id); echo check_image($name->image); ?>
                                                            </div>
                                                            </div>
                                                            <div class='col-md-7'>
                                                                  <h1><?= $name->firstname." ".$name->lastname; ?></h1>
                                                                  <span>Joined <?= date('jS \of F, Y',$member_info->joined) ?></span>
                                                            </div>
                                                            <div class='col-md-2'><i class="fa fa-circle online"></i>
                                                            </div>
                                                      </li>
                                                      <? endforeach; endforeach; ?>
                                                </ul>
                                          </div>
                                          <div class = "txtright <?= theme_pick($group->theme,'gbuttonone','gbuttontwo','gbuttonthree'); ?>">
                                                <div class="buttons">
                                                      <a data-reveal-id="invite" data-entity-id="<?= $group->id; ?>" class="inviteBtn"><i class="glyphicon glyphicon-comment magright"></i> INVITE</a>
                                                </div>
                                          </div>
                                    </div>
                                    </div>                                    
                              </div>
                        </div>                       
                  </div>
            <? endforeach; ?>
                    
            </div>

      </div>
</div>

<div id="addGroup" class="lightbox reveal-modal small" data-reveal>
      <h1>Create Group</h1>                     
      <section>
            <!--Section Row-->
            <?= form_open_multipart('groups/create'); ?>
            <div class="sec-row">
                  <div class="sub-row">
                        <p>Group Title </p>
                        <input name="title" type="text">
                  </div>
                  <div class="sub-row">
                        <p>Overview </p>
                        <textarea name="overview"></textarea>
                  </div>
                  <div class="sub-row">
                        <p>Privacy </p>
                        <select name="privacy" class="ios-button inheritance">
                              <option value="public">Public</option>
                              <option value="private">Private</option>
                        </select>
                  </div>
                  <div class="sub-row">
                        <p>Upload Group avatar</p>
                        <label class="fileContainer">
                              <span>Select Image</span>
                              <input type="file" name="file">
                        </label>
                  </div>
                  
                  <div class="row">
                        <div class="col-md-3"><p>Theme </p></div>
                        <div class="col-md-3">
                              <input type="radio" name="theme" id="orange" value="orange" checked>
                              <label for="orange"><i class="fa fa-cloud fa-3x orangecloud"></i></label>
                        </div>
                        <div class="col-md-3">
                              <input type="radio" name="theme" id="green" value="green">
                              <label for="green"><i class="fa fa-cloud fa-3x greencloud"></i></label>
                        </div>
                        <div class="col-md-3">
                              <input type="radio" name="theme" id="purple" value="purple">
                              <label for="purple"><i class="fa fa-cloud fa-3x purplecloud"></i></label>
                        </div>
                  </div>

                  <div class="sub-row">
                        <p>Add Tag </p>
                        <?= $shared_interest; ?>
                  </div>
                  <div class="profile-interests sub-row">
                        <p></p>
                        <ul>
                        
                        </ul>
                  </div>

                  <button class="ios-button nature"><i class="fa fa-save"></i> Create</button>
                  
            </div>
            <?= form_close(); ?>
      </section>
      <a class="close-reveal-modal">&#215;</a>
</div>

<div id="invite" class="lightbox reveal-modal invite medium" data-reveal>

      <h1>Be Social, Invite</h1>

      <div class="row">
            <div class="col-md-6">
                  <section>
                        <div class="sec-row">
                              <?= form_open('groups/invite'); ?>
                              <div class="sub-row">
                                    <p></p>
                                    <?= $users_drop; ?>
                              </div>
                              <div class="profile-interests sub-row">
                                    <p></p>
                                    <ul>
                                    
                                    </ul>
                              </div>
                              <div class="sub-row">
                                    <p></p>
                                    <button class="btn btn-primary hijax-post">Invite</button>
                              </div>
                              <input type="hidden" name="group_id" value="">
                              <?= form_close(); ?>
                        </div>
                  </section>
            </div>
            <span class='or'>OR</span>
            <div class="col-md-6">
                  <section>
                        <div class="sec-row">
                              <div class="sub-row">
                                    <p></p>
                                    <!--a href="https://twitter.com/share" class="twitter-share-button" data-via="twitterapi" data-lang="en">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script-->
                              </div>
                        </div>
                  </section>
            </div>
            <div class="clear"></div>
      </div>

      <a class="close-reveal-modal">&#215;</a>
</div>
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
                                          ">
                                          <? $chats = $this->chat->get_many_by(['type'=>'group','resource_id'=>$group->id]); ?>
                                                <ul>
                                          <? if(count($chats) === 0): ?>
                                          <p>No coversations started yet. Begin by typing</p>
                                          <? else: ?>
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
                                                                        <h1><?= $name->firstname." "; ?><?if(strlen($name->lastname) < 9){echo $name->lastname;}else{echo substr($name->lastname, 0, 6)."...";}; ?></h1>
                                                                  </div>
                                                                  <div class="col-md-5">
                                                                        <small><? $interval = get_date_diff((int)time(),(int)$chat->time,1); echo $interval = ' '? $interval: $interval.' ago' ?></small>
                                                                  </div>
                                                                  <div class="clear"></div>
                                                                  <div class="row">
                                                                        <div class="col-md-12">
                                                                              <p><?= $chat->message; ?></p>
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
                                                <textarea class="groupchatbox instant-text" name="message" placeholder="Type your comment here..."></textarea>
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
                                                <div class="col-md-4 boxorangeright"><span>Members(<?= count($members); ?>)</span></div>
                                          </div>
                                    </div>
                                    <div class="magright">
                                    <div class="addghthree"> 
                                          
                                                                                               
                                          <div class="vert-scroll scroll-area addghfour <?= theme_pick($group->theme,'dgtxtlightrange','dgtxtlightgrange','dgtxtlightprange'); ?>">
                                                <ul>
                                                      <? foreach($members as $member_info): ?>
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
                                                      <? endforeach; ?>
                                                </ul>
                                          </div>
                                          <div class = "txtright <?= theme_pick($group->theme,'gbuttonone','gbuttontwo','gbuttonthree'); ?>">
                                                <div class="buttons">
                                                      <a data-reveal-id="invite"><i class="glyphicon glyphicon-comment magright"></i> INVITE</a>
                                                </div>
                                          </div>
                                    </div>
                                    </div>                                    
                              </div>
                        </div>                       
                  </div>
<div class="slider message-pg">
	<div class="widget-column">
    	<div class="widget small greenish">
			<div class="content">
				<div class="report-view">
					<h1 class="unread"><?= $unread; ?></h1>
                    <p>Unread</p>
				</div>
			</div>
		</div>
	</div>

	<div class="widget-column">
		<div class="widget">

			<div class="title row">
				<div class="col-md-6"><span class="glyphicon glyphicon-comment"></span> Messages</div>
                <!-- <div class="col-md-6 button-space"><a data-reveal-id="myModal" class="pull-right ios-button"><span class="glyphicon glyphicon-edit"></span> COMPOSE</a></div>	 -->
            </div>
            
            <div class="row">
                <div class="col-md-12 offset-row"><input class="auto-text" type="text" placeholder="Type users name to get started..."/></div>
            </div>

            <div id="pointer-area">
                <? $default_user = "";$blockable_user="";?>
                <?if((bool)$pointers):?>                    
                    <? foreach ($pointers as $count => $message): ?>                        

                	    <div class="preview <?=($user_id !== $message->sender_id)? "user-$message->sender_id ": "user-$message->recipient_id ";?><?=((bool)$message->viewed || $user_id === $message->sender_id) && $count !== 0 ? "read": "";?> <?= ($count == 0)? "selected read": "";?>" data-url="<?= ($user_id !== $message->sender_id)? site_url('messages/get_thread/'.$message->sender_id): site_url('messages/get_thread/'.$message->recipient_id) ;?>">
        					<div class="text">
        						<!-- <div class="image rounded-image"><?=img(base_url('assets/imgs/profile-pic.jpg'));?></div> -->
        						<h1>
                                    
                                    <?if($user_id === $message->sender_id):?>
                                        
                                        <?  $user = $blockable_user = $this->user->get($message->recipient_id); echo $user->firstname." ".$user->lastname; ?>
                                        <? if($count==0):
                                           
                                                $default_user = $user;

                                            endif; ?>                                       

                                    <?else:?>

                                        <?  $user = $blockable_user = $this->user->get($message->sender_id); echo $user->firstname." ".$user->lastname; ?>
                                        <?  if($count==0):

                                                $default_user = $user; 
                                            endif;
                                        ?>                                        

                                    <?endif;?>                                                                    
                                </h1>
        						<p><?= $message->message; ?></p>
                                <div class="preview-who-container col-md-5">
                                    <span class="preview-who"><?= get_date_diff((int)time(), (int)$message->created, 1)." ago"; ?></span>
                                </div>
                                <div class="col-md-7 user-interaction">
                                    <span><a class="block-user" data-block-id = "<?=$blockable_user->id;?>" href="<?=site_url('/messages/block_user/'.$blockable_user->id);?>">block user</a></span>
                                    <span><a class="delete-thread" href="<?=site_url('/messages/delete_thread/'.$blockable_user->id);?>">delete thread</a></span>
                                </div>
        					</div>
    				    </div>                                                                
                    <? endforeach; ?>
                <?else:?>
                    <p class="default-msg">No available Messages</p>
                <?endif;?>
			</div>	
		</div>
	</div>
   
	<div class="widget-column converse-container-col <?=(bool)$pointers ?"":"template"?>">
		<div class="widget converse-container">
            
			<div class="title row">
				<div class="col-md-3 column">
                    <div class="passport image rounded-image">
                        <?if($pointers):?>
                            <?=check_image($default_user->image);?>
                        <?else:?>

                            <?= img(base_url('assets/imgs/profile-pic.jpg'));?>
                        <?endif;?>
                    </div>
                </div>                  
                <div class="col-md-9 column msg-user-name">
                    <h1><?=(bool)$pointers ? $default_user->firstname." ".$default_user->lastname:"No Conversation";?></h1>
                </div>                 
            </div>	            
            <?= form_open('messages/send');?>		                         
            <div class="scroll-area" id="message-scroll">
                
            </div>
            <div>            
                <input type="hidden" name="recipients" value="<?=(bool)$pointers ? $default_user->id: "";?>">
                <textarea name="message" class="instant-post"></textarea>
            </div>
            <?=form_close();?>
		</div>
	</div>		    
   
    <div class="widget-column">
        <div class="widget small block">
            <div class="content">
                <div class="report-view">
                    <h1 class="toggleVisible unread" data-hide-id="blocked-list"><?=$blocked_count?></h1>
                    <p>Blocked</p>
                </div>
            </div>
        </div>

        <div class="widget list scroll-area" id="blocked-list">
            
            <div class="blocked-user temp"> 
                <div class="text row">
                    <div class="col-md-4">
                        <div class="image rounded-image">
                            <img src="">
                        </div>                        
                    </div>           
                    <div class="blocked-users-detail col-md-8">
                        <h1></h1>                                                                                                                              
                        <a href="" class="unblock"><i class="fa fa-reply"></i> Unblock</a>
                    </div>             
                </div>
            </div>

            <?if($blocked):?>
                <?foreach($blocked as $block):?>   
                    <div class="blocked-user"> 
                        <div class="text row">
                            <div class="col-md-4">
                                <div class="image rounded-image">
                                    <?=check_image($block->image);?>
                                </div>                        
                            </div>           
                            <div class="blocked-users-detail col-md-8">
                                <h1>                                                                                    
                                    <?= $block->firstname.' '.$block->lastname; ?>                                                                                                                                                                           
                                </h1>
                                <a href="<?=site_url('/messages/unblock_user/'.$block->blocked_id);?>" class="unblock"><i class="fa fa-reply"></i> Unblock</a>
                            </div>             
                        </div>
                    </div>
                <?endforeach?>
            <?endif;?>
        </div>

    </div>                       
</div>
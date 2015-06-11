<ul class="gist-list" data-url="<?= site_url('groups/get_thread/'.$group->id); ?>">
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
</div>
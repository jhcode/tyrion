<? if(!empty($messages)): ?>
    <? foreach($messages as $message): ?>
        <? if($message->sender_id !== $logged_in_user_id): ?>
        <div class="converse left">
            <div class="edge"></div>
            <p><?= $message->message; ?></p>                        
            <a class="who time">by <?php $name = $this->user->get($message->sender_id); echo $name->firstname." ".$name->lastname; ?></a>
            <a class="time"><?= get_date_diff((int)time(), (int)$message->created, 1)." ago"; ?></a>
            <div></div><!--Clearing Div-->
        </div>
        <? else: ?>
        <div class="converse right">
            <div class="edge"></div>
            <p><?= $message->message; ?></p>                        
            <a class="who time">by You</a>
            <a class="time"><?= get_date_diff((int)time(), (int)$message->created, 1)." ago"; ?></a>
            <div></div><!--Clearing Div-->
        </div>
        <? endif; ?>
    <? endforeach ?>
<? else: ?>
    <div class="no-messages">No conversations with this guy yet</div>
<? endif; ?>
<!-- <input type="hidden" class="form-control" value="<?= $sender_id; ?>" name="recipients"> -->
 
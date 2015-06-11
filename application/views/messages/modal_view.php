
<div class="lightbox_bg"></div>
  <div class="light_box">
    <div class="iconic" style="margin-top:0px">
      <div class="modal-header">
          <button type="button" class="close close_modal" data-dismiss="modal">&times;</button>
          <h3>Notice</h3>
      </div>
      <div class="modal-body">

      <?php

        foreach($messages as $message){
          echo '<h3>'.$message.'</h3>';
        }

      ?>
      </div>
      <div class="modal-footer">
       <a type="button" class="close_modal btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</a>
      </div>
    </div>
  </div>
<div class="modal fade" id="myModalSignOff<?php echo get_the_id() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header label-default">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> <i class="glyphicon glyphicon-lock"></i>  <span>Final Sign off</span>  </h4>
      </div>
      <div class="modal-body">
        <?php 
      acf_form(array(
        'post_id' => get_the_id(),
        'post_title'  => false,
        'fields' => ['final_approval'],
        'submit_value'  => 'Update Page Data'
      )); ?>
      </div>
    
    </div>
  </div>
</div>
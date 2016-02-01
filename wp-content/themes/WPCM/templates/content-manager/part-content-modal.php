 <div class="modal fade" id="myModalContent<?php echo get_the_id() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header <?php echo $color; ?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-text-color"></i>  <span>Content</span></h4>
      </div>

      <div class="modal-body">
       <span>The content is: </span>
      
      <span class="label <?php echo $color; ?>"> <?php echo $label; ?></span>
        <?php /* } else { ?> 
       <span class="label label-default ?>">Pending</span>
         <?php } */ ?>
       <hr>
        <?php 
      acf_form(array(
        'field_groups' => 'group_54ffabdbd47f0',
        'post_id' => get_the_id(),
        'post_title'  => false,
        'fields' => ['upload_content','approve'],
        'submit_value'  => 'Upload Supply Content'
      )); ?>
      </div>
    
    </div>
  </div>
</div>
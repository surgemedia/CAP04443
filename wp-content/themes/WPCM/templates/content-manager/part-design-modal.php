  <div class="modal fade" id="myModalDesign<?php echo get_the_id() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header <?php echo $color_design; ?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon glyphicon-picture"></i>  <span>Design</span></h4>
      </div>

      <div class="modal-body">
      
      <p>To review your design, click the link below then the feedback tab on the bottom right of your design</p>
       <div class="col-lg-12">
      <div class="well col-lg-6">
      <p>It will look like this</p>
      <img src="/wp-content/themes/signature-promotions/assets/images/feedback.png" alt=""></div>
      </div>
      
      <p>Click below to review your design, then click the feedback tab</p>
     
     <a href="/wp-content/themes/signature-promotions/design/1/index.html"class="btn btn-info">View Graphic Design</a>
       <hr>
         <?php /*
      acf_form(array(
        'field_groups' => 'group_54ffabdbd47f0-2',
        'post_id' => get_the_id(),
        'post_title'  => false,
        'fields' => ['wireframe_aprove_design','graphic_design_approve'],
        'submit_value'  => 'Update Page Data'
      )); 
    */
      ?>
      </div>
    
    </div>
  </div>
</div>
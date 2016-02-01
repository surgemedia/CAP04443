<?php
include ('vars-acf-fields.php'); ?>
<?php
$args = array('post_parent' => get_the_id(), 'post_type' => 'page', 'posts_per_page' => - 1, 'post_status' => 'any',);
?>
<?php
$childs = get_children($args, $output); ?>
<div  id="approval_overlay">
<ul class="">
  <li>

  <div class="btn pull-right <?php
echo $color; ?> pull-left" data-toggle="modal" href="#myModalContent<?php
echo get_the_id() ?>" aria-expanded="false" aria-controls="collapseContent<?php
echo get_the_id() ?>">
    <i class="glyphicon glyphicon-text-color"></i>   <span>Content</span>
  </div>
  </li>

  <li> <div class="btn pull-right <?php
echo $color_design; ?> pull-left" data-toggle="modal" href="#myModalDesign<?php
echo get_the_id() ?>" aria-expanded="false" aria-controls="collapseDesign<?php
echo get_the_id() ?>">
    <i class="glyphicon glyphicon-picture"></i>   <span>Review Design</span>
  </div></li>

  <li> <div class="btn pull-right label-default pull-left" data-toggle="modal" href="#myModalSignOff<?php
echo get_the_id() ?>" aria-expanded="false" aria-controls="collapseDesign<?php
echo get_the_id() ?>">
    <i class="glyphicon glyphicon-lock"></i>   <span>Final Signoff</span>
  </div></li>

  <li>
    <a href="http://signaturepromotions.surgehost.com.au/content-manager/" class="btn pull-right btn-info">
      <i class="glyphicon glyphicon-link"></i> <span> All Pages</span>
    </a>
  </li>
</ul>
  <?php
include ('part-content-modal.php'); ?>
  <?php
include ('part-design-modal.php'); ?>
  <?php
include ('part-signoff-modal.php'); ?>



</div>

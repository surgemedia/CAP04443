<?php
// include ('vars-acf-fields.php');
 ?>
<?php
// debug(get_id_from_slug('design-review'));

$GLOBALS["WPCM_id"] = get_id_from_slug('design-review');
$args = array('post_parent' => get_the_id(), 'post_type' => 'page', 'posts_per_page' => - 1, 'post_status' => 'any',);
?>
<?php
$childs = get_children($args, $output); ?>
<div  id="approval_overlay">

<ul class="">
<li><span class="title ">Review Panel</span></li>
  <li class="content-tab">
  <!-- <a class="btn pull-right  " data-toggle="collapse" href="#content-childern">
    <i class="glyphicon glyphicon-text-color"></i><span>Content Review</span>
  </a> -->
  </li>

  <li class="design-tab">
  <a class="btn pull-right "  data-toggle="collapse" href="#design-childern" >
    <i class="fa-picture-o fa"></i>   <span>Design Review</span>
  </a>
  <div id="design-childern" class="childern collapse">
<?php $wf_list = get_field('wireframe',$GLOBALS["WPCM_id"]); ?>
<?php for ($i=0; $i < count($wf_list); $i++) { ?>
<?php if(isset($wf_list[$i]['link'])): ?>
  <a class="btn pull-right  wireframe" href="<?php echo $wf_list[$i]['link'] ?>" >
    <i class="verison-number">V<?php echo $i+1 ?></i><span>Wireframe</span>
    </a>
  <?php endif; ?>
<?php } ?>
<?php $gd_list = get_field('design',$GLOBALS["WPCM_id"]); ?>

<?php for ($i=0; $i < count($gd_list); $i++) { ?>
  <a class="btn pull-right  design" href="<?php echo get_site_url().'/design-review/'."?v=".$i."?page=0" ?>">
    <i class="verison-number ">V<?php echo $i+1 ?></i><span>Design</span>
    </a>
<?php } ?>


  </div>

  </li>

  <!-- <li> 
  <a class="btn pull-right label-default pull-left disable" disabled="disabled" data-toggle="collapse" href="#collapseExample">
    <i class="glyphicon glyphicon-lock"></i>   <span>Website Review</span>
  </a> -->
  <!-- </li> -->

  <li>
    <a href="<?php echo get_home_url(); ?>" class="btn pull-right ">
      <i class="glyphicon glyphicon-link"></i> <span>Page Overview</span>
    </a>
  </li>
</ul>
  <?php
//include ('part-content-modal.php'); ?>
  <?php
//include ('part-design-modal.php'); ?>
  <?php
//include ('part-signoff-modal.php'); ?>



</div>

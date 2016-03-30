<?php
$image = $args[1];
$image_url = aq_resize($image,960,1080,true,true,true);
?>
<div id="login-area" class="frame" style="background-image:url(<?php echo $image_url?>)">
  
  <div class="box">
    <div>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active col-xs-6">
          <a class="prepaid" href="#prepaid" aria-controls="prepaid" role="tab" data-toggle="tab">
            Envelope
          </a>
          
        </li>
        <li role="presentation" class="col-xs-6">
          <a class="postpaid" href="#postpaid" aria-controls="postpaid" role="tab" data-toggle="tab">
            Gallery
          </a>

        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="prepaid">
          <div class="info">Enter your Unique ID provided on your envelope.</div>
          <div class="form">
          <?php if(user_logged_in() == false){ ?>
            <?php includePart('components/atom-user-login-form.php'); ?>
            <?php } else { ?>
            <h2>Hi, <?php echo wp_get_current_user()->data->display_name; ?></h2>
            <a class="btn-basic text-center" href="<?php echo get_permalink( get_page_by_title( 'Get Photos' )->ID ); ?>">Order Now</a>
             <a  CLASS="btn-basic text-center" href="<?php echo wp_logout_url( home_url() ); ?>">
                LOG OUT
              </a>
            <?php } ?>
             <?php if($_SESSION['failed'] == true){ ?>
               <small class="error">Sorry,that login is incorrect.</small>
               <?php } ?>
          </div>
          <div class="info"><a href="<?php the_field('download_more'); ?>">Request an ID</a></div>
          <div class="info pull-right"><a data-toggle="modal" data-target="#needHelp" href="javascript:void(0)">I need help</a></div>
              <!-- Modal -->
        <div class="modal fade" id="needHelp" tabindex="-1" role="dialog" aria-labelledby="needHelpLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content col-lg-12">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1 class="modal-title" id="needHelpLabel"><?php the_field('model_title'); ?></h1>
              </div>
              <div class="modal-body">
                <?php the_field('model_content'); ?>
              </div>
            </div>
          </div>
        </div>
        </div>
       
        <div role="tabpanel" class="tab-pane" id="postpaid">
          <div class="info"> Browse proofs, select and order.Enter the username and password provided by your school, club, or association"</div>
          <div class="form">
            <form name="" id="" action="http://gallery.myprophoto.com.au/wap/login" method="post">
              <p class="login-username">
                <input type="text" name="log" id="user_login" class="input" value="" size="20" placeholder="Username">
              </p>
              <p class="login-password">
                <input type="password" name="pwd" id="user_pass" class="input" value="" size="20" placeholder="Password">
              </p>
              
              <p class="login-submit">
                <input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="LOGIN">
              </p>
            </form>
          </div>
          
        </div>
        
      </div>
    
    </div>
  </div>
</div>
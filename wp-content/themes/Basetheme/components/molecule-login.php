<?php
$image = $args[1];
$image_url = aq_resize($image,960,1080,true,true,true);
?>
<div class="frame" style="background-image:url(<?php echo $image_url?>)">
  
  <div class="box">
    <div>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active col-xs-6">
          <a href="#prepaid" aria-controls="prepaid" role="tab" data-toggle="tab">
            Prepaid
          </a>
        </li>
        <li role="presentation" class="col-xs-6">
          <a href="#postpaid" aria-controls="postpaid" role="tab" data-toggle="tab">
            Postpaid
          </a>
        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="prepaid">
          <div class="info">Short login instructions for prepaid users.</div>
          <div class="form">
          <?php if(user_logged_in() == false){ ?>
            <?php includePart('components/atom-user-login-form.php'); ?>
            <?php } else { ?>
            <h2>Hi, <?php echo wp_get_current_user()->data->display_name; ?></h2>
            <a href="<?php echo get_permalink( get_page_by_title( 'Get Photos' )->ID ); ?>">Order Now</a>
            <?php } ?>
          </div>
          <div class="info">Request an ID</div>
        </div>
        
        <div role="tabpanel" class="tab-pane" id="postpaid">
          <div class="info">Short login instructions for prepaid users.</div>
          <div class="form">
            <form name="" id="" action="" method="post">
              
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
      <div class="download">
        <span class="info">Download more info about prepaid & postpaid service</span>
        <i class="icon-document"></i>
        
      </div>
      
    </div>
  </div>
</div>
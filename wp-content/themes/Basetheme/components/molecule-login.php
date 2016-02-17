<?php
  $image=$args[1];
?>
<div class="frame" style="background-image:url(<?php echo $image?>)">
  
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
  
  <form name="loginform-custom" id="loginform-custom" action="<?php // echo $_SERVER['PHP_SELF']; ?>" method='post' method="post">
      <p class="login-username">
        <input type="text" name="username" id="user_login" class="input" value="" size="20" placeholder="Username">
      </p>
      <p class="login-submit">
        <input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="LOGIN">
        <input type="hidden" name="redirect_to" value="http://capricorn.local/shop/">
      </p>
    </form>
  <?php 
//programmatic_login('surgemedia');
  if(isset($_POST['username'])){
    programmatic_login($_POST['username']);
    }
    ?>

<?php 
debug(wp_get_current_user()->user_email);

 ?>


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
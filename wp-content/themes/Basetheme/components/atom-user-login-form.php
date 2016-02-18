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
if(isset($_POST['username'])){
programmatic_login($_POST['username']);
}
?>
<?php
debug(wp_get_current_user()->user_email);
?>
<?php if(is_user_logged_in()){ ?>
<script>
	window.location.href = "/get-photos";
</script>
<?php } else { ?>
<script>
	window.location.href = "/";
</script>
<?php } ?>
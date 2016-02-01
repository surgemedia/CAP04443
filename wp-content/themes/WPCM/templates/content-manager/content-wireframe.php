
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
		<?php //$repeat = the_field('wireframes',17) ?>
		<?php $list = get_field('wireframes',18); ?>
		<?php $images = $list[count($list)-1]['files']; ?>
		<?php// debug($list[count($list)-1]); ?>

<?php
		if( $images ): ?>
		    <ul>
		        <?php foreach( $images as $image ): ?>
							<div class="item active">
		                     <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
		                <p><?php echo $image['caption']; ?></p>
		            </div>
		        <?php endforeach; ?>
		    </ul>
		<?php endif; ?>

  </div>
<?php 
	get_header();
		while ( have_posts() ) : the_post(); 
				echo $storeId =  get_the_ID();?>
            <div class="main-post-div">
            	<div class="store-image">
            		<?php the_post_thumbnail('thumbnail')?>
            	</div>
	            <div class="single-page-post-heading">
	            	<h1><?php the_title(); ?></h1>
	            </div>
	            <div class="content-here">
	            	<?php  the_content();  ?>
	            </div>
	            <div class="store-detailed-address">
	            	<?php echo $locAddress =  get_post_meta($storeId, "loc_address", true); ?>
	            </div>
            </div>
            <div class="loaction-map-store">
            	<iframe
				  width="600"
				  height="450"
				  frameborder="0" style="border:0"
				  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAski2vzOgLQ-2s-OhNYUqGbgu5adpUZSQ
				    &q=Space+Needle,Seattle+WA" allowfullscreen>
				</iframe>
            </div>
        <?php endwhile; 
get_footer(); ?>
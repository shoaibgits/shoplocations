<?php 
	get_header();
		while ( have_posts() ) : the_post(); 
				$storeId =  get_the_ID();?>
		<div class="store-detail-page">
			
            <div class="main-store-section">
            	<div class="store-image-details">
            		<?php the_post_thumbnail('large')?>
            	</div>
			</div>

			<div class="store-details-extras">
				<div class="store-detail-heading">
					<h1><?php the_title(); ?></h1>
				</div>
				<!--  <div class="store-detail-content">
				<?php  //the_content();  ?>
				</div> -->
				<div class="store-detailed-address">
					<div class="str-address">
					<i class="fa fa-home" aria-hidden="true"></i>  <?php echo get_post_meta($storeId, "loc_address", true); ?></div>
					<div calss="str-phone">
					<i class="fa fa-phone" aria-hidden="true"></i>    <span class="extra-infos"><?php echo get_post_meta($storeId, "loc_phone", true); ?></span></div>
					<div class="str-fax">
					<i class="fa fa-fax" aria-hidden="true"></i>    <span class="extra-infos"><?php echo get_post_meta($storeId, "loc_fax", true); ?></span></div>
					<div class="str-email">
					<i class="fa fa-envelope-o" aria-hidden="true"></i>    <span class="extra-infos"><?php echo get_post_meta($storeId, "loc_email", true); ?></span></div>
					<div class="str-website">
					<i class="fa fa-globe" aria-hidden="true"></i>    <span class="extra-infos"><?php echo get_post_meta($storeId, "loc_website", true); ?></span></div>
				</div>

				<div class="responsible-section">
					<h2>Responsible For:</h2>
					<span>
						Asia, Central America, (Jamaica, Maxico)<br>
						Europ, North America(Canada, USA)
					</span>
				</div>
			</div>
            <div class="loaction-map-store">
					<?php 
						$latLat =  get_post_meta($storeId, "loc_latitude", true);
						$latLong =  get_post_meta($storeId, "loc_longitude", true);
					?> 
            	<iframe src="https://maps.google.com/maps?q=<?php echo $latLat; ?>,<?php echo $latLong; ?>&hl=en&z=14&amp;output=embed" width="100%" height="385" frameborder="0" style="border:0" allowfullscreen></iframe>
        		<!-- <iframe
				  width="600"
				  height="450"
				  frameborder="0" style="border:0"
				  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAski2vzOgLQ-2s-OhNYUqGbgu5adpUZSQ
				    &q=40.7127837,-74.0059413" allowfullscreen>
				</iframe> -->
            	
            </div>
        </div>
        <?php endwhile; 
get_footer(); ?>
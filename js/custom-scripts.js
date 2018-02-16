jQuery(document).ready(function () {
   	jQuery('#country').on('change', function() {
  		jQuery('#storelocator').submit();
  });
});

jQuery('#storelocator').submit(function(e) {
        e.preventDefault();

        var data = jQuery(this).serialize();

        var form = this,
        $form = jQuery("#storelocator");
        jQuery.ajax({
            type: "POST",
            url: "/wordpress/wp-admin/admin-ajax.php",
            dataType: "html",
            data: 'action=my_ajax&'+data,
            success: function(response) {  
                jQuery('.global-map-section').hide();
                jQuery('.store-post-data').html(response);
                // var n = $( "div" ).length;
                var storeLength = jQuery('.store-wrapper').length;
                if(storeLength >= 2 ){
                    jQuery('.hidden-fields-selection').css('display', 'block');
                }
            }
        });
});
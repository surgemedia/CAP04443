/*===================================
=            Menu Action            =
===================================*/
var menu = {
	init: function(tag){
		jQuery(tag).click(function(){
			jQuery(this).parent().siblings(".box").toggleClass("open");
		});
	}	
};

menu.init("button.navbar");



/*=========================================
=            Chosen Activation            =
=========================================*/
var chosen={
	select: function(tag){
		jQuery(tag).chosen({
			disable_search: true,
			width: "60px"
		});
	}
};

jQuery(document).ready(function(){
	chosen.select(".quantity select");
});

// Chosen touch support.
    if (jQuery('.chosen-container').length > 0) {
      jQuery('.chosen-container').on('touchstart', function(e){
        e.stopPropagation(); e.preventDefault();
        // Trigger the mousedown event.
        jQuery(this).trigger('mousedown');
      });
    }
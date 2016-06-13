/*===================================
=            Menu Action            =
===================================*/
var menu = {
	init: function(tag){
		jQuery(tag).click(function(){
      jQuery(this).toggleClass('cross'); 
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

/*=========================================
=            Placeholder Forms            =
=========================================*/
function placeholder_login(){
		jQuery('#user_login').attr('placeholder', 'Unique ID');
}
placeholder_login();

/*=========================================
=            Packages Collapse            =
=========================================*/
jQuery("[class*='collapseExample-']").collapse('hide');
jQuery("[class*='collapseExample-']").on('show.bs.collapse', function () {
  jQuery("[class*='collapseExample-']").collapse('hide');
});

jQuery(document).ready(function(){
	if(jQuery('#billing_email')){
		jQuery('#billing_email').val('');
		
	}
});

function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
        }
        return "";
    }


jQuery(document).bind('gform_post_render', function(){
   jQuery('[data-hide-on-submit]').addClass('hide');
});




function showProductPosition(product){
  var the_id = jQuery(product).data('prodcartid');
      //console.log(the_id);
      jQuery('[data-prodid="'+the_id+'"]')[0].scrollIntoView({
          behavior: "smooth", // or "auto" or "instant"
          block: "start" // or "end"
      });
       jQuery('[data-prodid="'+the_id+'"] a.detail')[0].click();
}
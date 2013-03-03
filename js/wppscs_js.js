jQuery.noConflict();

//check category not being empty on submit
jQuery('#wppscs_form').submit(function() {
  var cat = jQuery('#wppscs_prod_category').val();	
  var sel = jQuery("#wppscs_prod_sel").val();
  
  if ((cat == "") && (sel == "category")){
	alert("Please enter a value for Category.");
	jQuery('#wppscs_prod_category').focus();
    return false;
  }else{  
	return true;
  }
});

function slideone(thechosenone) { //slide down and up for category
     jQuery('div[name|="Category_name"]').each(function(index) {
		  var sel = jQuery("#wppscs_prod_sel").val();
          if ((jQuery(this).attr("id") == thechosenone) && (sel == "category")) {
			   jQuery('#wppscs_prod_category').val(''); //empty the value when slide down
               jQuery(this).slideDown(200);
          }
          else {
               jQuery(this).slideUp(200);
          }
     });
}
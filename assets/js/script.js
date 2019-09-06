jQuery(document).ready(function() {
    jQuery(document).on('click','.epic-enrol-btn',function(){
        // console.log(jQuery('#frmEnrolStudent').serialize());
        var post_data = "action=mybooklibrary&param=enrol_student&"+jQuery('#frmEnrolStudent').serialize();
        jQuery.post(mybookajaxurl,post_data,function(response){
            var data = jQuery.parseJSON(response);
            if(data.status == 1){
                jQuery.notifyBar({
                    cssClass:"success",
                    html:data.message
                });
                setTimeout(function(){
                    window.location.reload();
                },1300)
            }else{

            }
        });
    });

    jQuery('#btn-upload').on("click",function(){
    	var image =  wp.media({
    		title:"Upload image for My Book",
    		multiple:false
    	}).open().on("select",function(){
    		var uploaded_image = image.state().get("selection").first();
    		var getImage = uploaded_image.toJSON().url;
    		jQuery('#show-image').html("<img src='"+getImage+"' style='height:50px;width:50px;'>");
    		jQuery('#image_name').val(getImage);
    	});
    });

    jQuery('#my-books').DataTable();

    jQuery('#frmAddBook').validate({
    	submitHandler:function(){
    		var post_data = "action=mybooklibrary&param=save_book&"+jQuery('#frmAddBook').serialize();
    		jQuery.post(mybookajaxurl,post_data,function(response){
    			var data = jQuery.parseJSON(response);
    			if(data.status == 1){
    				jQuery.notifyBar({
    					cssClass:"success",
    					html:data.message
    				});
    				setTimeout(function(){
    					// window.location.reload();
    					window.location.href = "admin.php?page=book-list"
    				},1300)
    			}else{

    			}
    		});
    	}
    });

    /*edit book*/
    jQuery('#frmEditBook').validate({
    	submitHandler:function(){
    		var post_data = "action=mybooklibrary&param=edit_book&"+jQuery('#frmEditBook').serialize();
    		jQuery.post(mybookajaxurl,post_data,function(response){
    			// console.log(response);
    			var data = jQuery.parseJSON(response);
    			if(data.status == 1){
    				jQuery.notifyBar({
    					cssClass:"success",
    					html:data.message
    				});
    				setTimeout(function(){
    					// window.location.reload();
    					window.location.href = "admin.php?page=book-list"
    				},1300)
    			}else{

    			}
    		});
    	}
    });

    /*delete book*/
    jQuery(document).on("click",".btnbookdelete",function(){
    	var conf = confirm("Are you sure to delete this Book?");
    	if(conf){
    		var book_id = jQuery(this).attr("data-id");
	    	var post_data = "action=mybooklibrary&param=delete_book&book_id="+book_id;
    		jQuery.post(mybookajaxurl,post_data,function(response){
    			// console.log(response);
    			var data = jQuery.parseJSON(response);
    			if(data.status == 1){
    				jQuery.notifyBar({
    					cssClass:"success",
    					html:data.message
    				});
    				setTimeout(function(){
    					location.reload();
    				},1300)
    			}else{

    			}
    		});
    	}
    });

    jQuery('#frmAddAuthor').validate({
        submitHandler:function(){
            var post_data = "action=mybooklibrary&param=save_author&"+jQuery('#frmAddAuthor').serialize();
            jQuery.post(mybookajaxurl,post_data,function(response){
                var data = jQuery.parseJSON(response);
                console.log(response);
                if(data.status == 1){
                    jQuery.notifyBar({
                        cssClass:"success",
                        html:data.message
                    });
                    setTimeout(function(){
                        // window.location.reload();
                        window.location.href = "admin.php?page=manage-author"
                    },1300)
                }else{

                }
            });
        }
    });

    jQuery('#frmAddStudent').validate({
        submitHandler:function(){
            var post_data = "action=mybooklibrary&param=save_student&"+jQuery('#frmAddStudent').serialize();
            jQuery.post(mybookajaxurl,post_data,function(response){
                var data = jQuery.parseJSON(response);
                console.log(response);
                if(data.status == 1){
                    jQuery.notifyBar({
                        cssClass:"success",
                        html:data.message
                    });
                    setTimeout(function(){
                        // window.location.reload();
                        window.location.href = "admin.php?page=manage-student"
                    },1300)
                }else{

                }
            });
        }
    });
} );
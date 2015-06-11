$(document).ready(function(){

	setTimeout('$(".quick-show-error").slideUp("fast")',6000);

    $("#try_simer").click(function() {

        $("#lightbox_bg").fadeIn("fast", function() {
        	$("#light_box").fadeIn("fast");
        });
        return false;
    });

    $("#lightbox_bg").click(function() {

    	$("#light_box").fadeOut("fast");
    	$("#lightbox_bg").fadeOut("fast");
    });

    $(".video_link a").click(function() {
    	$(".video_container").slideToggle("fast");
    });

    $(document).on('click',"label.fancy-box", function() {

        $(this).toggleClass("checked");
        if($(this).hasClass("checked")) {
            $(this).next("input.fancy-box").attr("checked","checked");
        }
        else {
            $(this).next("input.fancy-box").removeAttr("checked");
        }
    });
});
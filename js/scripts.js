$(function(){
	var site_w = $(".site").css("width");
	var lineHeight = site_w.split("px");
	lineHeight = lineHeight[0]*0.5+"px";
	$('.site').each(function(index, el) {
		$(this).css({
			"height": site_w
		});
	});
	$('.site-content .local-link').each(function(index, el) {
		$(this).css({
			"line-height": lineHeight
		});
	});
	$(function() {
		$('nav#menu').mmenu();
	});
});
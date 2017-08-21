function displayConff()
{
	$('html, body').animate({
		scrollTop: $(document).height()
	}, 1500);
	$.ajax({
		method: "POST",
		data: { "method": "getConfForm" },
		dataType: "html",
		url: 	"./myLocal/index.php"
		}).done(function( data ) {
			$("#conffZone").append( data );
			$("#conffZone").slideToggle(500);
	});
}

function cleanTag( url )
{
	window.history.pushState("","", url.split("#")[0]);
}

function closeMM()
{
	$(".mm-opened").each(function(index, el)
	{
		$(this).removeClass('mm-opened');
	});
	$(".mm-opening").each(function(index, el)
	{
		$(this).removeClass('mm-opening');
	});
	$(".mm-background").each(function(index, el)
	{
		$(this).removeClass('mm-background');
	});
	$(".mm-current").each(function(index, el)
	{
		$(this).removeClass('mm-current');
	});
	$(".mm-opened").each(function(index, el)
	{
		$(this).removeClass('mm-opened');
	});
	$(".mm-slideOut").each(function(index, el)
	{
		$(this).removeClass('mm-slideOut');
	});
}

function updateWSize()
{
	site_w = $(".site").css("width");
	lineHeight = site_w.split("px");
	lineHeight = lineHeight[0]*0.5+"px";

	$('.site').each(function(index, el) {
		$(this).css({
			"height": site_w
		});

		$(this).addClass("loadingfade");
	});
	$('.upload-img').each(function(index, el) {
		$(this).css({
			"height": site_w
		});
	});
	$('.site-content .local-link').each(function(index, el) {
		$(this).css({
			"line-height": lineHeight
		});

		$(this).addClass("loadingfade");
	});
}

function displayPopUpMaj( data )
{
	var html =	"<div class='maj-info'>" +
				"<a class='close' href='#closeMaj' >x</a>" +
				"<span> MyLocal " + 
				"<a title='View release on GitHub' href='" + data.html_url + "' >" + data.tag_name + "</a>" +
				" is now available! </span>" +
				"<span class='link-container'>" +
					"<a class='dl' title='Download zip' href='" + data.zipball_url  + "' ><i class='spLogo-zip'></i></a>" +
					"<a class='git' title='View on GitHub' href='" + data.html_url  + "' ><i class='spLogo-github'></i></a>" +
				"</span>" +
			"</div>";
	return html;
}

function hashchangeFunction( url )
{
	tag = window.location.href.split("#")[1];
	window.history.replaceState(null, null, url);

	switch(  tag )
	{
		case "conff":
			closeMM();
			displayConff();
		break;
		case "closeConff":
			$("#conffZone").slideToggle(500);
		break;
		case "closeMaj":
			$(".maj-info").slideToggle(500);
		break;
		default:
			console.log( "unknow " + tag + " hashange on script.js");
		break;
	}
}
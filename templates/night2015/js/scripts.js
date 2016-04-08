$(function(){
	var resizeTimer;
	var site_w;
	var lineHeight;
	var url = window.location.href; 
	var tag = window.location.href.split("#")[1];
	var mmenu = $('nav#menu').mmenu({
		navbar: {
				title: "localHost sweet localHost",
			},
		searchfield: true,
	});
	var refreshW = 2000; // reload .site width 2s after window's reload
	var config_dev = $("#ajaxConfig input[name=dev]").val();
	var config_allowUpdate = $("#ajaxConfig input[name=allowUpdate]").val();
	var config_allowGitScan = $("#ajaxConfig input[name=allowGitScan]").val();
	var config_release = $("#ajaxConfig input[name=release]").val();

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

	function cleanTag()
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
		});
		$('.site-content .local-link').each(function(index, el) {
			$(this).css({
				"line-height": lineHeight
			});
		});
	}

	function displayPopUpMaj( data )
	{
		var html =	"<div class='maj-info'>" +
					"<a class='close' href='#closeMaj' >x</a>" +
					"<span> MyLocal " + 
					"<a title='View release on GitHub' href='" + data.html_url  + "' >" + data.tag_name + "</a>" +
					" is now available! </span>" +
					"<span class='link-container'>" +
						"<a class='dl' title='Download zip' href='" + data.zipball_url + "' download ><i class='spLogo-zip'></i></a>" +
						"<a class='git' title='View on GitHub' href='https://github.com/Golgarud/myLocal' ><i class='spLogo-github'></i></a>" +
					"</span>" +
				"</div>";
		return html;
	}

	function hashchangeFunction()
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

	if (
			tag != ''
		&&	tag != null
		&&	tag != "null"
		&&	tag != undefined
		&&	tag != "undefined"
	)
	{

		hashchangeFunction();
	}
	// hashchange detection (#pseudoElem)
	$(window).on('hashchange', function(e)
	{
		hashchangeFunction();
	});

	// on reload done
	$(window).on('resize', function(e) {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout( updateWSize(), refreshW);
	});

	// on site load
	updateWSize();
	if ( config_allowUpdate )
	{
		$.ajax({
			url: "https://api.github.com/repos/Golgarud/myLocal/releases/latest"
		}).done(function( data ) 
		{
			// alert(data[0]["sha"]);
			$("html").append( data );
			// ignore fix release (0.0.x) in test for displaying popup
			// but take it in popup link (if pass popup test)
			if ( parseFloat(config_release) <  parseFloat(data.tag_name) )
			{
				$("#main").append( displayPopUpMaj(data) );
			}			
		});
	}
});
$(function(){
	var resizeTimer;
	var site_w;
	var lineHeight;
	var url = window.location.href; 
	var mmenu = $('nav#menu').mmenu();
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

	if ( url.split("#")[1] == "conff" )
	{
		$(window).trigger('hashchange');
		console.log(url.split("#"));
		displayConff();
	}
	// on hashchange or trigger hashchange
	$(window).on('hashchange', function(e){
		url = window.location.href; 
		if ( url.split("#")[1] == "conff" )
		{
			closeMM();
			displayConff();
		}
		else if( url.split("#")[1] == "closeConff" )
		{
			$("#conffZone").slideToggle(500);
		}
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
			if ( parseFloat(config_release) <  parseFloat(data.tag_name) )
			{
				console.log( data.tag_name );
				console.log( data.name );
				console.log( data.zipball_url );
				console.log( data.author.login );
				console.log( data.author.avatar_url );
				console.log( data.name );
				console.log( parseFloat(config_release) +"<"+  parseFloat(data.tag_name));
			}
			
		});
	}
});
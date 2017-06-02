		<div id="conffZone">	
		</div>
		{* <script src="{$url.js}/main.min.js" type="text/javascript" charset="utf-8" async="async"></script> *}
		<script type="text/javascript" charset="utf-8" async="async">
			{fetch file=$url.js|cat:"/main.min.js"}
			{if isset($userConfig.js) }
				{$userConfig.js}
			{/if}
		</script>
	</body>
</html>
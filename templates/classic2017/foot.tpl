		<div id="conffZone">	
		</div>
		<!-- ajax config -->
		<form id="ajaxConfig">
			<input type='hidden' name='dev' value='{$mod.dev}' />
			<input type='hidden' name='allowUpdate' value='{$mod.allowUpdate}' />
			<input type='hidden' name='allowGitScan' value='{$mod.allowGitScan}' />
			<input type='hidden' name='release' value='{$mod.release}' />
			<input type='hidden' name='path' value='{$mod.path}' />
		</form>
		<!-- ajax config end-->
		<script type="text/javascript" charset="utf-8" async="async">
			{fetch file=$url.jsMin|cat:"/main.min.js"}
			{if isset($userConfig.js) }
				{$userConfig.js}
			{/if}
		</script>
	</body>
</html>
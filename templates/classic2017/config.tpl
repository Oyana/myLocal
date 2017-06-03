<form class="formControl" enctype="" method="post">
	<fieldset>
		<legend class="configTitle"> Config Your Local </legend>
		{if isset($mod.yourSettingsTxt) }
		<p class="config-detail">
			<span class="title">Your actual configuration:</span>
			{$mod.yourSettingsTxt}
		</p>
		{/if}
		<textarea name="customJSON" placeholder="custom config (JSON)">
		{if isset($userConfig.json) }
			{$userConfig.json}
		{/if}
		</textarea>
		<textarea name="customCSS" placeholder="custom CSS">
		{if isset($userConfig.css) }
			{$userConfig.css}
		{/if}
		</textarea>
		
		<textarea name="customJS" placeholder="custom JS">
		{if isset($userConfig.js) }
			{$userConfig.js}
		{/if}
		</textarea>
		<a class="btn" href="{$url.root_url}/tools/clearMyLocalCache.php">clear myLocal cache</a>
		<button name="method" value="submitConfig">Submit</button>
	</fieldset>
</form>
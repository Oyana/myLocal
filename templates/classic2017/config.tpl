<!-- ajax config -->
<form id="ajaxConfig">
	<input type='hidden' name='dev' value='{$mod.dev}' />
	<input type='hidden' name='allowUpdate' value='{$mod.allowUpdate}' />
	<input type='hidden' name='allowGitScan' value='{$mod.allowGitScan}' />
	<input type='hidden' name='release' value='{$mod.release}' />
	<input type='hidden' name='path' value='{$mod.path}' />
</form>
<!-- ajax config end-->
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
		<button name="method" value="submitConfig">Submit</button>
	</fieldset>
</form>
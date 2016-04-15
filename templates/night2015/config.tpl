<form class="formControl" enctype="" method="post">
	<fieldset>
		<legend class="configTitle"> Config Your Local </legend>
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
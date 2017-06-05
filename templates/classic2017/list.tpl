<form action="" method="post">
	<ul class="site-l">
	{foreach from=$datas item=data key=key}
		{* circle *}
		{* square *}
		{* diamond *}
		{* hexagone *}
		{* octogone *}
		<li class='site circle {if $data.name == ".."}backlink{/if}'>
			<input class='comitKey' type='hidden' value='{$data.commitKey}' />
			<div class='site-content' >
				<div class='rotation-axe axe'>
					<div class='radius-axe axe'>
						<div class='bck-axe axe' style='background-image:url("{$data.img}")'>
							{if !empty($data.link) and !empty($data.linkType) }
								<a class='git-link' target='_blank' href='{$data.link}' title='{$data.name} {$data.linkType}'>
									<div class="ico-container">
										<i class="spLogo-{$data.linkType}"></i>
									</div>
								</a>
							{elseif  !empty($data.baseUrl) and !empty($data.identifier)}
								<a class='git-link' target='_blank' href='{$data.baseUrl}"/"{$data.identifier}' title='{$data.name} bitbucket'>
									<div class="ico-container">
										<i class="spLogo-bitbucket"></i>
									</div>
								</a>
							{/if}
							<a class='local-link' href='{$data.local_link}' title='{$data.name} local'>{$data.name}</a>
						</div>
					</div>
				</div>
			</div>
			{if $mod.alwaysShowName}
				<a class='local-link foot-link always-show' href='{$data.local_link}' title='{$data.name} local'>{$data.name}</a>
			{/if}
			{if $data.name != ".."}
				<input class="imgUpl" type="file" name="imgUpl[{$data.name}]">
			{/if}
		</li>
	{/foreach}
	</ul>
</form>
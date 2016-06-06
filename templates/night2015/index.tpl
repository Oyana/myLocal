<ul class="site-l">
{foreach from=$sites item=site key=key}
{* circle *}
{* square *}
{* diamond *}
{* hexagone *}
{* octogone *}
	<li class='site circle'>
		<input class='comitKey' type='hidden' value='{$site.commitKey}' />
		<div class='site-content' >
			<div class='rotation-axe axe'>
				<div class='radius-axe axe'>
					<div class='bck-axe axe' style='background-image:url("{$site.img}")'>
						{if !empty($site.link) and !empty($site.linkType) }
							<a class='git-link' target='_blank' href='{$site.link}' title='{$site.name} {$site.linkType}'>
								<div class="ico-container">
									<i class="spLogo-{$site.linkType}"></i>
								</div>
							</a>
						{elseif  !empty($site.baseUrl) and !empty($site.identifier)}
							<a class='git-link' target='_blank' href='{$site.baseUrl}"/"{$site.identifier}' title='{$site.name} bitbucket'>	
								<div class="ico-container">
									<i class="spLogo-bitbucket"></i>
								</div>
							</a>
						{/if}
						<a class='local-link' href='{$site.local_link}' title='{$site.name} local'>{$site.name}</a>
					</div>
				</div>
			</div>
		</div>
	</li>
{/foreach}
</ul>
<ul class="site-l">
{foreach from=$sites item=site key=key}
	<li class='site'>
		<input class='comitKey' type='hidden' value='{$site.commitKey}' />
		<div class='site-content' >
			<div class='rotation-axe axe'>
				<div class='radius-axe axe'>
					<div class='bck-axe axe' style='background-image:url("{$site.img}")'>
						{if !empty($site.link) and !empty($site.linkType) }
							<a class='git-link' target='_blank' href='{$site.link}' title='{$site.name} {$site.linkType}'><img src='{$url.img}/{$site.linkType}_logo.png' alt='logo {$site.linkType}'/></a>
						{elseif  !empty($site.baseUrl) and !empty($site.identifier)}
							<a class='git-link' target='_blank' href='{$site.baseUrl}"/"{$site.identifier}' title='{$site.name} bitbucket'><img src='{$url.img}/bitbucket_logo.png' alt='logo bitbucket'/></a>
						{/if}
						<a class='local-link' href='{$site.name}' title='{$site.name} local'>{$site.name}</a>
					</div>
				</div>
			</div>
		</div>
	</li>
{/foreach}
</ul>
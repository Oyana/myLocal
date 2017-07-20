<!DOCTYPE html>
	<html>
	<head>
		<title>localHost | homeSweetHome...</title>
		<!-- favicon -->
		<link rel="apple-touch-icon" sizes="57x57" href="{$url.img}/favicon/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="{$url.img}/favicon/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="{$url.img}/favicon/apple-touch-icon-72x72.png">
		<link rel="icon" type="image/png" href="{$url.img}/favicon/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="{$url.img}/favicon/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="{$url.img}/favicon/manifest.json">
		<link rel="mask-icon" href="{$url.img}/favicon/safari-pinned-tab.svg">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">
		<style type="text/css">
			{fetch file=$url.css|cat:"/myLocal.css"}
			{if isset($userConfig.css) }
				{$userConfig.css}
			{/if}
		</style>
	</head>
	<body>
		<div id="main">
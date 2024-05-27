<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<title>{$windowTitle|default:"window"}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{$conf->app_url}/assets/css/main.css" />
		<noscript><link rel="stylesheet" href="{$conf->app_url}/assets/css/noscript.css" /></noscript>
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header" class="mainPage" class="headerMainLog">

					{block name=header}{/block}

					{include file='nav.tpl'}

				</div>

			<!-- Main -->
				<div class="wrapper style1" id="jumpHere">
					
					{block name=main}{/block}

				</div>

			{block name=galery}{/block}

			{include file='footer.tpl'}

		</div>

		<!-- Scripts -->
			<script src="{$conf->app_url}/assets/js/jquery.min.js"></script>
			<script src="{$conf->app_url}/assets/js/jquery.dropotron.min.js"></script>
			<script src="{$conf->app_url}/assets/js/jquery.scrolly.min.js"></script>
			<script src="{$conf->app_url}/assets/js/jquery.scrollex.min.js"></script>
			<script src="{$conf->app_url}/assets/js/browser.min.js"></script>
			<script src="{$conf->app_url}/assets/js/breakpoints.min.js"></script>
			<script src="{$conf->app_url}/assets/js/util.js"></script>
			<script src="{$conf->app_url}/assets/js/main.js"></script>

	</body>
</html>
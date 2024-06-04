<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<title>{$windowTitle|default:"window"}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{$conf->app_url}/assets/css/main.css" />
		<noscript><link rel="stylesheet" href="{$conf->app_url}/assets/css/noscript.css" /></noscript>
		<script type="text/javascript" src="{$conf->app_url}/assets/js/functions.js"></script>
	</head>
	<body class="no-sidebar is-preload" >
		<div id="page-wrapper">
			<!-- Header -->
				<div id="header" class="headerUser">
					{include file='nav.tpl'} 
				</div>

                <div class="wrapper style1">
                    {block name=offer}{/block}
                </div>

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
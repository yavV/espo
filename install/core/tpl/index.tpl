<!doctype html>
<html>
	<head>
		<title>EspoCRM Installation</title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		{if $isBuilt eq true}
			<script type="text/javascript" src="../client/espo.min.js"></script>
		{else}
			<script type="text/javascript" src="../client/lib/jquery-2.1.4.min.js"></script>
		{/if}

		<script type="text/javascript" src="js/install.js"></script>
		<link href="../client/css/hazyblue.css" rel="stylesheet">
		<link href="css/install.css" rel="stylesheet">
		<link rel="shortcut icon" href="../client/img/favicon.ico" type="image/x-icon">
	</head>
	<body class='install-body'>
		<header id="header"></header>
		<div class="container content">
			<div class="col-md-offset-1 col-md-10">
				<div class="panel panel-default">
					{include file="header.tpl"}
					{include file="$tplName"}
				</div>
			</div>
		</div>
		<footer class="container">{include file="footer.tpl"}</footer>
	</body>

</html>

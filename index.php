<?php
	require_once("controller.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IOC Project</title>
    <script type="text/javascript" src="scripts/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="scripts/jquery-ui-1.7.2.custom.min.js"></script>
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="font-awesome.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
    <link rel="Stylesheet" type="text/css" href="style/jqueryui/ui-lightness/jquery-ui-1.7.2.custom.css" />
</head>
<body>
	<?php require_once("chunks/header.php"); ?>
	<div id="wrapper">
		<div id="page" class="container">
			<?php
				$page = isset($_GET["page"]) ? $_GET["page"] : "home";
				if (!file_exists("chunks/".$page.".php"))
					$page="404";
				require_once("chunks/".$page.".php");
			?>
		</div>
	</div>

</body>
</html>

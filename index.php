<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IOC Project</title>
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="font-awesome.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<?php 
		ini_set("display_errors",1);

		$arrCategories = array (
			array (
				"link" => "programming",
				"title" => "Programming",
				"icon" => "fa-html5",
			),
			array (
				"link" => "photography",
				"title" => "Photography",
				"icon" => "fa-camera",
			),
			array (
				"link" => "gardening",
				"title" => "Gardening",
				"icon" => "fa-pagelines",
			),
			array (
				"link" => "sports",
				"title" => "Sports",
				"icon" => "fa-trophy",
			),
			array (
				"link" => "mobile",
				"title" => "Mobile",
				"icon" => "fa-android",
			),
			array (
				"link" => "photoshop",
				"title" => "Photoshop",
				"icon" => "fa-picture-o",
			),
			array (
				"link" => "networking",
				"title" => "Networking",
				"icon" => "fa-sitemap",
			),
		);	
	?>
	<?php require_once("chunks/header.php"); ?>
	<div id="wrapper">
		<div id="page" class="container">
			<?php
				$page = isset($_GET["page"]) ? $_GET["page"] : "home";
				require_once("chunks/".$page.".php");
			?>
		</div>
	</div>
<!--
<div id="portfolio-wrapper">
	<div id="portfolio" class="container">
		<div class="title">
			<h2>Suspendisse lacus turpis</h2>
			<span class="byline">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</span> </div>
		<div id="column1">
			<p>Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
			<a href="#" class="button">Read More</a> </div>
		<div id="column2">
			<p>Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
			<a href="#" class="button">Read More</a> </div>
		<div id="column3">
			<p>Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
			<a href="#" class="button">Read More</a> </div>
		<div id="column4">
			<p>Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
			<a href="#" class="button">Read More</a> </div>
	</div>
</div>
-->
</body>
</html>

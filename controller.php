<?php
/* DATAZZzzzZZZ*/
ini_set("display_errors",1);

session_start();

$arrUsers = array(
		array(
		"email" => "alex.dan.tomescu@gmail.com",
		"username" => "userno2",
		"password" => md5("parola"),
	),
	array(
		"email" => "adr.coman@gmail.com",
		"username" => "userno1",
		"password" => md5(""),
	),
	array(
		"email" => "alex.dan.tomescu@gmail.com",
		"username" => "userno2",
		"password" => md5("parola"),
	),
);

$arrCategories = array (
	array(
		"link" => "programming",
		"title" => "Programming",
		"icon" => "fa-html5",
	),
	array(
		"link" => "photography",
		"title" => "Photography",
		"icon" => "fa-camera",
	),
	array(
		"link" => "gardening",
		"title" => "Gardening",
		"icon" => "fa-pagelines",
	),
	array(
		"link" => "sports",
		"title" => "Sports",
		"icon" => "fa-trophy",
	),
	array(
		"link" => "mobile",
		"title" => "Mobile",
		"icon" => "fa-android",
	),
	array(
		"link" => "photoshop",
		"title" => "Photoshop",
		"icon" => "fa-picture-o",
	),
	array(
		"link" => "networking",
		"title" => "Networking",
		"icon" => "fa-sitemap",
	),
);

/* LOGIN */
if (isset($_GET["page"]) && $_GET["page"] == "login" && isset($_POST["btnLogin"]))
{
	$strEmail = $_POST["email"];
	$strPasswordEncrypted = md5($_POST["password"]);
	$login = array_reduce(
		$arrUsers,
		function ($result, $item)
		{
			global $strEmail, $strPasswordEncrypted;
			if ($item["email"]==$strEmail && $item["password"]==$strPasswordEncrypted)
			{
				$result = $item;
			}
			return $result;
		},
		null
	);

	if ($login)
	{
		$_SESSION["account"] = $login;
		redirect("/");
	}
}

/* LOGOUT */
if (isset($_GET["page"]) && $_GET["page"]=="logout")
{
	$_SESSION["account"]=null;
	session_destroy();
	redirect("/");
}

/* PROFILE */
if (isset($_GET["page"]) && $_GET["page"]=="profile" && empty($_SESSION["account"]))
{
	redirect("/?page=login");
}


function redirect($url)
{
	header("Location: ".$url);
	exit();
}

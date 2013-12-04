<?php
/* DATAZZzzzZZZ*/
ini_set("display_errors", 1);
error_reporting(E_ALL);

session_start();

class ErrorMessages
{
	public static $errors = array();

	public static function show($strIndex)
	{
		if(array_key_exists($strIndex, self::$errors))
			echo self::$errors[$strIndex];
	}
}

try 
{
    $dbh = new PDO('mysql:host=localhost;dbname=iocproject', "root", "");
}
catch (PDOException $e) 
{
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$arrCategories = $dbh->query("
		SELECT * FROM `categories`
	")->fetchAll(PDO::FETCH_ASSOC);
	

/* LOGIN */
if (isset($_GET["page"]) && $_GET["page"] == "login")
{	
 	if(isset($_POST["btnLogin"]))
	{
		$result = $dbh->query("
			SELECT * FROM `users`
			WHERE 
				`user_email` = ".$dbh->quote($_POST["email"])."
				AND
				`user_password` = ".$dbh->quote(md5($_POST["password"]))
			)->fetch(PDO::FETCH_ASSOC);
		if ($result)
		{
			$_SESSION["account"] = $result;
			redirect("/");
		}
	}
	if(isset($_POST["btnSignup"]))
	{
		if ($_POST["user_password"]!==$_POST["user_password_confirm"])
		{	
			ErrorMessages::$errors["btnSignup"] = "Password do not match!";
		} else
		{
			$dbh->exec("
				INSERT INTO `users` 
				SET
					`user_email` = ".$dbh->quote($_POST["user_email"]).",
					`user_password` = ".$dbh->quote(md5($_POST["user_password"])).",
					`user_favorites` = ".$dbh->quote(json_encode(array()))."
			");
			$nUserID = $dbh->lastInsertId();
			$result = $dbh->query("
				SELECT * FROM `users`
				WHERE 
					`user_id` = ".(int)$nUserID."
				")->fetch(PDO::FETCH_ASSOC);
			if ($result)
			{
				$_SESSION["account"] = $result;
				redirect("/");
			}
		}
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
$arrRestrictedPages = array ("profile");
if (isset($_GET["page"]) && in_array($_GET["page"], $arrRestrictedPages) && empty($_SESSION["account"]))
{
	redirect("/?page=login");
}

if (isset($_GET["page"]) && $_GET["page"]=="profile" && isset($_POST["btnSaveProfile"]))
{
	unset($_POST["btnSaveProfile"]);
	$dbh->exec("
		UPDATE 
			`users` 
		SET
			`user_name` = ".$dbh->quote($_POST["user_name"]).",
			`user_email` = ".$dbh->quote($_POST["user_email"]).",
			`user_favorites` = ".$dbh->quote(json_encode($_POST["user_favorites"]))."
		WHERE
			`user_id` = ".(int)$_SESSION["account"]["user_id"]."
		");
	$result = $dbh->query("
		SELECT * FROM `users` WHERE
			`user_id` = ".(int)$_SESSION["account"]["user_id"]."")->fetch(PDO::FETCH_ASSOC);
	$_SESSION["account"] = $result;

}

function redirect($url)
{	
	$strBasePath = dirname($_SERVER["SCRIPT_NAME"]);
	if ($strBasePath == "/")
		$strBasePath = "";
	header("Location: ".$strBasePath.$url);
	exit();
}

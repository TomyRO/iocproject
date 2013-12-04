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
			echo "<p class='error_message'>",self::$errors[$strIndex],"</p>";
	}
}

try 
{
    $dbh = new PDO('mysql:host=localhost;dbname=iocproject', "root", "");
}
catch (PDOException $e) 
{
    print "Databse error!: " . $e->getMessage() . "<br/>";
    die();
}

$arrCategories = $dbh->query("
		SELECT * FROM `categories`
	")->fetchAll(PDO::FETCH_ASSOC);
	

if (isset($_GET["page"]))
{
	/* LOGIN & SIGNUP*/
	if($_GET["page"] == "login")
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
				if ($nUserID > 0)
				{
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
				else
					ErrorMessages::$errors["btnSignup"] = "Signup failed!";
			}
		}
	}

	/* LOGOUT */
	if ($_GET["page"] == "logout")
	{
		$_SESSION["account"]=null;
		session_destroy();
		redirect("/");
	}

	/* RESTRICTED PAGES*/
	$arrRestrictedPages = array ("profile", "create-tutorial");
	if (in_array($_GET["page"], $arrRestrictedPages) && empty($_SESSION["account"]))
		redirect("/?page=login");

	/* PROFILE */
	if ($_GET["page"]=="profile" && isset($_POST["btnSaveProfile"]))
	{
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

	/*TUTORIAL*/
	if ($_GET["page"] == "tutorial")
	{
		if (!empty($_GET["id"]))
		{
			$objTutorial = $dbh->query("
				SELECT * FROM `tutorials` t
				INNER JOIN
					`tutorial_revisions` tr ON tr.`tutorial_id` = t.`tutorial_id` 
				INNER JOIN
					`users` u ON u.`user_id` = tr.`user_id`
				WHERE
					t.`tutorial_id` = ".(int)$_GET["id"]."
			")->fetch(PDO::FETCH_ASSOC);
		}
		else
			$_GET["page"] = "404";
	}
	if ($_GET["page"] == "create-tutorial" && isset($_POST["btnSaveTutorial"]))
	{
		$dbh->query("
			INSERT INTO `tutorials` 
			SET
				`tutorial_title` = ".$dbh->quote($_POST["tutorial_title"])."
		");
		$nTutorialID = $dbh->lastInsertId();

		$dbh->query("
			INSERT INTO `tutorial_revisions` 
			SET
				`tutorial_revision_content` = ".$dbh->quote($_POST["tutorial_revision_content"]).",
				`tutorial_id` = ".(int)$nTutorialID.",
				`user_id` = ".(int)$_SESSION["account"]["user_id"]."
		");
		$nTutorialRevisionID = $dbh->lastInsertId();
		$dbh->query("
			UPDATE `tutorials` 
			SET
				`tutorial_revision_id` = ".(int)$nTutorialRevisionID."
		");

		redirect("/?page=tutorial&id=".$nTutorialID);
	}
	if ($_GET["page"] == "category")
	{
		$arrTutorials = $dbh->query("
			SELECT * FROM `tutorials` t
				INNER JOIN
					`tutorial_revisions` tr ON tr.`tutorial_id` = t.`tutorial_id` 
				INNER JOIN
					`users` u ON u.`user_id` = tr.`user_id`
		");
	}
}
function redirect($url)
{	
	$strBasePath = dirname($_SERVER["SCRIPT_NAME"]);
	if ($strBasePath == "/")
		$strBasePath = "";
	header("Location: ".$strBasePath.$url);
	exit();
}

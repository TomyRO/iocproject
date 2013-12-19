<?php
/* DATAZZzzzZZZ*/
ini_set("display_errors", 1);
error_reporting(-1);

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
	if ($_GET["page"]=="profile")
	{
		$arrMyTutorials = $dbh->query("
				SELECT * FROM `tutorials` t
				INNER JOIN
					`tutorial_revisions` tr ON tr.`tutorial_revision_id` = t.`tutorial_revision_id` 
				WHERE
					tr.`user_id` = ".(int)$_SESSION["account"]["user_id"]."
			")->fetchAll(PDO::FETCH_ASSOC);
	}
	
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
					`tutorial_revisions` tr ON tr.`tutorial_revision_id` = t.`tutorial_revision_id` 
				INNER JOIN
					`users` u ON u.`user_id` = tr.`user_id`
				WHERE
					t.`tutorial_id` = ".(int)$_GET["id"]."
			")->fetch(PDO::FETCH_ASSOC);

			if (!$objTutorial)
				redirect("/?page=404");
			else 
			{
				if (isset($_POST["btnComment"]))
				{
					$dbh->exec("INSERT INTO `comments` (`comment_text`, `user_id`, `tutorial_id`)
						VALUES (
							".$dbh->quote($_POST["comment"]).",
							".$_SESSION["account"]["user_id"].",
							".(int)$_GET["id"]."
						)"
					);
					redirect("/?page=tutorial&id=".(int)$_GET["id"]);
				}
				$dbh->exec("UPDATE `tutorials` SET `tutorial_views`=`tutorial_views`+1 WHERE `tutorial_id` = ".(int)$_GET["id"]." ");
			}
		}
		else
			redirect("/?page=404");
	}
	if ($_GET["page"] == "create-tutorial")
	{
		if (isset($_GET["id"])) 
		{

		    $objTutorial = $dbh->query("
		        SELECT * FROM `tutorials` t
		        WHERE
		            t.`tutorial_id` = ".(int)$_GET["id"]."
		    ")->fetch(PDO::FETCH_ASSOC);
		    $nTutorialRevisionID = (isset($_GET["revision"]))?$_GET["revision"]:$objTutorial["tutorial_revision_id"];

		    $objRevision = $dbh->query("
		        SELECT * FROM `tutorial_revisions` t
		        WHERE
		            t.`tutorial_revision_id` = ".(int)$nTutorialRevisionID."
		    ")->fetch(PDO::FETCH_ASSOC);
		    if (!$objRevision)
		        redirect("/?page=404");
		    else 
		        $objTutorial=array_merge($objTutorial, $objRevision);

		}
		if (isset($_POST["btnSaveTutorial"]))
		{
			if (isset($_GET["id"]))
			{
				$nTutorialID = (int)$_GET["id"];
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
						`tutorial_title` = ".$dbh->quote($_POST["tutorial_title"]).",
						`category_id` = ".$dbh->quote($_POST["category_id"]).",
						`tutorial_revision_id` = ".(int)$nTutorialRevisionID."
					WHERE
						`tutorial_id` = ".$nTutorialID."
				");
			} 
			else
			{
				$dbh->query("
					INSERT INTO `tutorials` 
					SET
						`tutorial_title` = ".$dbh->quote($_POST["tutorial_title"])."
						`category_id` = ".$dbh->quote($_POST["category_id"])."
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
					WHERE
						`tutorial_id` = ".$nTutorialID."
				");
			}
			redirect("/?page=tutorial&id=".$nTutorialID);
		}

	}

	if ($_GET["page"] == "category")
	{
		$arrTutorials = $dbh->query("
			SELECT * FROM `tutorials` t
			INNER JOIN
				`tutorial_revisions` tr ON tr.`tutorial_revision_id` = t.`tutorial_revision_id` 
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

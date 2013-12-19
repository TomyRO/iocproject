<div id="article">
    <div id="article-title"> <h1><?php echo $objTutorial["tutorial_title"]; ?></h1> </div>
    <div id="article-author"> <h3><?php echo $objTutorial["user_name"]; ?></h3></div>

    <div id="article-content">
        <?php echo $objTutorial["tutorial_revision_content"] ?>
    </div>
</div>

<?php require_once("chunks/sidebar.php"); ?>
<?php require_once("comments.php"); ?>

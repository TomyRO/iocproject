<div id="comment-section">
    <?php
        if (!empty($_SESSION["account"])) 
            { ?>
    <form action="" method="post">
        <textarea name="comment" rows="4" cols="50"> </textarea><br>
        <input type="submit" value="Send" name="btnComment">
    </form>
        <?php } ?>

    <ul id="comment-list">
    <?php
        $arrComments = $dbh->query("
            SELECT * FROM `comments` c 
            JOIN `users` u ON u.`user_id`=c.`user_id` 
            WHERE 
                c.`tutorial_id`=".(int)$_GET["id"]."
            ORDER by c.`comment_id` DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arrComments as $objComment)
        {
    ?>
        <li>
            <ul>
                <li id="author"><?php echo $objComment["user_name"];?></li>
                <li><?php echo $objComment["comment_text"];?></li>
            </ul>
        </li>
    <?php } ?>
    </ul>
</div>

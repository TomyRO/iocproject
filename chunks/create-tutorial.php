<script>
$(function () {
    CKEDITOR.replaceAll();
});
</script>

<div id="tutorial-create">
    <form action="" method="post">

    <div id="title">
        <h3>Title</h3>
        <input type="text" name="tutorial_title" value="<?php echo @$objTutorial["tutorial_title"]?>">
    </div>
        <h3>Category</h3>
        <select name="category_id">
            <?php foreach ($arrCategories as $objCategory) { 
                $selected=($objCategory["category_id"]==$objTutorial["category_id"])?"selected":"";
                ?>
            <option value="<?php echo $objCategory["category_id"]?>" <?php echo $selected;?> >
                <?php echo $objCategory["category_title"]?>
            </option>
            <?php } ?>
        </select>
        <h3>Content</h3>
    <textarea id="txtDefaultHtmlArea" name="tutorial_revision_content" cols="100" rows="30"><?php echo @$objTutorial["tutorial_revision_content"]?></textarea>

    <input type="submit" name="btnSaveTutorial" value="Submit">
    </form>
</div>
<?php
if (isset($_GET["id"])) 
{?>
    <div id="sidebar">
        <span id="top-rated">History</span>
        <?php
            $top_rate = $dbh->query("
                SELECT * FROM `tutorial_revisions` tr 
                WHERE `tutorial_id`=".(int)$_GET["id"]."
                ORDER by tr.`tutorial_revision_id` DESC
            ")->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <ul id="top-rated-list">
            <?php
                foreach ($top_rate as $tut)
                { ?>
            <li class="top-tutorial">
                <a href="/?page=create-tutorial&id=<?php echo $tut["tutorial_id"]; ?>&revision=<?php echo $tut["tutorial_revision_id"]; ?>">
                    <?php echo $tut["tutorial_revision_modified"]; ?>
                </a>
            </li>
            <?php } ?>
            
        </ul>
    </div>
<?php } ?>

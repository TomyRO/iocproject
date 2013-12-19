<ul id="gallery">
    <?php 
    foreach ($arrTutorials as $objTutorial)
    {
    ?>
    <li class="tutorial-item">
        <a href="#"><div class="tutorial-image"></div></a>
        <div class="tutorial-descript">
            <a href="/?page=tutorial&id=<?php echo $objTutorial["tutorial_id"];?>"><h2> <?php echo $objTutorial["tutorial_title"]?> </h2></a>
            <span class="tutorial-author">Author: <?php echo $objTutorial["user_name"]?></span>
            <p><?php echo $objTutorial["tutorial_revision_content"]?></p>
        </div>
    </li>
    <?php
    }
    ?>
</ul>
<?php require_once("chunks/sidebar.php") ?>

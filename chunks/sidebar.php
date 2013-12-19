<div id="sidebar">
    <span id="top-rated">Top Rated</span>
    <?php
    	$top_rate = $dbh->query("
    		SELECT * FROM `tutorials` t
			INNER JOIN
				`tutorial_revisions` tr ON tr.`tutorial_revision_id` = t.`tutorial_revision_id` 
			ORDER by t.`tutorial_views` DESC
			LIMIT 10
		")->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <ul id="top-rated-list">
    	<?php
    		foreach ($top_rate as $tut)
    		{ ?>
        <li class="top-tutorial">
        	<a href="/?page=tutorial&id=<?php echo $tut["tutorial_id"]; ?>">
        		<?php echo $tut["tutorial_title"]; ?>
        	</a>
        </li>
    	<?php } ?>
        
    </ul>
</div>

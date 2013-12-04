<div id="featured-wrapper">
	<div id="featured" class="container">
		<?php
		for ($i = 0; $i < count($arrCategories); $i++)
		{
			?>
			<div class="column<?php echo $i%4+1;?>">
				<a href="?page=category&cat=<?php echo $arrCategories[$i]["category_link"];?>">
					<span class="fa <?php echo $arrCategories[$i]["category_icon"];?>"></span>
					<h2><?php echo $arrCategories[$i]["category_title"]?></h2>
				</a>
			</div>
			<?php
		}
		?>
	</div>
</div>

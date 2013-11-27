<div id="featured-wrapper">
	<div id="featured" class="container">
		<?php
		for ($i = 0; $i < 4; $i++)
		{
			?>
			<div class="column<?php echo $i+1;?>">
				<a href="?page=category&cat=<?php echo $arrCategories[$i]["link"];?>">
					<span class="fa <?php echo $arrCategories[$i]["icon"];?>"></span>
					<h2><?php echo $arrCategories[$i]["title"]?></h2>
				</a>
			</div>
			<?php
		}
		?>
	</div>
</div>

<form method="post" action="">
	<table>
		<tr>
			<td>
				Email: 
			</td>
			<td>
				<input name="user_email" value="<?php echo @$_SESSION["account"]["user_email"];?>"/>
			</td>
		</tr>
		<tr>
			<td>
				Name: 
			</td>
			<td>
				<input name="user_name"  value="<?php echo @$_SESSION["account"]["user_name"];?>"/>
			</td>
		</tr>
		<tr>
			<td>
				Location: 
			</td>
			<td>
				<input name="user_location"  value="<?php echo @$_SESSION["account"]["user_location"];?>"/>
			</td>
		</tr>
		<tr>
			<td>
				Interested in
			</td>
			<td class="checkboxes">
			<?php 
			$i = 0;
			$arrUserFavorites = json_decode($_SESSION["account"]["user_favorites"]);
			foreach ($arrCategories as $objCategory)
			{
				?>
				<input type="checkbox" value="<?php echo $objCategory["category_id"];?>" name="user_favorites[]" <?php echo (in_array($objCategory["category_id"], $arrUserFavorites)?"checked":"");?>/>
				<label><?php echo $objCategory["category_title"];?></label>
				<?php
				if (++$i%4==0)
					echo "<br />";
			}
			?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: right;"><input type="submit" name="btnSaveProfile" value="Salveaza" /></td>
		</tr>

	</table>
</form>
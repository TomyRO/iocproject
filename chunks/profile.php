<form method="post" action="">
	<table>
		<tr>
			<td>
				Email: 
			</td>
			<td>
				<input name="email" value="<?php echo @$_SESSION["account"]["email"];?>"/>
			</td>
		</tr>
		<tr>
			<td>
				Name: 
			</td>
			<td>
				<input name="name"  value="<?php echo @$_SESSION["account"]["name"];?>"/>
			</td>
		</tr>
		<tr>
			<td>
				Location: 
			</td>
			<td>
				<input name="location"  value="<?php echo @$_SESSION["account"]["location"];?>"/>
			</td>
		</tr>
		<tr>
			<td>
				Interested in
			</td>
			<td class="checkboxes">
			<?php 
			$i = 0;
			foreach ($arrCategories as $objCategory)
			{
				?>
				<input type="checkbox" value="<?php echo $objCategory["link"];?>" name="interests[]" <?php echo (in_array($objCategory["link"], $_SESSION["account"]["interests"])?"checked":"");?>/>
				<label><?php echo $objCategory["title"];?></label>
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
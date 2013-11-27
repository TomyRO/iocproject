<table>
	<tr>
		<td>
			Email: 
		</td>
		<td>
			<input name="email" />
		</td>
	</tr>
	<tr>
		<td>
			Name: 
		</td>
		<td>
			<input name="name" />
		</td>
	</tr>
	<tr>
		<td>
			Location: 
		</td>
		<td>
			<input name="location" />
		</td>
	</tr>
	<tr>
		<td>
			Interested in
		</td>
		<td>
		<?php 
		$i = 0;
		foreach ($arrCategories as $objCategory)
		{
			?>
			<input type="checkbox" name="interests[]" />
			<?php
			if (++$i%4==0)
				echo "<br />";
		}
		</td>
	</tr>

</table>
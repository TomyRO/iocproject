<div id="header-wrapper">
	<div id="header-wrapper2">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="/">Logo</a></h1>
			</div>
            <div id="searchform">
                <form action="#" method="get">
                    <input name="q" value="Search keywords" />
                    <input type="submit" class="icon icon-search" value="Search" />
                </form>
            </div>
			<div id="menu">
				<ul>
					<li><a href="?page=categories" accesskey="1" title="">Categories</a></li>
					<li><a href="?page=articles" accesskey="2" title="">Articles</a></li>
					<li><a href="?page=wishlist" accesskey="3" title="">Wishlist</a></li>
					<li><a href="?page=tips" accesskey="4" title="">Tips</a></li>
					<?php 
					if (isset($_SESSION["account"]))
					{
						?>	
						<li><a href="?page=profile" accesskey="5" title="">Profile</a></li>
						<?php 
					}
					else		
					{
						?>
						<li><a href="?page=login" accesskey="5" title="">Login/Signup</a></li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>

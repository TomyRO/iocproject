<div id="two-column">
	<div id="tbox1">
		<div class="title">
			<h2>Existing User</h2>
		</div>
        <div id="login-credentials">
            <form action="" method="post">
                Email Address:<br>
                <input type="text" name="email"><br>
                Password:<br>
                <input type="password" name="password"><br>
                <input type="submit" name="btnLogin" value="LogIn">
            </form>
        </div>
	</div>
	<div id="tbox2">
		<div class="title">
			<h2>New User?</h2>
		</div>
        <?php ErrorMessages::show("btnSignup"); ?>
		<p>Create an account to access all of the features of out website!</p>
        <div id="signup-credentials">
            <form action="" method="post">
                Email:<br>
                <input type="text" name="user_email"><br>
                Password:<br>
                <input type="password" name="user_password"><br>
                Repeat Password:<br>
                <input type="password" name="user_password_confirm"><br>
                <input type="submit" name="btnSignup" value="Sign Up!">
            </form>
        </div>
</div>

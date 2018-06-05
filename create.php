
<?php require "header.php" ?>

<h2>Add A User</h2>
<form method = "post" action="createAction.php">
	FIRST NAME<br>
	<input type="text" name="firstname" id = "firstname"/><br>
	LAST NAME<br>
	<input type="text" name="lastname" id = "lastname"/><br>
	EMAIL ADDRESS<br>
	<input type="email" name="email" id = "email"/><br>
	AGE<br>
	<input type ="number" name="age" id = "age"/><br>
	LOCATION<br>
	<input type="text" name="location" id = "location"/><br>
	PASSWORD<br>
	<input type="password" name="password" id = "password"/><br><br>
	<input type="submit" name="submit">
</form><br>

<a href="index.php" style="background-color: yellow;color: red;padding: 14px 25px;text-align: right; text-decoration: none;display: inline-block;">BACK TO HOME</a>
<?php require "footer.php" ?>

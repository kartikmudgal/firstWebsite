<?php

	if (isset($_POST["submit"]) && !empty($_POST["submit"])) {
		require "config.php";
		require "common.php";
		try {
			$connection = new PDO($dsn,$username,$password,$options);
			$new_user = array(
				"firstname" => $_POST['firstname'],
				"lastname"  => $_POST['lastname'],
				"email"     => $_POST['email'],
				"age"       => $_POST['age'],
				"location"  => $_POST['location'],
				"password"  => $_POST['password']
			);
			$sql = sprintf(
							"INSERT INTO %s (%s) values (%s)",
							"users",
							implode(", ", array_keys($new_user)),
							":" . implode(", :", array_keys($new_user))
					);
			$statement = $connection->prepare($sql);
			$statement->execute($new_user);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

?>

<?php require "header.php"; ?>
<?php
	if(isset($_POST['submit']) && $statement){?>
		<blockquote><?php echo escape($_POST['firstname']); ?> successfully added</blockquote>
	<?php } ?>

<h2>Add A User</h2>
<form method = "post">
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
	<input type="submit" name="SUBMIT">
</form><br>

<a href="index.php" style="background-color: yellow;color: red;padding: 14px 25px;text-align: right; text-decoration: none;display: inline-block;">BACK TO HOME</a>
<?php require "footer.php"; ?>

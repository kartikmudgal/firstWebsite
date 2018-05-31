
<?php
	if (isset($_POST["submit"])) {
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
			echo "USER ADDED";
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

?>
<?php require "header.php" ?>
<a href="create.php" style="background-color: yellow;color: red;padding: 14px 25px;text-align: right; text-decoration: none;display: inline-block;">ADD ANOTHER USER</a>
<?php require "footer.php" ?>


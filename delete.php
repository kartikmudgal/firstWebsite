
<?php
	require "config.php";
	require "common.php";
	//print_r($_GET);
	//die;
	if(isset($_GET["id"])){
	try {
	    $connection = new PDO($dsn, $username, $password, $options);

	    $id = $_GET["id"];

	    $sql = "DELETE FROM users WHERE id = :id";

	    $statement = $connection->prepare($sql);
	    $statement->bindValue(':id', $id);
	    $statement->execute();

	    $success = "User successfully deleted";
	  } catch(PDOException $error) {
	    echo $sql . "<br>" . $error->getMessage();
	  }
	}
	try{
		$connection = new PDO($dsn,$username,$password,$options);
		$sql = "SELECT id,firstname,lastname,email,age,location FROM users";
		$statement = $connection->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
	} catch(PDOException $e){
		echo $e->getMessage();
	}
?>


<?php require "header.php"; ?>
<h2>DELETE A USER</h2>
<?php
	if($success){
		echo $success;
	} ?>
<table>
	<thead>
	<tr>
		<th>ID</th>
		<th>FIRST NAME</th>
		<th>LAST NAME</th>
		<th>EMAIL</th>
		<th>AGE</th>
		<th>LOCATION</th>
		<th>DELETE</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach ($result as $row) { ?>
			<tr>
				<td> <?php echo escape($row["id"]); ?></td>
				<td> <?php echo escape($row["firstname"]); ?></td>
				<td> <?php echo escape($row["lastname"]); ?></td>
				<td> <?php echo escape($row["email"]); ?></td>
				<td> <?php echo escape($row["age"]); ?></td>
				<td> <?php echo escape($row["location"]); ?></td>
				<td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<a href="index.php" style="background-color: yellow;color: red;padding: 14px 25px;text-align: right; text-decoration: none;display: inline-block;">BACK TO HOME</a>
<?php require "footer.php"; ?>

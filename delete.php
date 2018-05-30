<?php
	require "config.php";
	require "common.php";
	if(isset($_get["id"])){
		try {
			$connection = new PDO($dsn,$username,$password,$options);
			$sql = "DELETE FROM users WHERE id = :id";
			$id = $_get["id"];
			$statement = $connection->prepare($sql);
			$statement->bindValue(':id',$id);
			$statement->execute();
			$success = "User Successfully Deleted";
		} catch (PDOException $e) {
			echo $e->getMessage();
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

<?php require "footer.php"; ?>

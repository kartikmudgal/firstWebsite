<?php

	if(isset($_POST['submit']) && !empty($_POST['submit'])){
		require "config.php";
		require "common.php";
		try {
			$connection = new PDO($dsn,$username,$password,$options);
			$sql = "SELECT id,firstname,lastname,email,age,location FROM users WHERE location = :location";
			$location = $_POST['location'];
			$statement = $connection->prepare($sql);
			$statement->bindParam(':location', $location, PDO::PARAM_STR);
					$statement->execute();

					$result = $statement->fetchAll();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

?>
<?php
	if(isset($_POST['submit']) && !empty($_POST['submit'])){
		if($result && $statement->rowCount() > 0){ ?>
		<h2>RESULTS</h2>
		<table>
			<thead>
			<tr>
				<th>ID</th>
				<th>FIRST NAME</th>
				<th>LAST NAME</th>
				<th>EMAIL</th>
				<th>AGE</th>
				<th>LOCATION</th>
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
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php } else{ ?>
			<blockquote>NO RESULTS FOUND for <?php echo escape[$_POST['location']] ?></blockquote>
		<?php }
	} ?>

<?php require "header.php"; ?>
<h2>Search By Location</h2>
<form method = "post">
	LOCATION<br>
	<input type="text" name="location"><br><br>
	<input type="submit" name="SEARCH">
</form><br>
<a href="index.php" style="background-color: yellow;color: red;padding: 14px 25px;text-align: right; text-decoration: none;display: inline-block;">BACK TO HOME</a>
<?php require "footer.php"; ?>

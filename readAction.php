<?php
//print_r($_POST);
//die;
	if(isset($_POST['SEARCH'])) {
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
					$row_count = $statement->rowCount();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

?>
<?php require "header.php" ?>
<?php
	if(isset($_POST['SEARCH'])) {
		if($result && $row_count > 0){ ?>
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

<a href="read.php" style="background-color: yellow;color: red;padding: 14px 25px;text-align: right; text-decoration: none;display: inline-block;">SEARCH AGAIN</a>

<?php require "footer.php" ?>

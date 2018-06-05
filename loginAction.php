<?php
	require "config.php";
	session_start();
	//print_r($_POST);
	//		die;
	if(isset($_POST['LOGIN'])){
		try {
			$connection = new PDO($dsn,$username,$password,$options);
			$sql = "SELECT id FROM users WHERE email = :email AND password = :password";
			$email = $_POST['email'];
			$password = $_POST['password'];
			$statement = $connection->prepare($sql);
			$statement->bindParam(':email',$email);
			$statement->bindParam(':password',$password);
			$statement->execute();
			$result = $statement->fetchALl();
			$count = $statement->rowCount();
			if($count == 1){
				$_SESSION['email'] = $email;
				$_SESSION['login_user'] = $email;
				header("location: index.php");
			}else{
				echo "EMAIL OR PASSWORD INCORRECT";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	?>


<?php
	require "config.php";
	session_start();
	if(isset($_POST['submit'])){
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
				session_register("email");
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


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN PAGE</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<style type = "text/css">
	         body {
	            font-family:Arial, Helvetica, sans-serif;
	            font-size:14px;
	         }
	         label {
	            font-weight:bold;
	            width:100px;
	            font-size:14px;
	         }
	         .box {
	            border:#666666 solid 1px;
	         }
	         h1 {letter-spacing: 6px;
	         		text-align: center;
	         		text-shadow: 3px 2px green;
	         		}
	      </style>
</head>
<body bgcolor = "#FFFFFF">
	<h1>__CRUDify__</h1><br>
	<h1 class="w3-xlarge">Kartik Mudgal</h1>
	<div align = "center">
	         <div style = "width:300px; border: solid 1px #333333; " align = "left">
	            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

	            <div style = "margin:30px">

	               <form method = "post">
	                  <label>EMAIL  :</label><br><input type = "email" name = "email" class = "box"/><br /><br />
	                  <label>PASSWORD  :</label><input type = "password" name = "password" class = "box" /><br/><br />
	                  <input type = "submit" value = " LOGIN "/><br />
	               </form>

	               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

	            </div>

	         </div>

	      </div>

</body>
</html>

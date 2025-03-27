<?php
$error = [];
$success = "";
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
	$conn = new mysqli("localhost","root","","testdb");
	if($conn->connect_error){
		die("Connection Failed: ".$conn->connect_error);
	}

	$email= trim($_POST["email"]);
	$password= $_POST["password"];

	if(empty($email)){
		$error[] = "Email is required.";
	}
	elseif(	!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$error[]="Invalid Email Format";
	}

	if(empty($password)){
		$error[]="Password is required.";
	}
	
	if(empty($error)){
		$stmt=$conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
		$stmt->bind_param("ss",$email,$password);
		$stmt->execute();
		$result=$stmt->get_result();
		if($result->num_rows > 0){
			$users=$result->fetch_assoc();
			$_SESSION['userid']=$users['email'];
			$_SESSION['username']=$users['name'];

			header("Location:dashboard.php");
			exit();
		}
		else{
			$error[]="No user found";
		}
		$stmt->close();
	}
	$conn->close();
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		.body{
			margin:50px;
		}
		.container{
			max-width:400px;
			margin:auto;
			padding:20px;
			border:1px solid black;
			border-radius:10px;
		}
		.heading{
			color:black;
			text-align: center;
			margin-bottom: 40px;
		}
		label{
			margin: 5px;
			
		}
		.input{
			width:100%;
			padding:10px;
			margin:10px 0;
		}
		.inputBox{
			font-weight: bold;
			margin: 5px;
			padding-right: 10px;
		}
		button{
			background:lightskyblue;
			color: white;
			padding: 10px;
			border:none;
			cursor: pointer;
			display: flex;
			justify-content: center; /* Centers horizontally */
			gap: 10px; /* Adds spacing between buttons */
		}
		.Err{
			font-size: small;
			color:red;
			
		}
		.error{
			font-size: small;
			color:red;
		}
		.success{
			color:green;
		}
	</style>
</head>
<body>
<div class="container">
		<h3 class="heading">Registration form</h3>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
			<div class="inputBox">
			<label>Email:</label><input type="email" name="email" required>
			<br>
			<!-- <span class="Err"><?php echo $emailErr; ?></span> -->
			</div>
			<br>
			<div class="inputBox">
			<label>Password:</label><input type="password" name="password" required>
			<br>
			<!-- <span class="Err"><?php echo $passwordErr; ?></span> -->
			</div>
			<br>
			<button class="submit" type="submit">Submit</button>
		</form>
	</div>
</body>
</html>
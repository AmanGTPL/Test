<?php
session_start();
$error = [];
$success = [];
$nameErr="";
$emailErr="";
$phoneErr="";
$passwordErr="";
$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname="testdb";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$conn=new mysqli($dbserver,$dbuser,$dbpass,$dbname);
	if($conn->connect_error){
		die("connection failed: ".$conn->connect_error);
	}

	$name = trim($_POST["name"]);
	$email = trim($_POST["email"]);
	$phone = trim($_POST["phone"]);
	$password = $_POST["password"];

	if(empty($name)){
		$nameErr="*Name is Required";
	}
	elseif(!preg_match("/^[a-zA-Z ]*$/",$name)){
		$nameErr="*Only Text and white space allowed!";
	}

	if(empty($email)){
		$emailErr="*Please enter valid Email";
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$emailErr="*Please enter valid Email Address";
	}
	else{
		$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
		if($stmt){
			$stmt->bind_param("s",$email);
			$stmt->execute();
			$result = $stmt -> get_result();
			if($result->num_rows>0){
				$error[]="*Email Alreaddy Exist";
			}
			$stmt->close();
		}else{
			die("SQL Error: ".$conn->error);
		}
		
	}
	

	if(empty($password)){
		$passwordErr="*Password cannot be Empty";
	}
	elseif(strlen($password)<6 || !preg_match("/[A-Za-z]/", $password) || !preg_match("/[0-9]/",$password)){
		$passwordErr="*Password must be atleast 6 digits long and contain letters and numbers";
	}


	if(empty($error)){
		$stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?,?,?,?)");
		$stmt->bind_param("ssss",$name,$email,$phone,$password);
		if($stmt->execute()){
			$success="*User is Registered Sucessfully";
		}
		else{
			$error[]="*Something went wrong. Please try again.";
		}
	}
	


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
		<?php if(!empty($error)):?>
			<div class="error">
			  <ul>
			  <?php foreach ($error as $err){echo "<li>$err</li>";}?>
			  </ul>
			</div>
		<?php endif; ?>
		<?php if($success): ?>
			<div class=Success><?php echo $success; ?> 	</div>
		<?php endif; ?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method=POST >
			<div class="inputBox">
			<label>Name:</label><input type="text" name="name" required>
			<br>
			<span class="Err"><?php echo $nameErr; ?></span>
			</div>
			<br>
			<div class="inputBox">
			<label>Email:</label><input type="email" name="email" required>
			<br>
			<span class="Err"><?php echo $emailErr; ?></span>
			</div>
			<br>
			<div class="inputBox">
			<label>Phone:</label><input type="number" name="phone" required>
			<br>
			<span class="Err"></span>
			</div>
			<br>
			<div class="inputBox">
			<label>Password:</label><input type="password" name="password" required>
			<br>
			<span class="Err"><?php echo $passwordErr; ?></span>
			</div>
			<br>
			<button class="submit" type="submit">Submit</button>
			<button type="reset">Reset</button>
		</form>
	</div>
</body>
</html>
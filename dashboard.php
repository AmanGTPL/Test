<?php
session_start();
if(!isset($_SESSION["username"])){
	header("Location: signup.php");
	exit();
};

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		h2{
			text-align: center;
		}
		.logout{
			float:right;
			margin-right:50%;
			color:white;
			background-color:rgb(168, 29, 29);
			border-radius: 15px;

		}
	</style>
</head>
<body>
	<h2>Welcome to dashboard</h2>
	<h2>Hi, <?php echo htmlspecialchars($username); ?>! How are you?</h2>
	<form action="logout.php" method=POST>
	  <button class="logout" name="logout">Logout</button>
	</form>
	
</body>
</html>
<?php 
//connection function
session_start();
include "connection.php";

$name=$email="";
$error=[];
$success = "";
if($_SERVER['REQUEST_METHOD']=="POST"){
	$name = $_POST['name'];
	$email = $_POST['email'];

	$name = trim($name);
	$email = trim($email);


	if(empty($name)){
		$error[]= "Name is required";
	}
	elseif(!preg_match("/^[a-zA-Z ]*$/",$name)){
		$error[]= "Only text and Space required";
	}

	if(empty($email)){
		$error[] =  "Email is required";
	}
	elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$error[]= "Please enter valid Email";
	}

	if(empty($error)){
		$stmt = $conn->prepare("INSERT INTO users (name,email) VALUES (?,?)");
		$stmt->bindParam("ss",$name,$email);
		if($stmt->execute()){
			$success="User register successfully";
		}
		else{
			$error[] = "Something went wrong";
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
</head>
<body>
	<h3> 
	    <?php if(!empty($error)):?>
			<div>
			  <ol>
			  <?php foreach ($error as $err){echo "<li>$err</li>";}?>
			  </ol>
			</div>
		<?php endif; ?>	
		<?php if($success): ?>
			<div class=Success><?php echo $success; ?> 	</div>
		<?php endif; ?>

	<form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> method="POST">
		<input type="text" name="name" required>
		<input type="email" name="email" required>
		<button type="submit">Submit</button>
	</form>
</body>
</html>
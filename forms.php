<?php
session_start();
$nameErr=$emailErr=$genderErr=$websiteErr="";
$name=$email=$gender=$comment=$website="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST["name"])){
		$nameErr = "Name is required";
	}
	else{
		$name=test_input($_POST["name"]);
		if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
			$nameErr="Only letters and white space is allowed";
		}
	}
	
	if(empty($_POST["email"])){
		$emailErr = "Email is required";
	}
	else{
		$email=test_input($_POST["email"]);
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$emailErr="Email is invalid format";
		}
	}

	if(empty($_POST["website"])){
		$website = "";
	}
	else{
		$website=test_input($_POST["website"]);
		if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
			$websiteErr = "Invalid URL";
		}
	}

	if(empty($_POST["comment"])){
		$comment = "";
	}
	else{
		$comment=test_input($_POST["comment"]);
	}
	
	if(empty($_POST["gender"])){
		$genderErr = "Gender is required";
	}
	else{
	    $gender=test_input($_POST["gender"]);
	}
}	

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Form</title>
	<style>
		.error{
			color:red;
		}
	</style>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		Name: <input type="text" name="name"> 
		<span class="error">*<?php echo $nameErr; ?> </span>
		<br>
		Email: <input type="email" name="email"> 
		<span class="error">*<?php echo $emailErr; ?> </span>
		<br>
		Website: <input type="text" name="website"> 
		<span class="error">*<?php echo $websiteErr; ?> </span>
		<br>
		Comment: <textarea name="comment" rows="5" cols="40"></textarea> 
		<br>
		Gender:
		<input type="radio" name="gender" value="male">Male
		<input type="radio" name="gender" value="female">Female
		<input type="radio" name="gender" value="other">Others
		<span class="error">*<?php echo $genderErr; ?> </span>
		<br>
		<input type="submit">Submit
	</form>

	<?php
	echo "Your input are:";
	echo $name;
	echo "<br>";
	echo $email;
	echo "<br>";
	echo $website;
	echo "<br>";
	echo $comment;
	echo "<br>";
	echo $gender;
	?>

	<?php
	// echo $_SESSION["favColor"];
	// echo "<br>";
	// echo $_SESSION["favanimal"];
	?>
</body>
</html>

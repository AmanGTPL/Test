<?php
$target_dir="uploads/";
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
$uploadOk=1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])){
	$check=getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check != false){
		echo "File is an image - ".$check["mime"].".";
		$uploadOk=1;
	}
	else{
		echo "File is not an image.";
		$uploadOk=0;
	}

	if(file_exists(($target_file))){
		echo "Sorry file already exists.";
		$uploadOk = 0;
	}

	elseif($_FILES["fileToUpload"]["size"]>500000){
		echo "Sorry, your file is too large";
		$uploadOk = 0;
	}

	elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk=0;
	}

	elseif($uploadOk == 0){
		echo "Image is not able to upload!";
	}
	else{
		if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
			echo "The file ".htmlspecialchars(basename( $_FILES["fileToUpload"]["name"]))." has been upload.";
		}
		else{
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
?>
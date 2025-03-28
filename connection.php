<?php
// ------------------------Connection start-----------------------------------
// $dbhost = "localhost";
// $dbuser = "root";
// $dbpass = "";
// $dbname = "cruddb";

// $conn = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

// if($conn->connect_error){
// 	die ("Connection Failed: ".$conn->connect_error);
// }
// else{
// 	echo "database connected successfully <br>";
// }


$host = "localhost";
$user = "root";
$pass = "";

try{
	$conn = new PDO("mysql:host=$host;dbname=testdb", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connection Successfully";
}catch(PDOException $e){
	echo "Connection Failed: ". $e->getMessage();
}







































// -------------------------Create Database-------------------------------
// $sql = "CREATE DATABASE  TestDB";
// if($conn->query($sql) === TRUE){
// 	echo "Database created Successfully";
// }
// else{
// 	echo "Error creating database: ". $conn->error;
// }
// -------------------------Create Table----------------------------------
// $sql = "CREATE TABLE myGuests (id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, email VARCHAR(50), reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
// if($conn->query($sql)=== TRUE){
// 	echo "Table my Guests created successfully";
// }else{
// 	echo "ERROR creating table: ".$conn->error;
// }
//--------------------------Insert in Table--------------------------------------
// $sql = "INSERT INTO myGuests (firstname, lastname, email) VALUES ('John', 'snow', 'john@got.com')";
// if($conn->query($sql)=== TRUE){
// 	echo "New Record inserted";
// }
// else{
// 	echo "Error: ".$sql."<br>".$conn->error;
// }
// -------------------------Insrted last ID------------------------------------------
// $sql = "INSERT INTO myGuests (firstname, lastname, email) VALUES ('Aman','Singh','aman@gtpl.com')";
// if($conn->query($sql)===TRUE){
// 	$insertId = $conn->insert_id;
// 	echo "New record is created successfully. Last insrted ID is ".$insertId;
// }
// else{
// 	echo "Error ".$sql."<br>".$conn->error;
// }
// ------------------------multiple ID in table--------------------------------------------------
// $sql = "INSERT INTO myGuests (firstname, lastname, email) VALUES ('rahul', 'gupta', 'rahul@gmail.com');";
// $sql .= "INSERT INTO myGuests (firstname, lastname, email) VALUES ('abhihake', 'yadav', 'abhi@gmail.com');";
// $sql .= "INSERT INTO myGuests (firstname,lastname, email) VALUES ('Anil','sharma','anil@gmail.com');";

// if($conn->multi_query($sql)=== TRUE){
// 	echo "New records created successfully";
// }
// else{
// 	echo "Error ".$sql." <br> ".$conn->error;
// }
// -----------------------------Prepared statment------------------------------------------------------
// $stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?,?,?)");
// $stmt->bind_param('sss',$firstname,$lastame,$email);

// $firstname = "jhon";
// $lastname = "Doe";
// $email = "jhon@example.com";
// $stmt->execute();

// $firstname = "gyan";
// $lastname = "pal";
// $email = "gyan@mail.com";
// $stmt->execute();

// $firstname = "steve";
// $lastname = "smith";
// $email = "steve@gmail.com";
// $stmt->execute();

// echo "New record created successfully";

// $stmt->close();
// ---------------------------------Select statment----------------------------------------------------------------
// $sql = "SELECT id,firstname,lastname,email FROM myGuests";
// $result = $conn->query($sql);

// if($result->num_rows>0){
// 	while($row=$result->fetch_assoc()){
// 		echo "id: ".$row["id"]." -Name: ".$row["firstname"]." ".$row["lastname"]."<br>";
// 	}
// }
// else{
// 	echo "0 results";
// }
// ---------------------------------Select statment with where clause-----------------------------------------------
// $sql = "SELECT id, firstname, lastname, email FROM myGuests WHERE lastname = 'Doe'";
// $result = $conn->query($sql);
// if($result->num_rows>0){
// 	while($row=$result->fetch_assoc()){
// 		echo "id: ".$row["id"]." -Name: ".$row["firstname"]." ".$row["lastname"]." -Email: ".$row["email"]."<br>";
// 	}
// }
// else{
// 	echo "0 results";
// }
// ----------------------------------Select statment with where clause----------------------------------------------
// $sql = "SELECT id, firstname, lastname, email FROM myGuests ORDER BY id DESC";
// $result = $conn->query($sql);
// if($result->num_rows>0){
// 	while($row=$result->fetch_assoc()){
// 		echo "id: ".$row["id"]." -Name: ".$row["firstname"]." ".$row["lastname"]."<br>"; 
// 	}
// }
// else{
// 	echo "0 result";
// }
// -----------------------------------Delete the data from database--------------------------------------------------
// $sql = "DELETE FROM myGuests WHERE id = 1";
//  if($conn->query($sql) === TRUE){
// 	echo "Record delete successfully";
//  }
//  else{
// 	echo "Error deleting record: ".$conn->error;
//  }
// -----------------------------------Update the Data in DB---------------------------------------------------------------
// $sql = "UPDATE myGuests SET firstname = 'AMAN' WHERE id=2";
// if($conn->query($sql) === TRUE){
// echo "Record delete successfully";
// }
// else{
// echo "Error deleting record: ".$conn->error;	
// }

?>
<?php
session_start();

// Retain previous values if they exist
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Store in session
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .body {
            margin: 50px;
        }
        .container {
            justify-content: center;
            align-items: center;
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid black;
            border-radius: 10px;
        }
        .heading {
            color: black;
            text-align: center;
            margin-bottom: 40px;
        }
        .submit {
            text-align: center;
        }
        label {
            margin: 5px;
        }
        .input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        .inputBox {
            font-weight: bold;
            margin: 5px;
            padding-right: 10px;
        }
        button {
            background: lightskyblue;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .Err {
            font-size: small;
            color: red;
        }
        .error {
            font-size: small;
            color: red;
        }
        .success {
            color: green;
        }
		h1{
			text-align: center;
		}
    </style>
</head>
<body>
    <div class="container">
        <h3 class="heading">Registration form</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="inputBox">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <br>
            <div class="inputBox">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <br>
            <button class="submit" type="submit">Submit</button>
        </form>
    </div>
    <br>

    <?php
    if (!empty($name)) {
        echo "<h1>Hi $name, Your Email is $email.</h1>";
    } else {
        echo "<h1>Please enter your name above.</h1>";
    }
    ?>
</body>
</html>

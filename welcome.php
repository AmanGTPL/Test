<?php
session_start();
?>
<html>
<body>

Welcome <?php echo $_GET["name"]; ?><br>
Your email address is: <?php echo $_GET["email"]; ?>/
<?php
// print_r($_SESSION);
?>
</body>
</html>
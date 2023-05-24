<?php

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$cost = empty($_POST['custom_cost']) ? "NULL" : $_POST['custom_cost'];

// echo $username . "<br>" . $password. "<br>". $cost. "<br>";

session_start();
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
$_SESSION['custom_cost'] = $cost;

// echo $_SESSION['username'] . "<br>" . $_SESSION['password']. "<br>". $_SESSION['custom_cost']. "<br>";

session_write_close();
echo '<script> location = "start.php" </script>'

?>
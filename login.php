<?php

$username = $_POST['username'];
// $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$password = $_POST['password'];
$cost = empty($_POST['custom_cost']) ? "NULL" : $_POST['custom_cost'];

// echo $username . "<br>" . $password. "<br>". $cost. "<br>";

session_start();
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
$_SESSION['custom_cost'] = $cost;

// echo $_SESSION['username'] . "<br>" . $_SESSION['password']. "<br>". $_SESSION['custom_cost']. "<br>";

session_write_close();
$dsn = 'mysql:host=localhost;dbname='.$_SESSION['username'];
try {
    $pdo = new PDO($dsn, $_SESSION['username'], $_SESSION['password']);

    echo '<script> location = "welcome.php" </script>';
} 
catch (PDOException $e) {
    echo "Connection failed:" . $e->getMessage();
}

?>
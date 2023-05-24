<?php

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$name = $_POST['name'];
$sex = $_POST['sex'];
$phone = $_POST['phone'];
$cost = empty($_POST['custom_cost']) ? "NULL" : $_POST['custom_cost'];

// echo $username . "<br>" . $password. "<br>" . $name. "<br>" . $sex. "<br>" . $phone. "<br>" . $cost;

$sql_query = "INSERT INTO nativeUsers (username, password, name, phone) VALUES ('$username', '$password', '$name', '$phone')";

mysqli_query($db_link, $sql_query);

$sql_findID = "SELECT * FROM nativeUsers WHERE username = '".$_POST['username']."'";

$data = mysqli_query($db_link, $sql_findID);
$user = mysqli_fetch_assoc($data);

session_start();
$_SESSION['username'] = $user['username'];
$_SESSION['password'] = $user['password'];
$_SESSION['custom_cost'] = $user['custom_cost'];

// TODO: Create database and add tables to the database
// header('Location: welcome.php');

// CREATE USER $_SESSION['username']@'localhost' IDENTIFIED WITH caching_sha2_password BY '***';GRANT USAGE ON *.* TO $_SESSION['username']@'localhost';ALTER USER $_SESSION['username']@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `tester`;GRANT ALL PRIVILEGES ON `tester`.* TO $_SESSION['username']@'localhost';
?>


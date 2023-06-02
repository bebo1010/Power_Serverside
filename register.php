<?php

$username = $_POST['username'];
// $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$password = $_POST['password'];
$name = $_POST['name'];
$sex = $_POST['sex'];
$phone = $_POST['phone'];
$cost = empty($_POST['custom_cost']) ? "NULL" : $_POST['custom_cost'];

// echo $username . "<br>" . $password. "<br>" . $name. "<br>" . $sex. "<br>" . $phone. "<br>" . $cost;
// create user with root
$dsn = 'mysql:host=localhost';
try{
    $pdo = new PDO($dsn, "root", "RootAsAdmin");
    
    // Create user
    $createUserSql = "CREATE USER :username@'localhost' IDENTIFIED WITH mysql_native_password BY :password";
    $stmt = $pdo->prepare($createUserSql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->execute();

    // Create database
    $createDbSql = "CREATE DATABASE IF NOT EXISTS `$username`";
    $pdo->exec($createDbSql);

    // Grant privileges to user
    $grantSql = "GRANT ALL PRIVILEGES ON `$username`.* TO :username@'localhost'";
    $stmt = $pdo->prepare($grantSql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    // Flush privileges
    $pdo->exec("FLUSH PRIVILEGES");
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage(). "<br>";
}

// add user with root
$dsn = 'mysql:host=localhost;dbname=database_report_gp10';
try{
    $pdo = new PDO($dsn, "root", "RootAsAdmin");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlScript = file_get_contents('./sql_scripts/add_user.sql');
    
    // Prepare the SQL script with placeholders
    $stmt = $pdo->prepare($sqlScript);

    // Bind the arguments to the placeholders
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':sex', $sex);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':cost', $cost);

    if($stmt->execute()){
        echo "User added to database successfully<br>";
    }
    else{
        echo "Error adding user: ". $stmt->errorInfo()[2]. "<br>"; 
    }
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage(). "<br>";
}

// add tables to user database
$dsn = 'mysql:host=localhost;dbname='.$username;
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $files = glob("./sql_scripts/Register". "/*.sql");

    foreach($files as $file){
        $sqlScript = file_get_contents($file);
        $pdo->exec($sqlScript);
    }

} 
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

session_start();
$_SESSION['username'] = $user['username'];
$_SESSION['password'] = $user['password'];
$_SESSION['custom_cost'] = $user['custom_cost'];

// TODO: Create database and add tables to the database
// header('Location: welcome.php');

// 
?>


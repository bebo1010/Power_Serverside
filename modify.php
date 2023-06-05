<?php
    session_start();
    $dsn = 'mysql:host=localhost;dbname='.$_SESSION['username'];
    try {
        $pdo = new PDO($dsn, $_SESSION['username'], $_SESSION['password']);
    
        $Serial_no = trim($_POST['Serial_no'], '"');
        // $Serial_no = $_POST['Serial_no'];
        $Date = $_POST['Date'];
        $KWH = $_POST['KWH'];
        $Environment = $_POST['Environment'];
    
        // echo $Serial_no ."<br>". $Date ."<br>". $KWH ."<br>". $Environment."<br>";
        // Read the SQL script from a file or any other source
        $sqlScript = file_get_contents('./sql_scripts/modify.sql');

        // Prepare the SQL script with placeholders
        $stmt = $pdo->prepare($sqlScript);
    
        // Bind the arguments to the placeholders
        $stmt->bindParam(':Serial_no', $Serial_no);
        $stmt->bindParam(':Date', $Date);
        $stmt->bindParam(':KWH', $KWH);
        $stmt->bindParam(':Environment', $Environment);

        // Execute the prepared statement   
        if(!$stmt->execute()){
            echo '<script>
            alert("Update failed")
            window.location = "welcome.php"
            </script>'; 
            echo "Error on: ". $stmt->errorInfo()[2]. "<br>"; 
        }
        else
            echo '<script>
            alert("Update Complete!")
            window.location = "welcome.php"
            </script>';

    } 
    catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

?>
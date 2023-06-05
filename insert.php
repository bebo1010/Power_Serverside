<?php
    session_start();
    $dsn = 'mysql:host=localhost;dbname='.$_SESSION['username'];
    try {
        $pdo = new PDO($dsn, $_SESSION['username'], $_SESSION['password']);
    
        $Date = $_POST['Date'];
        $KWH = $_POST['KWH'];
        $Environment = $_POST['Environment'];
    
        // Read the SQL script from a file or any other source
        $sqlScript = file_get_contents('./sql_scripts/insert.sql');

        // Prepare the SQL script with placeholders
        $stmt = $pdo->prepare($sqlScript);
    
        // Bind the arguments to the placeholders
        $stmt->bindParam(':Date', $Date);
        $stmt->bindParam(':KWH', $KWH);
        $stmt->bindParam(':Environment', $Environment);

        // Execute the prepared statement   
        if(!$stmt->execute()){
            echo '<script>
            alert("Insert failed")
            window.location = "welcome.php"
            </script>'; 
            echo "Error on: ". $stmt->errorInfo()[2]. "<br>"; 
        }
        else
            echo '<script>
            alert("Insert Complete!")
            window.location = "welcome.php"
            </script>';
    } 
    catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

?>
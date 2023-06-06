<?php
    session_start();
    require("./welcome.php");

    $dsn = 'mysql:host=localhost;dbname='.$_SESSION['username'];
    try {
        $pdo = new PDO($dsn, $_SESSION['username'], $_SESSION['password']);
    
        $Start_Date = $_POST['Start_Date'];
        $End_Date = $_POST['End_Date'];
        $Environment = $_POST['Environment'];
    
        // Read the SQL script from a file or any other source
        $sqlScript = file_get_contents('./sql_scripts/search.sql');
    
        // Prepare the SQL script with placeholders
        $stmt = $pdo->prepare($sqlScript);
    
        // Bind the arguments to the placeholders
        $stmt->bindParam(':Start_Date', $Start_Date);
        $stmt->bindParam(':End_Date', $End_Date);
        $stmt->bindParam(':Environment', $Environment);
    
        // Execute the prepared statement
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo '<script>';
        foreach ($result as $row) 
        {
            echo 'Add_Row(' .$row['Serial_no'] .', "'. $row['Date'].'", '. $row['KWH'].', "'. $row['Use environment'].'");';
        }
        echo '</script>';
    } 
    catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
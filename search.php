<?php
    require("./start.php");
?>

<?php
    session_start();
    $Start_Date = "'" .$_POST['Start_Date'] ."'";
    $End_Date = "'" .$_POST['End_Date'] ."'";
    $Diff_no = $_POST['Diff_no'];

    $dsn = 'mysql:host=localhost;dbname='.$_SESSION['username'];
    try {
        $pdo = new PDO($dsn, $_SESSION['username'], $_SESSION['password']);
    
        $Start_Date = "'" .$_POST['Start_Date'] ."'";
        $End_Date = "'" .$_POST['End_Date'] ."'";
    
        // Read the SQL script from a file or any other source
        $sqlScript = file_get_contents('./sql_scripts/search.sql');
    
        echo $sqlScript;
        // Prepare the SQL script with placeholders
        $stmt = $pdo->prepare($sqlScript);
    
        // Bind the arguments to the placeholders
        $stmt->bindParam(':Start_Date', $Start_Date);
        $stmt->bindParam(':End_Date', $End_Date);
    
        // Execute the prepared statement
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo '<script>';
        foreach ($result as $row) 
        {
            echo '$("#電表清單 > tbody").append('.'"<tr>
            <td>' .$row['User_id']. 
            '<td>' .$row['Time']. 
            '<td>' .$row['KWH']. 
            '<td>' .$row['Diff_no'].'")';
        }
        echo '</script>';
    } 
    catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
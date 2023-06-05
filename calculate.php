<?php
    $Start_Date = $_POST['Start_Date'];
    $End_Date = $_POST['End_Date'];
    $Environment = $_POST['Environment'];
    $result;
    require("./search.php");
?>

<?php
    $Start_Date = new DateTime($Start_Date);
    $End_Date = new DateTime($End_Date);
    echo    '<script>
            Month_interval ='.$Start_Date->diff($End_Date)->m; 
    echo    '</script>';

    $dsn = 'mysql:host=localhost;dbname='.$_SESSION['username'];
    try {
        $pdo = new PDO($dsn, $_SESSION['username'], $_SESSION['password']);
    
        // Read the SQL script from a file or any other source
        if($Environment == "住宅"){
            $sqlScript = file_get_contents('./sql_scripts/get_residential_fee.sql');
        }
        if($Environment == "商用"){
            $sqlScript = file_get_contents('./sql_scripts/get_commercial_fee.sql');
        }
    
        // Prepare the SQL script with placeholders
        $stmt = $pdo->prepare($sqlScript);
    
        // Execute the prepared statement
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo '<script> Summer_rate = []; Non_summer_rate = [];';
        foreach ($result as $row) 
        {
            echo 'Summer_rate.push('.$row['Summer_rate'].');';
            echo 'Non_summer_rate.push('.$row['Non-summer_rate'].');';
        }
        if($Start_Date->diff($End_Date)->y <= 1){
            // check in summer or not
            if($Start_Date->format("m") >= '06' && $End_Date->format("m") <= '10'){
                // I am too lazy to write all possible outcomes, just bear with me
                // only if the beginning and ending lies within the summer interval counts
                echo 'calculate('.$Environment.', true);';
            }
        }
        else{
            echo 'calculate('.$Environment.', false);';
        }
        echo '</script>';
    } 
    catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
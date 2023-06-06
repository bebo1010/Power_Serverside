<?php
    $Start_Date = $_POST['Start_Date'];
    $End_Date = $_POST['End_Date'];
    $Environment = $_POST['Environment'];
    $result;
    require("./search.php");
?>

<?php
    // use custom rate or not
    $Custom_rate = isset($_POST['Custom_rate']) && $_POST['Custom_rate'] === 'true';
    $Use_custom_rate = $Custom_rate ? 'true' : 'false';
    if ($Use_custom_rate) {
        // retrieve the rate
        $dsn = 'mysql:host=localhost;dbname=database_report_gp10';
        try{
            $pdo = new PDO($dsn, "root", "RootAsAdmin");
            
            // Get custom rate
            $sqlScript = "SELECT `Customize rate` FROM `user` WHERE `Username` = :username";
            $stmt = $pdo->prepare($sqlScript);
            $stmt->bindValue(':username', $_SESSION['username']);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $custom_rate = $row['Customize rate'];
                echo '<script>';
                echo 'var Custom_rate = "' . $custom_rate . '";';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'var Custom_rate = "";'; // or handle the case where no row is found
                echo '</script>';
            }
        }
        catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage(). "<br>";
        }
      } 
?>

<?php
    // get month interval and whether in summer or not
    $Start_Date = new DateTime($Start_Date);
    $End_Date = new DateTime($End_Date);
    echo    '<script>
            Month_interval = ('.$End_Date->diff($Start_Date)->m.' + 1)'; 
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
                $In_summer = true;
            }
            else{
                $In_summer = false;
            }
        }
        else{
            $In_summer = false;
        }
        echo 'calculate("'.$Environment . '",'.$In_summer . ',' .$Use_custom_rate. ');';
        echo '</script>';
    } 
    catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
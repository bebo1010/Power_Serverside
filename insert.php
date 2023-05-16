<?php
    $con = new mysqli("localhost","root","RootAsAdmin", "database_report_gp10");
    if ($con == false)
        die('Could not connect: ' . mysqli_connect_error());

    $User_id = $_POST['UserID'];
    $KWH = $_POST['KWH'];
    $Date = "'" .$_POST['Date'] ."'";
    $Diff_no = $_POST['Diff_no'];

    if($Diff_no == 1)
        $result = mysqli_query(
            $con,
            "INSERT INTO `business electricity`(`User_id`, `KWH`, `Time`, `Diff_no`) 
            VALUES (".$User_id."," .$KWH ."," .$Date ."," .$Diff_no.")");
    else
        $result = mysqli_query(
            $con,
            "INSERT INTO `residential electricity`(`User_id`, `KWH`, `Time`, `Diff_no`)
            VALUES (".$User_id."," .$KWH .",'" .$Date ."'," .$Diff_no.")");

    
    mysqli_close($con);

    if($result == false)
        echo '<script>
        alert("Insert failed")
        window.location = "start.php"
        </script>';
    else
        echo '<script>
        alert("Insert Complete!")
        window.location = "start.php"
        </script>';
?>
<?php
    $con = new mysqli("localhost","root","RootAsAdmin", "database_report_gp10");
    if ($con == false)
        die('Could not connect: ' . mysqli_connect_error());

    $KMH = $_POST['KMH'];
    $Date = "'" .$_POST['Date'] ."'";
    $Diff_no = $_POST['Diff_no'];


    if($Diff_no == 1)
        $result = mysqli_query(
            $con,
            "INSERT INTO `business electricity`(`User_id`, `KMH`, `Time`, `Diff_no`) 
            VALUES (0," .$KMH ."," .$Date ."," .$Diff_no.")");
    else
        $result = mysqli_query(
            $con,
            "INSERT INTO `residential electricity`(`User_id`, `KMH`, `Time`, `Diff_no`) 
            VALUES (0," .$KMH .",'" .$Date ."'," .$Diff_no.")");

    mysqli_close($con);

    echo '<script>alert("Insert Complete!")</script>';
    echo "document.location = 'start.php'";
?>
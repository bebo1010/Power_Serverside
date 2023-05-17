<?php
    require("./start.php");
?>

<?php
    $con = new mysqli("localhost","root","RootAsAdmin", "database_report_gp10");
    if ($con == false)
        die('Could not connect: ' . mysqli_connect_error());

    $Start_Date = "'" .$_POST['Start_Date'] ."'";
    $End_Date = "'" .$_POST['End_Date'] ."'";
    $Diff_no = $_POST['Diff_no'];

    echo "" .$row['User_id']. "" .$row['KWH']. "" .$row['Time']. "" .$row['Diff_no'];

    if($Diff_no == 1)
        $result = mysqli_query(
            $con,
            "SELECT `User_id`, `KWH`, `Time`, `Diff_no`
            FROM `business electricity`
            WHERE Time >=" .$Start_Date ."AND Time <" .$End_Date);
    else
        $result = mysqli_query(
            $con,
            "SELECT `User_id`, `KWH`, `Time`, `Diff_no`
            FROM `residential electricity`
            WHERE Time >=" .$Start_Date ."AND Time <" .$End_Date);

    mysqli_close($con);

    while($row = mysqli_fetch_array($result))
    {
        echo '<script>
            $("#電表清單 > tbody").append('."\"<tr><td>" .$row['User_id']. "<td>" .$row['Time']. "<td>" .$row['KWH']. "<td>" .$row['Diff_no'].'")
        </script>';
    }
?>
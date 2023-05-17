<!DOCTYPE html>
<html>
    <head>
        <title>
            電費試算
        </title>
        <link rel="stylesheet" href="./stylesheet/main.css">
        <script src="./script/main.js">

        </script>
    </head>

    <body>
        <div class="tab">
            <button class="tablinks" onclick="loadTab(event, 'Search')" id="defaultOpen">查詢</button>
            <button class="tablinks" onclick="loadTab(event, 'Insert')">新增</button>
            <button class="tablinks" onclick="loadTab(event, 'Delete')">刪除</button>
        </div>

        <div id="Search" class="tabcontent">
            <form action="search.php" method="post">

                <label>
                    開始時間：<input type="date" id="開始時間" name="Start_Date" value=<?php echo $_POST['Start_Date']; ?>>
                </label>

                <label>
                    結束時間：<input type="date" id="結束時間" name="End_Date" value=<?php echo $_POST['End_Date']; ?>>
                </label>

                <select id="商業/住宅" name="Diff_no">
                    <option value="2">
                        住宅
                    </option>
                    <option value="1">
                        商用
                    </option>
                </select>

                <input type="submit" value="查詢資料">
            </form>
        </div>

        <div id="Insert" class="tabcontent">
            <!-- <form action="https://httpbin.org/post" method="post"> -->
            <form action="insert.php" method="post">
                <label>
                    使用者ID：<input type="number" id="使用者ID" name="UserID">
                </label>

                <label>
                    日期：<input type="date" id="日期輸入" name="Date" value="<?php echo date('Y-m-d'); ?>">
                </label>

                <label>
                    電表度數：<input type="number" id="電表度數輸入" name="KMH">
                </label>

                <select id="商業/住宅" name="Diff_no">
                    <option value="2">
                        住宅
                    </option>
                    <option value="1">
                        商用
                    </option>
                </select>
                
                <input type="submit" value="新增一筆資料">
                          
            </form>
        </div>

        <div id="Delete" class="tabcontent">

        </div>
        
        <div id="Result">
            <table id="電表清單">
                <tr id="標題">
                    <th style="width:5%">
                        ID
                    </th>
                    <th style="width:30%">
                        日期
                    </th>
                    <th style="width:20%">
                        電表度數
                    </th>
                    <th style="width:5%">
                        Diff_no
                    </th>
                </tr>
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
                        echo "<tr>";
                        echo "<td>" .$row['User_id']. "<td>" .$row['Time']. "<td>" .$row['KWH']. "<td>" .$row['Diff_no'];
                        echo "</tr>";
                    }

                ?>
            </table>
        </div>

        <script>
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>
    </body>
</html>






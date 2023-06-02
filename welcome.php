<!DOCTYPE html>
<html>
    <head>
        <title>
            電費試算
        </title>
        <link rel="stylesheet" href="./stylesheet/main.css">
        <script src="./jquery-3.7.0.min.js">
            
        </script>
        <script src="./script/main.js">

        </script>
    </head>

    <body>
        <div class="tab">
            <button class="tablinks" onclick="loadTab(event, 'Search')" id="defaultOpen">查詢</button>
            <button class="tablinks" onclick="loadTab(event, 'Insert')">新增</button>
        </div>

        <div id="Search" class="tabcontent">
            <form action="search.php" method="post">
                <label>
                    開始時間：<input type="date" id="開始時間" name="Start_Date" value="<?php echo date('Y-m-d'); ?>">
                </label>

                <label>
                    結束時間：<input type="date" id="結束時間" name="End_Date" value="<?php echo date('Y-m-d'); ?>">
                </label>

                <select id="商業/住宅" name="Environment">
                    <option value="住宅">
                        住宅
                    </option>
                    <option value="商用">
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
                    日期：<input type="date" id="日期輸入" name="Date" value="<?php echo date('Y-m-d'); ?>">
                </label>

                <label>
                    電表度數：<input type="number" id="電表度數輸入" name="KWH">
                </label>

                <select id="商業/住宅" name="Environment">
                    <option value="住宅">
                        住宅
                    </option>
                    <option value="商用">
                        商用
                    </option>
                </select>
                
                <input type="submit" value="新增一筆資料">
                          
            </form>
        </div>

        <div id="Result">
            <table id="電表清單">
                <tr id="標題">
                    <th style="width:5%">
                        ID
                    </th>
                    <th style="width:25%">
                        日期
                    </th>
                    <th style="width:15%">
                        電表度數
                    </th>
                    <th style="width:10%">
                        登記環境
                    </th>
                    <th style="width:15%" colspan="4">
                        操作
                    </th>
                </tr>
            </table>
        </div>

        <script>
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>

    </body>
</html>
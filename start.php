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

        <script>
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>

        <div id="Search" class="tabcontent">
            <form action="search.php">
                <label>
                    使用者ID：<input type="text" id="ID輸入" name="UserID">
                </label>

                <label>
                    開始時間：<input type="date" id="開始時間" name="Start_Date">
                </label>

                <label>
                    結束時間：<input type="date" id="結束時間" name="End_Date">
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
                    日期：<input type="date" id="日期輸入" name="Date">
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
                    <th>
                        日期
                    </th>
                    <th>
                        電表度數
                    </th>
                </tr>
            </table>
        </div>

        
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <title>
            會員註冊
        </title>
    </head>

    <body>
        <form id="register" method="post" action="./register.php">
            <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
                <tr>
                    <div class="content">
                        <td colspan="2" align="center" bgcolor="#CCCCCC">註冊會員資料</td>
                </tr>
                <tr>
                    <td width="80" align="center" valign="baseline">帳號</td>
                    <td valign="baseline">
                        <input type="text" name="username" id="username" value="" required></td>
                </tr>
                <tr>
                    <td width="80" align="center" valign="baseline">密碼</td>
                    <td valign="baseline">
                        <input type="password" name="password" id="password" value="" required></td>
                </tr>
                <tr>
                    <td width="80" align="center" valign="baseline">名字</td>
                    <td valign="baseline">
                        <input type="text" name="name" id="name" value="" required></td>
                </tr>
                <tr>
                    <td width="80" align="center" valign="baseline">性別</td>
                    <td valign="baseline">
                        <select name="sex" id="sex">
                            <option value="" selected hidden disabled>請選擇性別</option>
                            <option value="男">男</option>
                            <option value="女">女</option>
                            <option value="其他">其他</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="80" align="center" valign="baseline">電話</td>
                    <td valign="baseline">
                        <input type="tel" name="phone" id="phone"></td>
                </tr>
                <tr>
                    <td width="80" align="center" valign="baseline">自訂電費</td>
                    <td valign="baseline">
                        <input type="number" name="custom_cost" id="custom_cost" min="0" step="0.01" placeholder="請填入每度幾元，非必填"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center" bgcolor="#CCCCCC">
                        <input type="hidden" name="action" value="store">
                        <input type="submit" id="submit_button" value="註冊"></td>
                </tr>
            </table>
        </form>
    </body>
</html>

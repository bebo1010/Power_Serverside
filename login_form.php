<!DOCTYPE html>
<html>
    <head>
        <title>
            會員登入
        </title>
    </head>

    <body>
        <form id="login" method="post" action="./login.php">
            <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
                <tr>
                    <div class="content">
                        <td colspan="2" align="center" bgcolor="#CCCCCC">會員登入</td>
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
                    <td colspan="2" align="center" bgcolor="#CCCCCC">
                        <input type="hidden" name="action" value="store">
                        <input type="submit" id="submit_button" value="登入"></td>
                </tr>
            </table>
        </form>
    </body>
</html>
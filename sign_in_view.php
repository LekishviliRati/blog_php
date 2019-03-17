<html>
<head>
    <title> </title>
    <meta charset="utf-8">
</head>

<body>
<p><a href="homepage.php"> Home page</a></p>
<div align="center">
    <h2>Sign_in</h2>
    <br /><br />
    <form method="POST" action="">
        <table>
            <tr>
                <td align="right">
                    <label for="mail_connect">Mail to connect :</label>
                </td>
                <td>
                    <input type="text" name="mail_connect" placeholder="Mail..." />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="pass_connect">Password :</label>
                </td>
                <td>
                    <input type="password" name="pass_connect" placeholder="Password ..." />
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type="submit" name="sign_in_form" value="Sign In" />
                </td>
            </tr>
            <tr>
                <td>
                    <br />
                    You are not registered yet ?
                </td>
                <td>
                    <br />
                    <a href="sign_up.php">Create Account</a>
                </td>
            </tr>
            <tr>
                <td>
                    <br />
                </td>
                <td>
                    <br />
                    <a href="forgot_password.php">Forgot your password ?</a>
                </td>
            </tr>
        </table>
    </form>
    <!--  Display error message  -->
    <?php
    if(isset($error))
    {
        echo '<font color="red">'.$error. "</font>";
    }
    ?>
</div>
</body>
</html>

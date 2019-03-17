<html>
<head>
    <title> </title>
    <meta charset="utf-8">
</head>

<body>
<p><a href="homepage.php"> Home page</a></p>
<div align="center">
    <h2>Sign_up</h2>
    <br /><br />
    <form method="POST" action="">
        <table>
            <tr>
                <td align="right">
                    <label for="pseudo">Pseudo :</label>
                </td>
                <td>
                    <input type="text" placeholder="My pseudo ..." id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>"/>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="mail">Mail :</label>
                </td>
                <td>
                    <input type="email" placeholder="example@mail.com" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>"/>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="password">Password :</label>
                </td>
                <td>
                    <input type="password" placeholder="My password ..." id="password" name="password" />
                </td>
            </tr>

            <tr>
                <td align="right">
                    <label for="password2">Password confirmation :</label>
                </td>
                <td>
                    <input type="password" placeholder="Confirmation ..." id="password2" name="password2" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <br />
                    <input type="submit" name="sign_up_form" value="Submit">
                </td>
            </tr>
            <tr>
                <td>
                    <br />
                    Already registered ?
                </td>
                <td>
                    <br />
                    <a href="sign_in.php">Sign In</a>
                </td>
            </tr>
        </table>
    </form>

    <!--  Display error message  -->
    <?php
    if(isset($message))
    {
        echo '<font color="red">'.$message. "</font>";
    }
    ?>
</div>
</body>
</html>
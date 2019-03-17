    <html>
    <head>
        <title> </title>
        <meta charset="utf-8">
    </head>

    <body>
    <a href="profile.php">back</a>
    <div align="center">
        <h2>Edit my profile</h2>
        <form method="POST" action="">
            <table> <br />
                <tr>
                    <td align="right">
                        <label for="pseudo" >Pseudo :</label>
                        <input type="text" name="new_pseudo" id="pseudo" placeholder="Pseudo" value="<?= $user['pseudo']?>"/><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail" >Mail :</label>
                        <input type="text" name="new_mail" id="mail" placeholder="Mail" value="<?= $user['mail']?>"/><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="password" >New password :</label>
                        <input type="password" name="new_password" id="password" placeholder="Password" /><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="password2" >Confirm new password :</label>
                        <input type="password" name="new_password2" id="password2" placeholder="Confirm Passwword" /><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right"><br />
                        <input type="submit" value="Update my profile">
                    </td>
                </tr>
            </table>
        </form>
        <?php if(isset($message)){echo $message;} ?>
    </div>
    </body>
    </html>




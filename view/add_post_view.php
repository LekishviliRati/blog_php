<html>
    <head>
        <title> Add posts</title>
        <meta charset="utf-8">
    </head>

    <body>
    <a href="profile.php">back</a>
    <div align="left">
        <h2>Add New Post ! </h2>
        <form method="POST" action="">
            <table>



                <tr>
                    <td align="right">
                        <label for="title"> Title :</label>
                        <input type="text" name="title" id="title" placeholder="Title" /><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="standfirst"> standfirst :</label>
                        <input type="text" name="standfirst" id="standfirst" placeholder="standfirst" /><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="content"> content :</label>
                        <input type="text" name="content" id="content" placeholder="content" /><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right"><br />
                        <input type="submit" name="add_post" value="Add this post !">
                        <input type="hidden" name="user_id" value="<?= $_POST['user_id'] ?>"/>
                    </td>
                </tr>
            </table>
        </form>
        <?php if(isset($message)){echo $message;} ?>
    </div>

    </body>
    </html>

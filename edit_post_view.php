<html>
    <head>
        <title> </title>
        <meta charset="utf-8">
    </head>

    <p><a href="post_page_admin.php?post=<?= $_GET['post'] ?>"> Back to post </a></p>
    <body>
    <div align="center">
        <h2>Edit my post</h2>
        <form method="POST" action="">
            <table> <br />
                <tr>
                    <td align="right">
                        <label for="new_title" >Title : </label>
                        <input type="text" name="new_title" id="new_title" placeholder="New title" value="<?= $user['title']?>"/><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="new_standfirst" >Standfirst :</label>
                        <input type="text" name="new_standfirst" id="new_standfirst" placeholder="New standfirst" value="<?= $user['standfirst']?>"/><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="new_content" >Content :</label>
                        <input type="text" name="new_content" id="new_content" placeholder="New content" value="<?= $user['content']?>" /><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right"><br />
                        <input type="submit" value="Update my post">
                    </td>
                </tr>
            </table>
        </form>
        <?php if(isset($message)){echo $message;} ?>

    </div>
    </body>
</html>

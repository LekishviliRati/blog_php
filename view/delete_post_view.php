
    <html>
    <head>
        <title> Add posts</title>
        <meta charset="utf-8">
    </head>

    <body>

    <div align="left">
        <h2>Please confirm to delete this post </h2>
        <form method="POST" action="">
            <table>
                <tr>
                    <td align="right"><br />
                        <input type="submit" name="delete_post" value="Delete this post !">
                    </td>
                </tr>
            </table>
        </form>
        <?php if(isset($message)){echo $message;} ?>
    </div>

    </body>
    </html>

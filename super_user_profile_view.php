<html>
    <head>
        <title></title>
        <meta charset="utf-8">
    </head>

    <body>
    <div align="center">
        <h2>Welcome to <?= $user_info['pseudo']; ?></h2>
        <br/>
        Pseudo = <?= $user_info['pseudo']; ?>
        <br/>
        Mail = <?= $user_info['mail']; ?>

        <p>Total Posts : <?="$number_of_posts";?></p>
        <a href="posts_super_user.php">Check posts</a>
        <br/>
        <p>Total of Users : <?="$number_of_users";?></p>
        <a href="users_super_user.php">Check users</a>
        <br/>
        <p>Total Comments : <?="$number_of_comments";?></p>
        <a href="comments_super_user.php">Check comments</a>
        <br/><br/>
        <a href="log_out.php">Log_Out </a>
        <br/>
    </div>
    </body>
    </html>

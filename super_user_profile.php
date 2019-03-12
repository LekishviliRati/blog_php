<?php
session_start();
$user_id = $_SESSION['id'];

if (isset($user_id)) {

    //Connect to DB
    try {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $get_id = intval($user_id); // > Secure ID entered by converting it into number (and not letters e.g.)
    $req_user = $db->prepare('SELECT * FROM user WHERE id=?');
    $req_user->execute(array($get_id));
    $user_info = $req_user->fetch();

    // calculate total of posts
    $total_posts = $db->query("SELECT * FROM post");
    $number_of_posts = $total_posts->rowCount();

    // calculate total of users
    $total_users = $db->query("SELECT * FROM user");
    $number_of_users = $total_users->rowCount();

    // calculate total of comments
    $total_comments = $db->query("SELECT * FROM comment");
    $number_of_comments = $total_comments->rowCount();

    ?>



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

        <?php // mask all content of the page to visitors because it's dedicated to connected users
}else {
    echo "Access Denied ! ";
    ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}
?>
<?php
session_start();
$user_id = $_SESSION['id'];

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
        <?php
        if (isset($user_id) AND $user_info['id'] == $user_id) {
            ?>
            <br/>
            <a href="edit_profile.php">Edit My Profile</a>
            <br/>
            <a href="log_out.php">Log_Out </a>
            <br/>
            <a href="add_post.php">Add post </a>
            <br/>
            <a href="posts_list_admin.php">See my posts </a>
            <br/>
            <a href="comments_admin.php">See comments </a>
    </div>
    </body>
    </html>

<?php // mask all content of the page to visitors because it's dedicated to connected users
} else {
    echo "Access Denied ! ";
    ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}
?>
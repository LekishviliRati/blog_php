<?php
session_start();
$user_id = $_SESSION['id'];

if (isset($user_id) == 14) {

//Connect to DB
    try {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    ?>
    <p>
        <a href="super_user_profile.php"> back<a/> <!--todo : split "back" from php code, to avoid the while loop-->
    </p>

    <?php

//Get comments list
    $req = $db->prepare('SELECT id, author, post_id, content, status, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comment ORDER BY creation_date ');
    $req->execute(array($user_id));
    while ($data = $req->fetch()) {

        ?>

        <html>
        <head>
            <title> All comments</title>
            <meta charset="utf-8">
        </head>
        <body>

        <div class="news">

            <h3>
                comment ID : <?= htmlspecialchars($data['id']); ?>
            </h3>
            <h3>
                Auteur : <?= htmlspecialchars($data['author']); ?>
            </h3>

            <p>
                Post id :  <?= htmlspecialchars($data['post_id']); ?>
            <p>
                Status :

                <?php if ($data['status'] == 0) {

                    echo "Non published";
                }else {
                    echo "Published";
                } ?>
            </p>
            </p>

            <p>
                content :  <?= nl2br(htmlspecialchars($data['content'])); ?>
                <br/>
                <em>le <?= $data['creation_date_fr']; ?></em>
                <br/>

            <form method="POST" action="delete_comment_super_user.php">
                <input type="submit" name="delete_comment" value="Delete this comment">
                <input type="hidden" name="comment_id" value="<?= $data['id'] ?>"/>
            </form>
        </div>
        <?php
    } // End of the post loop
    $req->closeCursor(); ?>


</body>
    </html>

    <?php // mask all content of the page to visitors because it's dedicated to connected users
} else {
    echo "Access Denied ! "; ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}
?>



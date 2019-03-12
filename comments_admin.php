<?php
session_start();
$user_id = $_SESSION['id'];

if (isset($user_id)) {

//Connect to DB
try {
    $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

?>
<p>
    <a href="profile.php"> back<a/>
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
            <form method="POST" action="validate_comment_admin.php">
            <input type="submit" name="accept_comment" value="Publish this comment">
            <input type="hidden" name="comment_id" value="<?= $data['id'] ?>"/>
            </form>
            <form method="POST" action="delete_comment_admin.php">
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



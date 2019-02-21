<?php
session_start();
$user_id = $_SESSION['id'];
//Connect to DB
try {
    $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

?>

<html>
<head>
    <title> My posts</title>
    <meta charset="utf-8">
</head>
<body>

<p>
    <a href="profile.php"> back<a/>
</p>

<?php

if (isset($user_id)) {

//Get posts list
    $req = $db->prepare('SELECT id, title, content, standfirst,  DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post WHERE user_id = ? ORDER BY creation_date ');
    $req->execute(array($user_id));
    while ($data = $req->fetch()) {
        ?>


    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']); ?>
        </h3>

        <p>
            <?= htmlspecialchars($data['standfirst']); ?>
        </p>

        <p>
            <?= nl2br(htmlspecialchars($data['content'])); ?>
            <br/>
            <em>le <?= $data['creation_date_fr']; ?></em>
            <br/>
            <em><a href="post_page_admin.php?post=<?= $data['id']; ?>">See post</a></em>
        </p>
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



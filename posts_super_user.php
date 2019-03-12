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

<html>
<head>
    <title> My posts</title>
    <meta charset="utf-8">
</head>
<body>

<p>
    <a href="super_user_profile.php"> back<a/>
</p>

<p>
    ALL POSTS
</p>

<?php


//Get posts list
$req = $db->query('SELECT id, title, content, standfirst,  DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post ORDER BY creation_date DESC ');
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
            <em> Posted : <?= $data['creation_date_fr']; ?></em>
            <br/>
            <em><a href="post_page_super_user.php?post=<?= $data['id']; ?>">See post</a></em>
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



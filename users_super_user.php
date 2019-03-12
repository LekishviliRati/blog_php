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
    <a href="super_user_profile.php"> back<a/>
</p>

<p>
    ALL USERS
</p>

<?php

if (isset($user_id) == 14) {

//Get users
$req = $db->query('SELECT id, pseudo, mail, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin%ss\') AS registration_date_fr FROM user ORDER BY registration_date DESC ');
while ($data = $req->fetch()) {

    ?>


    <div class="news">
        <h3>
            Pseudo : <?= htmlspecialchars($data['pseudo']); ?>
        </h3>

        <p>
           Mail : <?= htmlspecialchars($data['mail']); ?>
        </p>

        <p>
          Registration date : <?= nl2br(htmlspecialchars($data['registration_date_fr'])); ?>
        </p>

        <p>
            <a href="delete_user.php?post=<?= $data['id']; ?>">Delete this user</a>
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



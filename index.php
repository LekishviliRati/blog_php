<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>My Blog</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>

<h1>Blog Posts_List</h1>

<?php
// Connect to Data Base
try
{
    $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

// Display last 5 posts
$req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, user_id FROM post ORDER BY creation_date DESC LIMIT 0, 5');
while ($data = $req->fetch())
{
    ?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['user_id']); ?>
            <?= htmlspecialchars($data['title']); ?>
            <em>le <?= $data['creation_date_fr']; ?></em>
        </h3>

        <p>
            <!--Display post content-->
            <?= nl2br(htmlspecialchars($data['content'])); ?>
            <br />
            <em><a href="comments.php?post=<?= $data['id']; ?>">See this post</a></em>
        </p>
    </div>
    <?php
} // End of the post loop
$req->closeCursor();
?>
</body>
</html>
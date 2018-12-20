<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Comments</title>
</head>
<style>
    form
    {
        text-align:left;
    }
</style>
<body>

<form action="comments_post.php" method="post">
    <p>
        <label for="author">Pseudo</label> : <input type="text" name="author" id="author" /><br />
        <label for="content">Message</label> :  <input type="text" name="content" id="content" /><br />

        <input type="submit" value="Send" />
    </p>
</form>
<p>

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

    // Display last 10 messages
    $response = $db->query('SELECT author, content FROM comment ORDER BY ID DESC LIMIT 0, 10');

    // Display each comment (protected by htmlspecialchars)
    while ($data = $response->fetch())
    {
        echo '<p><strong>' . htmlspecialchars($data['author']) . '</strong> : ' . htmlspecialchars($data['content']) . '</p>';
    }

    $response->closeCursor();

    ?>

    <h1>Mon super blog !</h1>
    <p><a href="index.php">Retour à la liste des billets</a></p>

    <?php
    // Connexion à la base de données
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    // Récupération du billet
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post WHERE id = ?');
    $req->execute(array($_GET['post']));
    $data = $req->fetch();
    ?>

    <div class="news">
        <h3>
            <?php echo htmlspecialchars($data['title']); ?>
            <em>le <?php echo $data['creation_date_fr']; ?></em>
        </h3>

        <p>
            <?php
            echo nl2br(htmlspecialchars($data['content']));
            ?>
        </p>
    </div>

    <h2>Commentaires</h2>

    <?php
    $req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

    // Récupération des commentaires
    $req = $db->prepare('SELECT author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comment WHERE id_billet = ? ORDER BY creation_date');
    $req->execute(array($_GET['post']));

    while ($data = $req->fetch())
    {
        ?>
        <p><strong><?php echo htmlspecialchars($data['author']); ?></strong> le <?php echo $data['creation_date_fr']; ?></p>
        <p><?php echo nl2br(htmlspecialchars($data['comment'])); ?></p>
        <?php
    } // Fin de la boucle des commentaires
    $req->closeCursor();
    ?>

</p>
</body>
</html>

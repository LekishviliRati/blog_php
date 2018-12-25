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

        <h1>My blog </h1>
        <p><a href="index.php">Back to posts</a></p>

        <?php
        var_dump($_POST, $_GET);
        // Connect to Data Base
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        // Get post
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

        <h2>Comments</h2>

        <?php
        $req->closeCursor(); // Free Fetch();

        // Connect to Data Base
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

            // Get comments
            $req = $db->prepare('SELECT author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comment WHERE post_id = ?');
            $req->execute(array($_GET['post']));

            while ($data = $req->fetch())
            {
                ?>
                <p><strong><?php echo htmlspecialchars($data['author']); ?></strong> le <?php echo $data['creation_date_fr']; ?></p>
                <p><?php echo nl2br(htmlspecialchars($data['content'])); ?></p>
                <?php

        } // End of comments loop
        $req->closeCursor();
        ?>

            <h2>Leave your comments</h2>

            <form action="comments_post.php" method="post">
                <p>
                    <label for="author">Pseudo</label> : <input type="text" name="author" id="author" /><br />
                    <label for="content">Message</label> :  <input type="content" name="content" id="content" /><br />
                    <input type="hidden" name="post_id" value="<?php echo $_GET['post']?>"/>

                    <input type="submit" value="Submit" />
                </p>
            </form>
        </p>
    </body>
</html>

<?php
session_start();
$user_id = $_SESSION['id'];

?>

    <html>
    <head>
        <meta charset="utf-8" />
        <title>single post ADMIN</title>
    </head>

<body>

    <h1>Blog Post_Page</h1>
    <p><a href="posts_super_user.php">Back to posts</a></p>
<?php

if(isset($user_id)){

    //Connect to DB
    try {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // Get post
    if (is_numeric($_GET['post'])) {


        $req = $db->prepare('SELECT id, title, standfirst, content, update_date, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post WHERE id = ?');
        $req->execute(array($_GET['post']));
        $data = $req->fetch();
        if (is_array($data)) {

            ?>

            <div class="news">
                <h3>
                    <?= htmlspecialchars($data['title']); ?>
                    <br/>
                    <?= $data['standfirst']; ?>
                    <br/>
                    <p>
                        <?= nl2br(htmlspecialchars($data['content']));
                        ?>
                    </p>
                    <br/>
                    creation date: <?= $data['creation_date_fr']; ?>
                    <br/><br/>
                    <?php
                    // If no updatefor a post, don't display the update by default "0000-00-00 00:00:00"
                    if ($data['update_date'] != 0){
                        echo "update : " . ($data['update_date']);
                    }

                    ?>

                </h3>

            </div>
            <br/>
            <a href="delete_post.php?post=<?= $data['id']; ?>">Delete this post</a>
            <br/>

            <br/>
            <p> ---------------- COMMENTS ------------------- </p>


            <?php
            $req->closeCursor(); // Free Fetch();

            // Get comments
            $req = $db->prepare('SELECT author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comment WHERE post_id = ?');
            $req->execute(array($_GET['post']));
            while ($data = $req->fetch()) {
                ?>
                <p><strong><?= htmlspecialchars($data['author']); ?></strong>
                    creation date <?= $data['creation_date_fr']; ?></p>
                <p><?= nl2br(htmlspecialchars($data['content'])); ?></p>
                <?php

            } // End of comments loop
            $req->closeCursor();
        } else {
            echo "identifiant du post inexistant";
        }

    } else{
        echo "Valeur différent de entier";
    }

    ?>


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
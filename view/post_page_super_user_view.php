<html>
    <head>
        <meta charset="utf-8" />
        <title>single post ADMIN</title>
    </head>

<body>

    <h1>Blog Post_Page</h1>
    <p><a href="posts_super_user.php">Back to posts</a></p>
    <?php foreach ($posts as $Data): ?>
        <div class="news">
            <h3>
                <?= htmlspecialchars($Data['title']); ?>
                <br/>
                <?= $Data['standfirst']; ?>
                <br/>
                <p>
                    <?= nl2br(htmlspecialchars($Data['content']));
                    ?>
                </p>
                <br/>
                creation date: <?= $Data['creation_date_fr']; ?>
                <br/><br/>
                <?php
                // If no updatefor a post, don't display the update by default "0000-00-00 00:00:00"
                if ($Data['update_date'] != 0){
                    echo "update : " . ($Data['update_date']);
                }
                ?>

            </h3>

        </div>
        <br/>
        <a href="delete_post.php?post=<?= $Data['id']; ?>">Delete this post</a>
        <br/>

        <br/>

    <?php endforeach; ?>

    <p> ---------------- COMMENTS ------------------- </p>

    <?php foreach ($comments as $data): ?>

        <p><strong><?= htmlspecialchars($data['author']); ?></strong>
            creation date <?= $data['creation_date_fr']; ?></p>
        <p><?= nl2br(htmlspecialchars($data['content'])); ?></p>

    <?php endforeach; ?>



    </body>
</html>

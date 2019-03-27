
    <html>
        <head>
            <title> All comments</title>
            <meta charset="utf-8">
        </head>
        <body>
            <p>
            <a href="super_user_profile.php"> back<a/>
            </p>

            <div class="news">
                <?php foreach ($posts as $data): ?>
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

                <form method="POST" action="../delete_comment_super_user.php">
                    <input type="submit" name="delete_comment" value="Delete this comment">
                    <input type="hidden" name="comment_id" value="<?= $data['id'] ?>"/>
                </form>
            </div>
            <?php endforeach; ?>
        </body>
    </html>

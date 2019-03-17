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

        <?php foreach ($posts as $data): ?>
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
        <?php endforeach; ?>

    </body>
    </html>




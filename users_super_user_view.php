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

    <?php foreach ($posts as $data): ?>

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

    <?php endforeach; ?>

    </body>
</html>
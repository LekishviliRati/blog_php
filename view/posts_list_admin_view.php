<html>
<head>
    <title> My posts</title>
    <meta charset="utf-8">
</head>
<body>

<p>
    <a href="profile.php"> back<a/>
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
            <em>le <?= $data['creation_date_fr']; ?></em>
            <br/>
            <em><a href="post_page_admin.php?post=<?= $data['id']; ?>">See post</a></em>
        </p>
    </div>

<?php endforeach; ?>


</body>
</html>
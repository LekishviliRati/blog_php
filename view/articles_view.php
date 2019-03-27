

<html>
<head>
    <meta charset="utf-8" />
    <title> All Posts </title>
    <link href="public/css/style.css" rel="stylesheet" />
</head>

<body>

<h1> Posts_List</h1>

<a href="homepage.php"> Home Page </a>

    <?php foreach ($posts as $data): ?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']); ?> <br />
        </h3>

        <p>le <?= $data['creation_date_fr']; ?></p>

        <p>
            <?= nl2br(htmlspecialchars($data['content'])); ?><br />
        </p>

        <em><a href="article_page.php?post=<?= $data['id']; ?>">See this post</a></em>

    </div>
    <?php endforeach; ?>

</body>
</html>
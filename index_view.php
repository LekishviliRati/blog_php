<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title> All Posts </title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>

<h1> Posts_List</h1>

<a href="homepage.php"> Home Page </a>

    <?php foreach ($posts as $data): ?>
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
    <?php endforeach; ?>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Blog Post_Page</title>
</head>
<style>
    form
    {
        text-align:left;
    }
</style>
<body>

<h1>Blog Post_Page</h1>
<p><a href="articles.php">Back to posts</a></p>


<div class="news">
    <?php foreach ($posts as $Data): ?>

        <h3>
            <?= htmlspecialchars($Data['title']); ?>
            <em>le <?= $Data['creation_date_fr']; ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($Data['content']));?>
        </p>

    <?php endforeach; ?>

</div>

<h2>Comments</h2>

<?php foreach ($comments as $data): ?>

    <p><strong><?= htmlspecialchars($data['author']); ?></strong> le <?= $data['creation_date_fr']; ?></p>
    <p><?= nl2br(htmlspecialchars($data['content'])); ?></p>

<?php endforeach; ?>



<h2>Leave your comments</h2>
<form action="comments_post.php" method="post">
    <p>
        <label for="author">Pseudo</label> : <input type="text" name="author" id="author" /><br />
        <label for="content">Message</label> :  <input type="content" name="content" id="content" /><br />
        <input type="hidden" name="post_id" value="<?=$_GET['post']?>"/>
        <input type="hidden" name="user_id" value="<?= $Data['user_id']?>">

        <input type="submit" value="Submit" name="submit_comment"/>
    </p>
</form>


</p>
</body>
</html>

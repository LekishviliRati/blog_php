<html>
    <head>
        <title> All comments</title>
        <meta charset="utf-8">
    </head>
    <body>
    <p><a href="profile.php"> back<a/></p>
    <div class="news">

        <?php foreach ($posts as $data): ?>

        <h3>Auteur : <?= htmlspecialchars($data['author']); ?></h3>
        <p>Post id :  <?= htmlspecialchars($data['post_id']); ?><p>
            <p>Status :

            <?php if ($data['status'] == 0) {

                echo "Non published";
            }else {
                echo "Published";
            } ?>
            </p>
        <p>
            content :  <?= nl2br(htmlspecialchars($data['content'])); ?>
            <br/>
            <em>le <?= $data['creation_date_fr']; ?></em>
            <br/>
        <form method="POST" action="validate_comment_admin.php">
            <input type="submit" name="accept_comment" value="Publish this comment">
            <input type="hidden" name="comment_id" value="<?= $data['id'] ?>"/>
        </form>
        <form method="POST" action="delete_comment_admin.php">
            <input type="submit" name="delete_comment" value="Delete this comment">
            <input type="hidden" name="comment_id" value="<?= $data['id'] ?>"/>
        </form>
    </div>
    <?php endforeach; ?>

</body>
    </html>



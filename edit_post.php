<?php
session_start();
$user_id = $_SESSION['id'];

// check with 'id'if user is connected or not.
if (isset($user_id)){

//Connect to DB
    try {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    //Display connected user's posts
    $req_user = $db->prepare("SELECT * FROM post WHERE id=?");
    $req_user->execute(array($_GET['post']));
    $user = $req_user->fetch();

    // Update title
    if (isset($_POST['new_title']) AND !empty($_POST['new_title']) AND $_POST['new_title'] != $user['title'])
    {
        $new_title = htmlspecialchars($_POST['new_title']);
        $insert_title = $db->prepare("UPDATE post SET title = ?, update_date = NOW() WHERE id = ?");
        $insert_title->execute(array($new_title, $_GET['post']));
        header('Location: post_page_admin.php?post='.$_GET['post']);
    }

    // Update Standfirst
    if (isset($_POST['new_standfirst']) AND !empty($_POST['new_standfirst']) AND $_POST['new_standfirst'] != $user['standfirst'])
    {
        $new_standfirst = htmlspecialchars($_POST['new_standfirst']);
        $insert_standfisrt = $db->prepare("UPDATE post SET standfirst = ?, update_date = NOW() WHERE id = ?");
        $insert_standfisrt->execute(array($new_standfirst, $_GET['post']));
        header('Location: post_page_admin.php?post='.$_GET['post']);
    }

    // Update Content
    if (isset($_POST['new_content']) AND !empty($_POST['new_content']) AND $_POST['new_content'] != $user['content'])
    {
        $new_content = htmlspecialchars($_POST['new_content']);
        $insert_content = $db->prepare("UPDATE post SET content = ?, update_date = NOW() WHERE id = ?");
        $insert_content->execute(array($new_content, $_GET['post']));
        header('Location: post_page_admin.php?post='.$_GET['post']);
    }

?>

    <html>
    <head>
        <title> </title>
        <meta charset="utf-8">
    </head>

    <p><a href="post_page_admin.php?post=<?= $_GET['post'] ?>"> Back to post </a></p>
    <body>
    <div align="center">
        <h2>Edit my post</h2>
        <form method="POST" action="">
            <table> <br />
                <tr>
                    <td align="right">
                        <label for="new_title" >Title : </label>
                        <input type="text" name="new_title" id="new_title" placeholder="New title" value="<?= $user['title']?>"/><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="new_standfirst" >Standfirst :</label>
                        <input type="text" name="new_standfirst" id="new_standfirst" placeholder="New standfirst" value="<?= $user['standfirst']?>"/><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="new_content" >Content :</label>
                        <input type="text" name="new_content" id="new_content" placeholder="New content" value="<?= $user['content']?>" /><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right"><br />
                        <input type="submit" value="Update my post">
                    </td>
                </tr>
            </table>
        </form>
        <?php if(isset($message)){echo $message;} ?>

    </div>
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
<?php
session_start();
$user_id = $_SESSION['id'];

if (isset($user_id)){

    //Connect to DB
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    //If user clic on button "delete post"
    if(isset($_POST['delete_post'])) {
        $post_to_delete = htmlspecialchars($_GET['post']);
        $delete_post = $db->prepare("DELETE FROM post WHERE id = ?");
        $delete_post->execute(array($post_to_delete));
        $message ="Your post was succesfully deleted <a href=\"posts_list_admin.php\"> See my posts<a/>";
    }

    else{
    echo "you are not connected";
}
?>

<html>
<head>
    <title> Add posts</title>
    <meta charset="utf-8">
</head>

<body>

<div align="left">
    <h2>Please confirm to delete this post </h2>
    <form method="POST" action="">
        <table>
            <tr>
                <td align="right"><br />
                    <input type="submit" name="delete_post" value="Delete this post !">
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
<?php
session_start();
$user_id = $_SESSION['id'];

if (isset($user_id) == 14){

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
    if(isset($_POST['delete_user'])) {
        //super user delete 1 user
        $user_to_delete = htmlspecialchars($_GET['post']);
        $delete_user = $db->prepare("DELETE FROM user WHERE id = ?");
        if ($delete_user->execute(array($user_to_delete))){
            //if super user deletes 1 user his posts must be deleted too
            $delete_user_posts = $db->prepare("DELETE FROM post WHERE user_id = ?");
            if ($delete_user_posts->execute(array($user_to_delete))){
                //if user's posts are deleted comments associated must be deleted too
                $delete_user_comments = $db->prepare("DELETE FROM comment WHERE author_id = ?");
                if ($delete_user_comments->execute(array($user_to_delete))){
                    $message = "User was succesfully deleted <a href=\"users_super_user.php\"> See all users <a/>";
                }else{
                    echo "impossible to delete user's comment's because there is no comments do delete";
                }
            }else{
                echo "impossible to delete user's posts, because there is any posts to delete";
            }
        }else {
            echo "Impossible to delete this user";
        }
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
                        <input type="submit" name="delete_user" value="Delete this post !">
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
<?php
session_start();
$user_id = $_SESSION['id'];

require('model/frontend.php');

if (isset($user_id) == 14){

    $db = dbConnect();

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

} else {
    echo "Access Denied ! ";
    ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}

require_once ('view/delete_user_view.php');
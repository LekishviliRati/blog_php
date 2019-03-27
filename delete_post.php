<?php
session_start();
$user_id = $_SESSION['id'];

require('model/frontend.php');

if (isset($user_id)){

    $db = dbConnect();

    //If user clic on button "delete post"
    if(isset($_POST['delete_post'])) {
        $post_to_delete = htmlspecialchars($_GET['post']);
        $delete_post = $db->prepare("DELETE FROM post WHERE id = ?");
        if ($delete_post->execute(array($post_to_delete))){
            $delete_user_comments = $db->prepare("DELETE FROM comment WHERE author_id = ?");
            if ($delete_user_comments->execute(array($post_to_delete))){
                $message ="Your post was succesfully deleted <a href=\"posts_list_admin.php\"> See my posts<a/>";
            }else{
                $message ="Not possible to delete comments";
            }
        }else{
            $message ="Not possible to delete posts";
        }

    if(isset($user_id) == 14){
        $post_to_delete = htmlspecialchars($_GET['post']);
        $delete_post = $db->prepare("DELETE FROM post WHERE id = ?");
        if ($delete_post->execute(array($post_to_delete))) {
            $delete_user_comments = $db->prepare("DELETE FROM comment WHERE author_id = ?");
            if ($delete_user_comments->execute(array($post_to_delete))) {
                $message ="Your post was succesfully deleted <a href=\"posts_super_user.php\"> See posts<a/>";
            }else{
                $message ="Not possible to delete comments";
            }
        }else{
            $message ="Not possible to delete posts";
        }
    } else{
        $message ="please clic on submit button";
    }

}else{
    $message ="please clic on submit button";
}

    } else {
        echo "Access Denied ! ";
        ?>
        <a href="sign_in.php" > Log In !</a>
        <?php
    }

require_once ('view/delete_post_view.php');
<?php
session_start();
$user_id = $_SESSION['id'];
require('model/frontend.php');

if (isset($user_id)){ //Check if user is connected to let him add one post

    $db = dbConnect();

    //Display posts of connected user
    $req_user = $db->prepare("SELECT * FROM user WHERE id=?");
    $req_user->execute(array($user_id));
    $user = $req_user->fetch();

    if(isset($_POST['add_post'])) // if user click to button "add post"

        {
            if(!empty($_POST['title']) AND ($_POST['standfirst']) AND ($_POST['content']))
            {
                $title = htmlspecialchars($_POST['title']);
                $standfirst = htmlspecialchars($_POST['standfirst']);
                $content = htmlspecialchars($_POST['content']);

                //check if title exist or not yet
                $req_title = $db->prepare("SELECT * FROM post WHERE title = ?");
                $req_title->execute(array($title));
                $title_exist = $req_title->rowCount();

                if ($title_exist == 0)
                {
                    //check if standfirst exist or not yet
                    $req_standfirst = $db->prepare("SELECT * FROM post WHERE standfirst = ?");
                    $req_standfirst->execute(array($standfirst));
                    $standfirst_exist= $req_standfirst->rowCount();
                    if ($standfirst_exist == 0)

                    {
                        $insert_post = $db->prepare("INSERT INTO post(title, content, standfirst, user_id, creation_date) VALUES(?, ?, ?, ?, NOW())");
                        $insert_post->execute(array($title, $content, $standfirst, $user_id));
                        $message ="Your post was succesfully registered <a href=\"posts_list_admin.php\"> See my posts<a/>";
                    }
                    else
                    {
                        $message = "Standfirst already exist";
                    }
                }
                else
                {
                    $message = "Title already exist";
                }
            }
            else
            {
                $message = "Please complete all the required fields";
            }
        }

require_once('view/add_post_view.php');
 // mask all content of the page to visitors because it's dedicated to connected users
} else {
    echo "Access Denied ! ";
    ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}
?>
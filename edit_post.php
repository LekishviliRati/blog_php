<?php
session_start();
$user_id = $_SESSION['id'];

require('model/frontend.php');

// check with 'id'if user is connected or not.
if (isset($user_id)){

    $db = dbConnect();

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

} else {
    echo "Access Denied ! ";
    ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}

require_once('view/edit_post_view.php');
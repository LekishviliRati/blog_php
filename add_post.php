<?php
session_start();
$user_id = $_SESSION['id'];

if (isset($user_id)){ //Check if user is connected to let him add one post

    //Connect to DB
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

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

?>


<html>
<head>
    <title> Add posts</title>
    <meta charset="utf-8">
</head>

<body>

<div align="left">
    <h2>Add New Post ! </h2>
    <form method="POST" action="">
        <table>



            <tr>
                <td align="right">
                    <label for="title"> Title :</label>
                    <input type="text" name="title" id="title" placeholder="Title" /><br /><br />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="standfirst"> standfirst :</label>
                    <input type="text" name="standfirst" id="standfirst" placeholder="standfirst" /><br /><br />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="content"> content :</label>
                    <input type="text" name="content" id="content" placeholder="content" /><br /><br />
                </td>
            </tr>
            <tr>
                <td align="right"><br />
                    <input type="submit" name="add_post" value="Add this post !">
                    <input type="hidden" name="user_id" value="<?= $_POST['user_id'] ?>"/>
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
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>

<body>

<p><a href="sign_in.php"> Back to Sign In</a></p>
<p> FORGOT YOUR PASSWORD ? </p> <br />

<?php if ($section == 'code') { ?>
    Reset code was sent to you by mail <?= $_SESSION['retrieve_mail']?>
    <br /><br />
    <form method="post" action="">
        <input type="text" placeholder="Check code you just received by mail" name="check_code"><br /><br />
        <input type="submit" value="Confirm" name="check_submit">
    </form>

    <?php } elseif($section == "changepassword") { ?>
    New password for <?= $_SESSION['retrieve_mail']?>
    <br /><br />
    <form method="post" action="">
        <input type="password" placeholder="New Password" name="change_password"><br /><br />
        <input type="password" placeholder="Confirm New Password" name="change_password_confirmation"> <br /><br />
        <input type="submit" value="Confirm" name="change_password_submit">
    </form>

<?php } else { ?>

    <form method="post" action="">
        <input type="email" placeholder="Your mail" name="retrieve_mail"><br /><br />
        <input type="submit" value="Confirm" name="retrieve_submit">
    </form>

<?php } ?>
<br />
<?php if (isset($message)) { echo '<span style="color:#ff0703">' .$message.'</span>';}?>

</body>

</html>
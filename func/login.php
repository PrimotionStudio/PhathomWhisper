<?php
require_once("../partials/session.php");
require_once("../partials/sql.php");
require_once("../partials/token.php");
$stat = 0;
$msg = "An error occured!";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $form_token = $_POST["token"];
    if ($token == $form_token) {
        $selectacc = "SELECT id, name, password FROM accounts WHERE email='$email'";
        $queryacc = mysqli_query($con, $selectacc);
        if (mysqli_num_rows($queryacc) != 0) {
            $getacc = mysqli_fetch_assoc($queryacc);
            $hasedpwd = $getacc["password"];
            if (password_verify($password, $hasedpwd)) {
                $userid = $getacc["id"];
                $loginkey = password_hash(time(), PASSWORD_BCRYPT);
                $_SESSION["userid"] = $userid;
                $_SESSION["loginkey"] = $loginkey;
                $insertloginkey = "UPDATE accounts SET loginkey='$loginkey' WHERE id='$userid'";
                mysqli_query($con, $insertloginkey);
                $stat = 1;
                $msg = "Login Successful!<br>Welcome to ".$getacc["name"]."'s chat room 😊";
            } else {
                $msg = "Incorrect Login Credentials!...";
            }
        } else {
            $msg = "Incorrect Login Credentials!...";
        }
    } else {
        $msg = "An error occured! Please try again later...";
    }
} else {
    $msg = "An error occured! Please try again later...";
}
if ($stat == 1) {
?>
<div class='alert alert-success text-center mb-4' role='alert'><?= $msg ?></div>
<?php
} else {
?>
<div class="alert alert-danger text-center mb-4" role="alert"><?= $msg ?></div>
<?php
}
?>
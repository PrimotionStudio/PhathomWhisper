<?php
require_once("../partials/session.php");
require_once("../partials/sql.php");
require_once("../partials/ip.php");
require_once("../partials/token.php");
$stat = 0;
$msg = "An error occured!";

function clean($data) {
    $data = htmlspecialchars(str_replace("`", "\`", (str_replace("'", "\'", stripslashes(trim($data))))));
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = clean(ucfirst($_POST["name"]));
    $email = clean($_POST["email"]);
    $phone = clean($_POST["phone"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    $form_token = $_POST["token"];
    if ($token == $form_token) {
        $selectacc = "SELECT chatid FROM accounts WHERE email='$email'";
        $queryacc = mysqli_query($con, $selectacc);
        if (mysqli_num_rows($queryacc) == 0) {
            if ($password == $confirm) {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                while (1 == 1) {
                    $chatid = bin2hex(random_bytes(16));
                    $selectchatid = "SELECT chatid FROM accounts WHERE chatid='$chatid'";
                    $querychatid = mysqli_query($con, $selectchatid);
                    if (mysqli_num_rows($querychatid) == 0) {
                        break;
                    }
                }
                $insertchatroom = "INSERT INTO accounts (name, email, phone, chatid, password) VALUES ('$name', '$email', '$phone', '$chatid', '$hash')";
                if (mysqli_query($con, $insertchatroom)) {
                    $stat = 1;
                    $msg = $_POST["name"]." chat room created successfully!";
                } else {
                    $msg = "An error occured! Please try again later...";
                }

            } else {
                $msg = "Passwords do not match!";
            }
        } else {
            $msg = "This email is already registered in our database...";
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
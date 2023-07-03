<?php
require_once("../partials/session.php");
require_once("../partials/sql.php");
require_once("validate_login.php");
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
    $bio = clean($_POST["bio"]);
    $linkstat = clean($_POST["linkstat"]);
    $form_token = $_POST["token"];
    if ($token == $form_token) {
        $updateroom = "UPDATE accounts SET name='$name', email='$email', phone='$phone', bio='$bio', linkstat='$linkstat' WHERE id='$userid'";
        if (mysqli_query($con, $updateroom)) {
            $stat = 1;
            $msg = "Profile edited successfully!";
        } else {
            $msg = "An error occured! Please try again later...";
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
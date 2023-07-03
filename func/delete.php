<?php
require_once("../partials/session.php");
require_once("../partials/sql.php");
require_once("validate_login.php");
require_once("../partials/token.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msgid = $_POST["msgid"];
    $form_token = $_POST["token"];
    if ($token == $form_token) {
        $deletemsg = "UPDATE messages SET deleted='true' WHERE ip='$ip' && id='$msgid'";
        mysqli_query($con, $deletemsg);
    } else {
        echo "Message Not Sent";
    }
}
header("location: ".$_SERVER["HTTP_REFERER"]);
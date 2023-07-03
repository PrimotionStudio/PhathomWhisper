<?php
require_once("../partials/session.php");
require_once("../partials/sql.php");
require_once("validate_login.php");
require_once("../partials/ip.php");
require_once("../partials/token.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msgid = $_POST["msgid"];
    $form_token = $_POST["token"];
    if ($token == $form_token) {
        if ($_POST["msg"] != "") {
            $msg = htmlspecialchars(str_replace("`", "\`", (str_replace("'", "\'", stripslashes(trim($_POST["msg"]))))));
            $insertmsg = "INSERT INTO messages (ip, token, chatid, message, replyto) VALUES ('$ip', '$token', '$chatid','$msg', '$msgid')";
            if (mysqli_query($con, $insertmsg)) {
                echo "Message Sent";
            } else {
                echo "Message Not Sent";
            }
        } else {
            echo "Message Not Sent";
        }
    } else {
        echo "Message Not Sent";
    }
} else {
    echo "Message Not Sent";
}
header("location: ".$_SERVER["HTTP_REFERER"]);
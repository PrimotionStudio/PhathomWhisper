<?php
require_once("../partials/session.php");
require_once("../partials/sql.php");
require_once("validate_login.php");
require_once("../partials/ip.php");
require_once("../partials/token.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_token = $_POST["token"];
    if ($token == $form_token) {
        $msg = htmlspecialchars(str_replace("`", "\`", (str_replace("'", "\'", stripslashes(trim($_POST["msgtxt"]))))));
        $insertmsg = "INSERT INTO messages (ip, token, message) VALUES ('$ip', '$token', '$msg')";
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
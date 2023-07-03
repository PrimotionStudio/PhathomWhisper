<?php
require_once("../partials/session.php");
require_once("../partials/sql.php");
require_once("validate_login.php");
require_once("../partials/ip.php");
require_once("../partials/token.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_token = $_POST["token"];
    if ($token == $form_token) {
        $error = 0;
        if ($_FILES['media']["name"] != "") {
            $file_name = $_FILES['media']['name'];
            $file_size = $_FILES['media']['size'];
            $file_tmp = $_FILES['media']['tmp_name'];
            $dot = explode('.', $file_name);
            $file_ext = strtolower(end($dot));
            if (($file_size < (10 * 1024 * 1024)) && ($file_size >= 0)) {
                $new_file_name = "../uploads/file" . date("YmdhisA") . $token . "." . $file_ext;
                move_uploaded_file($file_tmp, $new_file_name);
                $file = str_replace("../", "", $new_file_name);
            } else {
                $error = 1;
                $_SESSION["alert"] = "Sorry, your file is too large";
            }
        } else {
            $error = 1;
            $_SESSION["alert"] =  "Sorry, An error occured while uploading your file";
        }
        if ($error == 0) {
    
            $insertmsg = "INSERT INTO messages (ip, token, file) VALUES ('$ip', '$token', '$file')";
            mysqli_query($con, $insertmsg);
        }
    } else {
        echo "Message Not Sent";
    }
}

header("location: ".$_SERVER["HTTP_REFERER"]);
?>
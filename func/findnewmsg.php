<?php
require_once("../partials/session.php");
require_once("../partials/sql.php");
require_once("validate_login.php");
if (!isset($_SESSION["totalmsg"])) {
    $_SESSION["totalmsg"] = 0;
}
$selectmsg = "SELECT * FROM messages WHERE deleted='false'";
$querymsg = mysqli_query($con, $selectmsg);
$num_rows = mysqli_num_rows($querymsg);
if ($num_rows != $_SESSION["totalmsg"]) {
    $_SESSION["totalmsg"] = $num_rows;
    echo "New message arrived";
}

<?php
if (!isset($_SESSION["token"])) {
    $token = bin2hex(random_bytes(16));
    $_SESSION["token"] = $token;
} else {
    $token = $_SESSION["token"];
}
?>
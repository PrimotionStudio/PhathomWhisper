<?php
require_once("../partials/session.php");
require_once("../partials/sql.php");
require_once("validate_login.php");
require_once("time_ago.php");
require_once("../partials/ip.php");

function truncate_text($text)
{
    if (strlen($text) > 15) {
        $text = substr($text, 0, 10) . '...' . substr($text, -5);
    }
    return $text;
}

function getuser($chat, $con) {
    $selectuser = "SELECT * FROM accounts WHERE chatid='$chat'";
    $queryuser = mysqli_query($con, $selectuser);
    if (mysqli_num_rows($queryuser) > 0) {
        $getuser = mysqli_fetch_assoc($queryuser);
    }
    return $getuser["name"];
}
$selectmsg = "SELECT * FROM messages WHERE deleted != 'true' ORDER BY id ASC";
$querymsg = mysqli_query($con, $selectmsg);

?>

<div class="flex-grow-1 overflow-hidden">
    <h5 class="text-truncate font-size-15 mb-1"><?= isset($getuser["name"]) ? $getuser["name"] : getuser($_SESSION["chat"], $con) ?></h5>
    <?php
    $lastMessage = null;
    
    while ($msgarr = mysqli_fetch_assoc($querymsg)) {
        $lastMessage = $msgarr;
    }
    
    if ($lastMessage) {
        if (empty($lastMessage["file"])) {
            $text = $lastMessage["message"];
            
            if (strlen($text) > 40) {
                $text = substr($text, 0, 40) . "...";
            }
            
            echo "<p class='chat-user-message text-truncate mb-0'>$text</p>";
        } else {
            $dot = explode('.', $lastMessage["file"]);
            $file_ext = strtolower(end($dot));
            $extensions = array("jpeg", "jpg", "png", "svg");
            
            if (in_array($file_ext, $extensions)) {
                echo "<img src='{$lastMessage['file']}' alt='' width='50px' height='50px' style='object-fit: contain' class='rounded border img-thumbnail'>";
            } else {
                $filename = str_replace("uploads/", "", $lastMessage['file']);
                echo "<div class='avatar-title bg-soft-primary text-primary rounded font-size-20' style='width:50px !important; height:50px !important;'>
                        <i class='ri-file-text-fill'></i>
                      </div>
                      <b>" . truncate_text($filename) . "</b>";
            }
        }
    }
    ?>
</div>
<div class="font-size-11"><?= isset($lastMessage["date_time"]) ? time_ago(strtotime($lastMessage["date_time"])) : '' ?></div>

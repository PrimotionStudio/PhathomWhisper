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

if (isset($_SESSION["chat"])) {
    $chatid = $_SESSION["chat"];
}
$selectmsg = "SELECT * FROM messages WHERE deleted!='true' AND chatid='$chatid' ORDER BY id DESC";
$querymsg = mysqli_query($con, $selectmsg);

while ($msgarr = mysqli_fetch_assoc($querymsg)) {
?>

    <li id="msg<?= $msgarr["id"] ?>" <?php
        if ($ip == $msgarr["ip"]) {
            echo "class='right'";
        }
        ?>>
        <div class="conversation-list">

            <div class="user-chat-content">
                <div class="ctext-wrap">
                    <div class="ctext-wrap-content">
                        <?php
                        if ($msgarr["replyto"] != "") {

                            $selectrep = "SELECT * FROM messages WHERE id='" . $msgarr["replyto"] . "' AND chatid='$chatid' ORDER BY id ASC";
                            $queryrep = mysqli_query($con, $selectrep);

                            while ($rep = mysqli_fetch_assoc($queryrep)) {
                                $reparr = $rep;
                            }
                        ?>
                            <div class="reply-from" style="border-left: 5px solid #7269ef; padding-left: 10px;" onclick='location.assign("#msg<?= $msgarr["id"] ?>")'>
                                <span class="reply-from-message">
                                    <?php
                                    if ($reparr["deleted"] == "true") {
                                        echo "<i class='ri-delete-bin-2-fill'></i>&nbsp;&nbsp;<sub style='text-decoration: underline'><b>this content was deleted</b></sub>";
                                    } else {
                                        if ($reparr["file"] == "") {
                                            echo $reparr["message"];
                                        } else {
                                            $dot = explode('.', $reparr["file"]);
                                            $file_ext = strtolower(end($dot));
                                            $extensions = array("jpeg", "jpg", "png", "svg");
                                            if (in_array($file_ext, $extensions)) {
                                    ?>
                                                <img src='<?= $reparr['file'] ?>' alt='' width="100px" height="100px" style="object-fit: contain" class='rounded border img-thumbnail'>
                                            <?php
                                            } else {
                                            ?>
                                                <div class='avatar-title bg-soft-primary text-primary rounded font-size-20'>
                                                    <i class='ri-file-text-fill'></i>
                                                </div>
                                                <?= truncate_text(str_replace("uploads/", "", $reparr['file'])) ?>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </span>
                                <hr>
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if ($msgarr["file"] != "") {
                            $dot = explode('.', $msgarr["file"]);
                            $file_ext = strtolower(end($dot));
                            $extensions = array("jpeg", "jpg", "png", "svg");
                            if (in_array($file_ext, $extensions)) {
                        ?>
                                <ul class='list-inline message-img  mb-0'>

                                    <li class='list-inline-item message-img-list me-2 ms-0'>
                                        <div>
                                            <a class='popup-img d-inline-block m-1' href='#<?= $msgarr['file'] ?>' title='<?= time_ago(strtotime($msgarr["date_time"])) ?>'>
                                                <img src='<?= $msgarr['file'] ?>' alt='' class='rounded border'>
                                            </a>
                                        </div>
                                        <div class='message-img-link'>
                                            <ul class='list-inline mb-0'>
                                                <li class='list-inline-item'>
                                                    <a download='<?= str_replace("uploads/", "", $msgarr['file']) ?>' href='<?= $msgarr['file'] ?>' class='fw-medium'>
                                                        <i class='ri-download-2-line'></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>


                                </ul>

                            <?php
                            } else {
                            ?>

                                <div class='card p-2 mb-2'>
                                    <div class='d-flex flex-wrap align-items-center attached-file'>
                                        <div class='avatar-sm me-3 ms-0 attached-file-avatar'>
                                            <div class='avatar-title bg-soft-primary text-primary rounded font-size-20'>
                                                <i class='ri-file-text-fill'></i>
                                            </div>
                                        </div>
                                        <div class='flex-grow-1 overflow-hidden'>
                                            <div class='text-start'>
                                                <h5 class='font-size-14 text-truncate mb-1'><?= truncate_text(str_replace("uploads/", "", $msgarr['file'])) ?></h5>
                                            </div>
                                        </div>
                                        <div class='ms-4 me-0'>
                                            <div class='d-flex gap-2 font-size-20 d-flex align-items-start'>
                                                <div>
                                                    <a download='<?= str_replace("uploads/", "", $msgarr['file']) ?>' href='<?= $msgarr['file'] ?>' class='fw-medium'>
                                                        <i class='ri-download-2-line'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }

                        ?>
                        <p class="mb-0">
                            <?= $msgarr["message"] ?>
                        </p>
                        <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle"><?= time_ago(strtotime($msgarr["date_time"])) ?></span></p>
                    </div>
                    <div class="dropdown align-self-start">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-more-2-fill"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#reply<?= $msgarr["id"] ?>">Reply <i class="ri-reply-line float-end text-muted"></i></a>
                            <?php
                            if ($ip == $msgarr["ip"]) {
                            ?>
                                <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete<?= $msgarr["id"] ?>">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>

<?php
}
$conn = null;
?>
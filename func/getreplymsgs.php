<?php
require_once("../partials/session.php");
require_once("../partials/sql.php");
require_once("validate_login.php");
require_once("../partials/token.php");
function truncate_text($text)
{
    if (strlen($text) > 15) {
        $text = substr($text, 0, 10) . '...' . substr($text, -5);
    }
    return $text;
}
$selectmsg = "SELECT * FROM messages WHERE deleted!='true' AND chatid='$chatid' ORDER BY id DESC";
$querymsg = mysqli_query($con, $selectmsg);
while ($msgarr = mysqli_fetch_assoc($querymsg)) {
?>
    <div class="modal" id="reply<?= $msgarr["id"] ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="func/reply" method="POST">
                    <input type="hidden" name="token" id="token" value="<?= $token ?>">
                    <input type="hidden" name="msgid" id="msgid" value="<?= $msgarr["id"] ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Reply to: <i>

                                <?php
                                if ($msgarr["file"] == "") {
                                    $text = $msgarr["message"];
                                    if (strlen($text) > 40) {
                                        $text = substr($text, 0, 40) . "...";
                                    }
                                    echo $text;
                                } else {
                                    $dot = explode('.', $msgarr["file"]);
                                    $file_ext = strtolower(end($dot));
                                    $extensions = array("jpeg", "jpg", "png", "svg");
                                    if (in_array($file_ext, $extensions)) {
                                ?>
                                        <img src='<?= $msgarr['file'] ?>' alt='' width="50px" height="50px" style="object-fit: contain" class='rounded border img-thumbnail'>
                                    <?php
                                    } else {
                                    ?>
                                        <div class='avatar-title bg-soft-primary text-primary rounded font-size-20' style="width:50px !important; height:50px !important;">
                                            <i class='ri-file-text-fill'></i>
                                        </div>
                                        <b><?= truncate_text(str_replace("uploads/", "", $msgarr['file'])) ?></b>
                                <?php
                                    }
                                }
                                ?>
                                <?php
                                // if ($msgarr["file"] == "") {
                                //     echo $msgarr["message"];
                                // } else {
                                //     echo truncate_text(str_replace("uploads/", "", $msgarr['file']));
                                // }
                                ?>
                            </i>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="msg" id="msg" class="form-control" required />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Reply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>
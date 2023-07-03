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
$selectmsg = "SELECT * FROM messages WHERE deleted!='true' ORDER BY id DESC";
$querymsg = mysqli_query($con, $selectmsg);
while ($msgarr = mysqli_fetch_assoc($querymsg)) {
    if ($_SERVER["REMOTE_ADDR"] == $msgarr["ip"]) {
?>
        <div class="modal" id="delete<?= $msgarr["id"] ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure you want to delete this?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

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
                    </div>
                    <div class="modal-footer">
                        <form action="func/delete" method="post">
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <input type="hidden" name="msgid" value="<?= $msgarr["id"] ?>">
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>
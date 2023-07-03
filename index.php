<?php
require_once("partials/session.php");
require_once("partials/sql.php");
require_once("func/validate_login.php");
require_once("func/time_ago.php");
require_once("partials/ip.php");
require_once("partials/token.php");
require_once("partials/alert.php");
require_once("partials/head.php");
?>
<style>
    .reply-from {
        font-weight: bold;
    }

    .reply-from-message {
        font-style: italic;
        font-weight: normal;
    }
</style>
<div class="layout-wrapper d-lg-flex">
    <?php
    include "partials/leftsidebar.php";
    include "partials/chat-leftsidebar.php";
    ?>

    <!-- Start User chat -->
    <div class="user-chat w-100 overflow-hidden user-chat-show">
        <div class="d-flex">

            <!-- start chat conversation section -->
            <div class="w-100 overflow-hidden position-relative">
                <?php
                include "partials/header.php";
                ?>

                <!-- start chat conversation -->
                <div class="chat-conversation p-3 p-lg-4" data-simplebar="init">
                    <ul id="msgbox" class="list-unstyled mb-0">

                    </ul>

                </div>
                <!-- end chat conversation end -->


                <!-- start chat input section -->
                <div class="chat-input-section p-3 p-lg-4 border-top mb-0">
                    <form onsubmit="sendmsg()" autocomplete="off">
                        <div class="row g-0">
                            <div class="col">
                                <input type="hidden" name="token" id="token" value="<?= $token ?>">
                                <input type="text" name="msg" id="msg" onfocus="" class="form-control form-control-lg bg-light border-light" placeholder="Enter Message...">
                            </div>
                            <div class="col-auto">
                                <div class="chat-input-links ms-md-2 me-md-0">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Attach a File">
                                            <button type="button" name="attachment" data-bs-toggle="modal" data-bs-target="#uploadModal" class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect">
                                                <i class="ri-attachment-line"></i>
                                            </button>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="submit" class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light">
                                                <i class="ri-send-plane-2-fill"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- end chat input section -->
            </div>
            <!-- end chat conversation section -->
        </div>
        <!-- End User chat -->

    </div>
    <!-- end  layout wrapper -->

    <!-- The Modal -->
    <div class="modal" id="uploadModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- <form onsubmit="upload()" autocomplete="off"> -->
                <form action="func/upload" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="token" id="token" value="<?= $token ?>">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Upload Media File</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="file" name="media" class="form-control" required />
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div id="getdelmsgs"></div>
    <div id="getreplymsgs"></div>
    <?php
    include "partials/footer.php";
    ?>
<!-- start chat-leftsidebar -->
<div class="chat-leftsidebar me-lg-1 ms-lg-0">

    <div class="tab-content">

        <!-- Start Profile tab-pane -->
        <div class="tab-pane" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
            <!-- Start profile content -->
            <div>
                <div class="px-4 pt-4">
                    <h4 class="mb-0">Profile</h4>
                </div>

                <div class="text-center p-4 border-bottom">
                    <div class="mb-4">
                        <img src="<?= $getuser["picture"] ?>" class="rounded-circle avatar-lg img-thumbnail" alt="">
                    </div>

                    <h5 class="font-size-16 mb-1 text-truncate"><?= $getuser["name"] ?></h5>
                    <small class="text-muted text-truncate mb-1">Phanthom Whisper by Primotion Studio</small>
                </div>
                <!-- End profile user -->

                <!-- Start user-profile-desc -->
                <div class="p-4 user-profile-desc" data-simplebar>
                    <div class="text-muted">
                        <p class="mb-4"><?= $getuser["bio"] ?></p>
                    </div>


                    <div id="tabprofile" class="accordion">
                        <?php
                        if (isset($_SESSION["userid"]) && isset($_SESSION["loginkey"])) {
                        ?>
                        <div class="card accordion-item border mb-2">
                            <div class="accordion-header" id="profile2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profile" aria-expanded="true" aria-controls="profile">
                                    <h5 class="font-size-14 m-0">
                                        <i class="ri-user-2-line me-2 ms-0 ms-0 align-middle d-inline-block"></i> Profile: Your Information
                                    </h5>
                                </button>
                            </div>
                            <div id="profile" class="accordion-collapse collapse show" aria-labelledby="profile2" data-bs-parent="#tabprofile">
                                <div class="accordion-body">
                                    <div class="p-3">
                                        <div id="alert"></div>
                                        <form onsubmit="editprofile()" autocomplete="off">
                                            <input type="hidden" name="token" id="token" value="<?= $token ?>">
                                            <div class="mb-3">
                                                <label class="form-label">Name:</label>
                                                <input type="text" class="form-control form-control-lg bg-light border-light" placeholder="Enter The Chat Room's Name" id="name" aria-label="Enter Room's New Name" value="<?= $getuser["name"] ?>" aria-describedby="basic-addon5">
                                            </div>
        
                                            <div class="mb-3">
                                                <label class="form-label">Email:</label>
                                                <input type="email" class="form-control form-control-lg bg-light border-light" placeholder="Enter Your Email" id="email" aria-label="Enter Your Email" value="<?= $getuser["email"] ?>" aria-describedby="basic-addon5">
                                            </div>
            
                                            <div class="mb-3">
                                                <label class="form-label">Phone:</label>
                                                <input type="tel" class="form-control form-control-lg bg-light border-light" placeholder="Enter Your Phone Number" id="phone" aria-label="Enter Your Phone Number" value="<?= $getuser["phone"] ?>" aria-describedby="basic-addon5">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Bio:</label>
                                                <textarea id="bio" cols="30" rows="3" class="form-control form-control-lg bg-light border-light" placeholder="Enter Your Phone Number" id="phone" aria-label="Enter Your Phone Number" aria-describedby="basic-addon5"><?= $getuser["bio"] ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Chat Link:</label>
                                                <div class="tooltip" id="tooltip">Link copied!</div>
                                                <input type="text" class="form-control form-control-lg bg-light border-light" placeholder="Chat's Link" id="chatlink" aria-label="chatlink" value="<?= "http://localhost/anonychat/?chat=".$getuser["chatid"] ?>" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Link Copied" aria-describedby="basic-addon5" readonly onclick="copyTextOnClick()">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Link Status:</label>
                                                <div>
                                                    <div class="form-check-inline">
                                                        <input type="radio" class="form-check-input" id="linkstat" name="linkstat" value="open" aria-describedby="basic-addon5" <?php if ($getuser["linkstat"] == "open") { echo "checked"; } ?>>&nbsp;Open&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" class="form-check-input" id="linkstat" name="linkstat" value="closed" aria-describedby="basic-addon5" <?php if ($getuser["linkstat"] == "closed") { echo "checked"; } ?>>&nbsp;Closed
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-grid">
                                                <button class="btn btn-primary waves-effect waves-light" id="editprofilesubmitbtn" type="submit">Change</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>


                        <!-- Dont forget to add activity section where we would be told an estimate of how many messages are sent per day -->
                        <div class="accordion-item card border mb-2">
                            <div class="accordion-header" id="attachfile2">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#attachfile" aria-expanded="false" aria-controls="attachfile">
                                    <h5 class="font-size-14 m-0">
                                        <i class="ri-attachment-line me-2 ms-0 ms-0 align-middle d-inline-block"></i> Attached Files
                                    </h5>
                                </button>
                            </div>
                            <div id="attachfile" class="accordion-collapse collapse" aria-labelledby="attachfile2" data-bs-parent="#tabprofile">
                                <div class="accordion-body">

                                    <?php


                                    $ip = $_SERVER["REMOTE_ADDR"];
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
                                        if ($msgarr["file"] != "") {
                                    ?>
                                            <div class="card p-2 border mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-3 ms-0">
                                                        <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                                            <i class="ri-file-text-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="text-start">
                                                            <h5 class="font-size-14 mb-1"><?= truncate_text(str_replace("uploads/", "", $msgarr['file'])) ?></h5>
                                                        </div>
                                                    </div>

                                                    <div class="ms-4 me-0">
                                                        <ul class="list-inline mb-0 font-size-18">
                                                            <li class="list-inline-item">
                                                                <a download='<?= str_replace("uploads/", "", $msgarr['file']) ?>' href='<?= $msgarr['file'] ?>' class='text-muted px-1'>
                                                                    <i class='ri-download-2-line'></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <!-- End Attached Files card -->

                        <div class="card accordion-item border">
                            <div class="accordion-header" id="about2">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#about" aria-expanded="false" aria-controls="about">
                                    <h5 class="font-size-14 m-0">
                                        <i class="ri-user-2-line me-2 ms-0 ms-0 align-middle d-inline-block"></i> About The Creator
                                    </h5>
                                </button>
                            </div>
                            <div id="about" class="accordion-collapse collapse" aria-labelledby="about2" data-bs-parent="#tabprofile">
                                <div class="accordion-body">
                                    <div>
                                        <p class="text-muted mb-1">Name</p>
                                        <h5 class="font-size-14">Primotion Studio</h5>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-muted mb-1">Email</p>
                                        <h5 class="font-size-14"><a href="mailto:oyedelenewton@gmail.com">oyedelenewton@gmail.com</a></h5>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-muted mb-1">Phone</p>
                                        <h5 class="font-size-14"><a href="tel:+2349114895572">+2349114895572</a></h5>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-muted mb-1">Location</p>
                                        <h5 class="font-size-14 mb-0">RSU</h5>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-muted mb-1">Website</p>
                                        <h5 class="font-size-14 mb-0"><a href="https://theprimotionstudio.wordpress.com/">https://theprimotionstudio.wordpress.com/</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End About card -->
                    </div>
                    <!-- end profile-user-accordion -->

                </div>
                <!-- end user-profile-desc -->
            </div>
            <!-- End profile content -->
        </div>
        <!-- End Profile tab-pane -->



        <!-- Start chats tab-pane -->
        <div class="tab-pane fade show active" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
            <!-- Start chats content -->
            <div>
                <div class="px-4 pt-4">
                    <h4 class="mb-4">Chats</h4>
                    <div class="search-box chat-search-box">
                        <div class="input-group mb-3 rounded-3">
                            <span class="input-group-text text-muted bg-light pe-1 ps-3" id="basic-addon1">
                                <i class="ri-search-line search-icon font-size-18"></i>
                            </span>
                            <input type="text" class="form-control bg-light" placeholder="Search messages or users" aria-label="Search messages or users" aria-describedby="basic-addon1">
                        </div>
                    </div> <!-- Search Box-->
                </div> <!-- .p-4 -->
                <!-- Start chat-message-list -->
                <div>
                    <h5 class="mb-3 px-3 font-size-16">Recent</h5>

                    <div class="chat-message-list px-2" data-simplebar>

                        <ul class="list-unstyled chat-list chat-user-list">
                            <li>
                                <a href="#">
                                    <div class="d-flex">
                                        <div class="chat-user-img online align-self-center me-3 ms-0">
                                            <img src="assets/images/logo.svg" class="rounded-circle avatar-xs" alt="">
                                            <span class="user-status"></span>
                                        </div>
                                        <div id="getlastmsg">
                                            
                                        </div>

                                    </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- End chat-message-list -->
            </div>
            <!-- Start chats content -->
        </div>
        <!-- End chats tab-pane -->
    </div>
</div>
<!-- end chat-leftsidebar -->
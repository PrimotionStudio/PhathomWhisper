<div class="p-3 p-lg-4 border-bottom user-chat-topbar">
    <div class="row align-items-center">
        <div class="col-sm-4 col-8">
            <div class="d-flex align-items-center">
                <div class="d-block d-lg-none me-2 ms-0">
                    <a href="javascript: void(0);" class="user-chat-remove text-muted font-size-16 p-2"><i class="ri-arrow-left-s-line"></i></a>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-0 text-truncate"><a href="#" class="text-reset user-profile-show"><?= $getuser["name"] ?></a></h5>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-4">
            <ul class="list-inline user-chat-nav text-end mb-0">
                <li class="list-inline-item me-2 ms-0">
                    <div class="dropdown">
                        <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-search-line"></i>
                        </button>
                        <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-md">
                            <div class="search-box p-2">
                                <input type="text" class="form-control bg-light border-0" placeholder="Search..">
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end chat user head -->
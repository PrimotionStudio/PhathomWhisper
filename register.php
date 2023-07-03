<?php
require_once("partials/session.php");
require_once("partials/sql.php");
require_once("partials/ip.php");
require_once("partials/token.php");
require_once("partials/alert.php");
require_once("partials/head.php");
?>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="text-center mb-4">
                            <a href="home" class="auth-logo mb-5 d-block">
                                <img src="assets/images/logo.svg" alt="" height="100" class="logo logo-dark">
                                <img src="assets/images/logo.svg" alt="" height="100" class="logo logo-light">
                            </a>

                            <h4>Sign up</h4>
                            <p class="text-muted mb-4">Create your own chat room now.</p>
                            
                        </div>

                        <div class="card">
                            <div class="card-body p-4">
                                <div class="p-3">
                                    <div id="alert"></div>
                                    <form onsubmit="register()" autocomplete="off">
                                        <input type="hidden" name="token" id="token" value="<?= $token ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <div class="input-group bg-light rounded-3  mb-3">
                                                <span class="input-group-text text-muted" id="basic-addon5">
                                                    <i class="ri-user-line"></i>
                                                </span>
                                                <input type="text" class="form-control form-control-lg bg-light border-light" placeholder="Enter The Chat Room's Name" id="name" aria-label="Enter The Chat Room's Name" aria-describedby="basic-addon5">
                                                
                                            </div>
                                        </div>
    
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <div class="input-group bg-light rounded-3  mb-3">
                                                <span class="input-group-text text-muted" id="basic-addon5">
                                                    <i class="ri-mail-line"></i>
                                                </span>
                                                <input type="email" class="form-control form-control-lg bg-light border-light" placeholder="Enter Your Email" id="email" aria-label="Enter Your Email" aria-describedby="basic-addon5">
                                                
                                            </div>
                                        </div>
    
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <div class="input-group bg-light rounded-3  mb-3">
                                                <span class="input-group-text text-muted" id="basic-addon5">
                                                    <i class="ri-phone-line"></i>
                                                </span>
                                                <input type="tel" class="form-control form-control-lg bg-light border-light" placeholder="Enter Your Phone Number" id="phone" aria-label="Enter Your Phone Number" aria-describedby="basic-addon5">
                                                
                                            </div>
                                        </div>
    
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group bg-light mb-3 rounded-3">
                                                <span class="input-group-text border-light text-muted" id="basic-addon6">
                                                    <i class="ri-lock-line"></i>
                                                </span>
                                                <input type="password" class="form-control form-control-lg bg-light border-light" placeholder="Enter Your Password" id="password" aria-label="Enter Your Password" aria-describedby="basic-addon6">
                                                
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label">Password</label>
                                            <div class="input-group bg-light mb-3 rounded-3">
                                                <span class="input-group-text border-light text-muted" id="basic-addon7">
                                                    <i class="ri-lock-2-line"></i>
                                                </span>
                                                <input type="password" class="form-control form-control-lg bg-light border-light" placeholder="Confirm Your Password" id="confirm" aria-label="Confirm Your Password" aria-describedby="basic-addon7">
                                                
                                            </div>
                                        </div>


                                        <div class="d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" id="submitbtn" type="submit">Sign up</button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <p class="text-muted mb-0">By registering you agree to the Phanthom Whisper's <a href="terms" class="text-primary">Terms of Use</a></p>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <p>Already have an account ? <a href="login" class="fw-medium text-primary"> Signin </a> </p>
                            <p>© <script>document.write(new Date().getFullYear())</script> Phanthom Whisper. By Primotion Studio</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end account-pages -->



        <!-- JAVASCRIPT -->
        <style>
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .animation {
            animation: bounce 1s infinite;
        }
        </style>
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>
        <script>
            function register() {
                event.preventDefault();
                let button = document.getElementById("submitbtn");
                button.disabled = true;
                button.innerHTML = 'Processing <span class="animation">...</span>';
                const name = document.getElementById("name").value;
                const email = document.getElementById("email").value;
                const phone = document.getElementById("phone").value;
                const password = document.getElementById("password").value;
                const confirm = document.getElementById("confirm").value;
                const token = document.getElementById("token").value;
                const xhr = new XMLHttpRequest();
                const url = "func/register";
                const params = "name=" + name + "&email=" + email + "&phone=" + phone + "&password=" + password + "&confirm=" + confirm + "&token=" + token;
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if (xhr.responseText.includes("successfully")) {
                            setTimeout(function(){ window.location = "login"; },1500);
                        } else {
                            button.disabled = false;
                            button.innerHTML = 'Sign up';
                        }
                        document.getElementById("alert").innerHTML = xhr.responseText;
                    }
                };
                xhr.send(params);
            }
        </script>

    </body>
</html>

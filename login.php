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

                            <h4>Sign in</h4>
                            <p class="text-muted mb-4">Sign in to continue to use Phanthom Whisper.</p>
                            
                        </div>

                        <div class="card">
                            <div class="card-body p-4">
                                <div class="p-3">
                                    <div id="alert"></div>
                                    <form onsubmit="login()" autocomplete="off">
                                        <input type="hidden" name="token" id="token" value="<?= $token ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <div class="input-group mb-3 bg-light rounded-3">
                                                <span class="input-group-text text-muted" id="basic-addon3">
                                                    <i class="ri-user-2-line"></i>
                                                </span>
                                                <input type="text" id="email" class="form-control form-control-lg border-light bg-light" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="basic-addon3">
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="float-end">
                                                <a href="forgotpassword" class="text-muted font-size-13">Forgot password?</a>
                                            </div>
                                            <label class="form-label">Password</label>
                                            <div class="input-group mb-3 bg-light rounded-3">
                                                <span class="input-group-text text-muted" id="basic-addon4">
                                                    <i class="ri-lock-2-line"></i>
                                                </span>
                                                <input type="password" id="password" class="form-control form-control-lg border-light bg-light" placeholder="Enter Password" aria-label="Enter Password" aria-describedby="basic-addon4">
                                                
                                            </div>
                                        </div>

                                        <div class="form-check mb-4">
                                            <input type="checkbox" class="form-check-input" id="remember-check">
                                            <label class="form-check-label" for="remember-check">Remember me</label>
                                        </div>

                                        <div class="d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" id="submitbtn" type="submit">Sign in</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <p>Don't have an account ? <a href="register" class="fw-medium text-primary"> Signup now </a> </p>
                            <p>© <script>document.write(new Date().getFullYear())</script> Phanthom Whisper. By Primotion Studio</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end account-pages -->


        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

        <script>
            function login() {
                event.preventDefault();
                let button = document.getElementById("submitbtn");
                button.disabled = true;
                button.innerHTML = 'Processing <span class="animation">...</span>';
                const email = document.getElementById("email").value;
                const password = document.getElementById("password").value;
                const token = document.getElementById("token").value;
                const xhr = new XMLHttpRequest();
                const url = "func/login";
                const params = "email=" + email + "&password=" + password + "&token=" + token;
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if (xhr.responseText.includes("Successful")) {
                            setTimeout(function(){ window.location = "index"; },1500);
                        } else {
                            button.disabled = false;
                            button.innerHTML = 'Sign in';
                        }
                        document.getElementById("alert").innerHTML = xhr.responseText;
                    }
                };
                xhr.send(params);
            }
        </script>
    </body>
</html>

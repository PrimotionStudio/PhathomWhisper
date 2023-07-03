<?php
session_start();
$ip = $_SERVER["REMOTE_ADDR"];
require("partials/token.php");
require("partials/sql.php");
include "partials/head.php";
?>

        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="text-center mb-4">
                            <a href="index.html" class="auth-logo mb-5 d-block">
                                <img src="assets/images/logo.svg" alt="" height="100" class="logo logo-dark">
                                <img src="assets/images/logo.svg" alt="" height="100" class="logo logo-light">
                            </a>

                            <h4>Reset Password</h4>
                        </div>

                        <div class="card">
                            <div class="card-body p-4">
                                <div class="p-3">
                                    <div class="alert alert-success text-center mb-4" role="alert">
                                        Enter your Email and instructions will be sent to you!
                                    </div>
                                    <form action="func/forgotpassword" method="post">
    
                                        <div class="mb-4">
                                            <label class="form-label">Email</label>
                                            <div class="input-group mb-3 bg-light rounded-3">
                                                <span class="input-group-text text-muted" id="basic-addon5">
                                                    <i class="ri-mail-line"></i>
                                                </span>
                                                <input type="email" class="form-control form-control-lg border-light bg-light" placeholder="Enter Your Email" aria-label="Enter Your Email" aria-describedby="basic-addon5">                                                
                                            </div>
                                        </div>

                                        <div class="d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Reset</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <p>Remember Your Password? <a href="login" class="fw-medium text-primary"> Signin </a> </p>
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

    </body>
</html>

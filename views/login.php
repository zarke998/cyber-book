<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);
    include_once ROOT."/models/pages.php";
    require_once ROOT."/models/account/login/login_processor.php";
    // require_once ROOT."/config/config.php";
    
    if(isset($_POST["login"])){
        ob_clean();

        header("Content-Type: application/json");

        $err_json = "";
        if(login($_POST["email"], $_POST["password"], $err_json)){
            http_response_code(200);
            echo json_encode(["message" => "Login successful."]);
        }
        else{
            echo $err_json;
        }

        ob_end_flush();
        exit;
    }

?>

<section class="login_part section_padding ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div id="login-side-section" class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2 class="text-stroke-black-1">Don't have an account?</h2>
                        <p class="text-stroke-black-1">Sign up via button bellow for easier shopping experience.</p>
                        <a href="index.php?page=<?= Pages::Register?>" class="btn_3">Create an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Welcome Back ! <br>
                            Please Sign in now</h3>
                        <form class="row contact_form" action="#" method="post">
                            <?php 
                                if(isset($_SESSION["activation_successful"])): ?>
                                <div class="valid-feedback d-block ml-4">
                                    Account activated successfuly. Please login.
                                </div>

                            <?php endif;
                                unset($_SESSION["activation_successful"]);
                            ?>
                            
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="loginEmail" name="email" value=""
                                    placeholder="Username">
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="loginPassword" name="password" value=""
                                    placeholder="Password">
                                    <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button id="loginBtn" type="button" value="on" class="btn_3">
                                    log in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
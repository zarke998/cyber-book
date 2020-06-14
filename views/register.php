<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/pages.php";
    require_once ROOT."/config/config.php";
    require_once ROOT."/models/account/register/register_processor.php";
    require_once ROOT."/models/account/register/register_activator.php";

    if(isset($_POST["register"])){
        ob_clean();

        header("Content-Type: application/json");
        $err_json = "";

        if(register($_POST["email"], $_POST["password"], $err_json)){
            http_response_code(200);
            echo json_encode(["message" => "Register successful. Please confirm your email via activation link in your inbox."]);
        }
        else{
            echo $err_json;
        }

        ob_end_flush();
        exit;
    }
    else if(isset($_GET["uid"]) and isset($_GET["activation_key"])){
        if(activate_account($_GET["uid"], $_GET["activation_key"])){
            ob_clean();

            $_SESSION["activation_successful"] = true;
            header("Location: index.php?page=".Pages::Login);

            ob_end_flush();
            exit;
        }
        else{
            $activation_error_msg = "Error activating account. Try resending activation link.";
        }
    }
?>

<section class="login_part section_padding ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div id="register-side-section" class="login_part_text text-center w-100">
                    <div class="login_part_text_iner">
                        <h2 class="text-stroke-black-1">Already have an account?</h2>
                        <p class="text-stroke-black-1">Sign in via button bellow.</p>
                        <a href="index.php?page=<?= Pages::Login?>" class="btn_3">Sign in</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Need an account? <br>
                            Please fill in the form bellow</h3>
                        <form class="row contact_form" action="index.php?page=<?= Pages::Register ?>" method="post">
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="registerEmail" name="email" value=""
                                    placeholder="Email">
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="registerPassword" name="password" value=""
                                    placeholder="Password">
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="registerConfirmPassword" value=""
                                    placeholder="Confirm password">
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <p id="resendActivationLink" class="ml-4">Having trouble activating account? Try <a href="">resending activation link.</a></p>
                            <div class="col-md-12 form-group">
                                <button id="registerBtn" type="button" name="submit" value="submit" class="btn_3">
                                    register
                                </button>
                            </div>
                            <?php 
                                if(isset($activation_error_msg)): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $activation_error_msg ?>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
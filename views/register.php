<?php 
    define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    include_once ROOT."/models/pages.php";
?>

<section class="login_part section_padding ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div id="register-side-section" class="login_part_text text-center">
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
                        <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    placeholder="Email">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password" name="password" value=""
                                    placeholder="Password">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password" name="password" value=""
                                    placeholder="Confirm password">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="btn_3">
                                    register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
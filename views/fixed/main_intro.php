<?php 
    function getMainIntro($title){
        $container_identifier = strtolower($title)."-main-intro";

        return '
        <div id="'.$container_identifier.'" class="main-intro slider-area ">
        <!-- Mobile Menu -->
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2 class="text-stroke-black-2">'.$title.'</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
?>

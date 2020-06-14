<?php
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/menu/select.php";
    
    function getFooter($scripts){

        $scriptTags = "";

        if($scripts != null)
            foreach($scripts as $script){
                $scriptTags.= "<script src=\"$script\"></script>";
            }

        $quick_links = "";

        $menu = get_menu_by_name("header");
        foreach($menu as $menu_item){
            $quick_links.= '<li><a href="'.$menu_item->href.'">'.$menu_item->item_name.'</a></li>';
        }


        $legal = "";

        $legal_menu = get_menu_by_name("footer-legal");
        foreach($legal_menu as $menu_item){
            $legal.= '<li><a href="'.$menu_item->href.'">'.$menu_item->item_name.'</a></li>';
        }
    

        $contact = "";

        $contact_menu = get_menu_by_name("footer-contact");
        foreach($contact_menu as $menu_item){
            $contact.= '<li><a href="'.$menu_item->href.'">'.$menu_item->item_name.'</a></li>';
        }

        return '
        <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                       <div class="single-footer-caption mb-50">
                         <div class="single-footer-caption mb-30">
                              <!-- logo -->
                             <div class="footer-logo">
                                 <a href="index.html"><img src="assets/img/logo2.png" alt=""></a>
                             </div>
                             <div class="footer-tittle">
                                 <div class="footer-pera">
                                     <p>We are an online bookstore that provides quality reading material. Find books for your taste for a low price.</p>
                                </div>
                             </div>
                         </div>
                       </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Quick Links</h4>
                                <ul>
                                    '.$quick_links.'
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Legal</h4>
                                <ul>
                                 '.$legal.'
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Contact</h4>
                                <ul>
                                 '.$contact.'
                             </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer bottom -->
                <div class="row">
                 <div class="col-xl-7 col-lg-7 col-md-7">
                     <div class="footer-copy-right">
                         <p><!-- Link back to Colorlib can\'t be removed. Template is licensed under CC BY 3.0. -->
   Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
   <!-- Link back to Colorlib can\'t be removed. Template is licensed under CC BY 3.0. --></p>                   </div>
                 </div>
                  <div class="col-xl-5 col-lg-5 col-md-5">
                     <div class="footer-copy-right f-right">
                         <!-- social -->
                         <div class="footer-social">
                             <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                             <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                             <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                             <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                         </div>
                     </div>
                 </div>
             </div>
            </div>
        </div>
        <!-- Footer End-->
 
    </footer>
    
     <!-- JS here -->
     
         <!-- All JS Custom Plugins Link Here here -->
         <!-- Jquery, Popper, Bootstrap -->
         <script src="/assets/js/vendor/jquery-1.12.4.min.js"></script>
         <script src="/assets/js/popper.min.js"></script>
         <script src="/assets/js/bootstrap.min.js"></script>
         <!-- Jquery Mobile Menu -->
         <script src="/assets/js/jquery.slicknav.min.js"></script>
 
         <!-- Jquery Slick , Owl-Carousel Plugins -->
         <script src="/assets/js/owl.carousel.min.js"></script>
         <script src="/assets/js/slick.min.js"></script>
 
         <!-- One Page, Animated-HeadLin -->
         <script src="/assets/js/wow.min.js"></script>
         <script src="/assets/js/animated.headline.js"></script>
         <script src="/assets/js/jquery.magnific-popup.js"></script>
 
         <!-- Scrollup, nice-select, sticky -->
         <script src="/assets/js/jquery.scrollUp.min.js"></script>
         <script src="/assets/js/jquery.nice-select.min.js"></script>
         <script src="/assets/js/jquery.sticky.js"></script>
         
         <!-- contact js -->
         <script src="/assets/js/contact.js"></script>
         <script src="/assets/js/jquery.form.js"></script>
         <script src="/assets/js/jquery.validate.min.js"></script>
         <script src="/assets/js/mail-script.js"></script>
         <script src="/assets/js/jquery.ajaxchimp.min.js"></script>
         
         <!-- Jquery Plugins, main Jquery -->	
         <script src="/assets/js/plugins.js"></script>
         <script src="/assets/js/main.js"></script>
         '.$scriptTags.'
     </body>
 </html>   
        ';
    }
?>

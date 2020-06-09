<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/pages.php";
?>

<div id="admin-container" class="container">
    <div id="admin-content-section" class="mt-4">
        <h2 class="text-center my-4">Content</h2>
        <div class="d-flex justify-content-center">
            <a href="index.php?page=<?= Pages::Admin_Add_Book ?>" class="btn header-btn mx-3">Add book</a>
            <a href="index.php?page=<?= Pages::Admin_Update_Book ?>" class="btn header-btn mx-3">Update book</a>
            <a href="index.php?page=<?= Pages::Admin_Delete_Book ?>" class="btn header-btn mx-3">Delete book</a>
        </div>
    </div>
    <div id="admin-statistic-section" class="my-5">
        <div id="admin-pages-percent">
            <h3>Pages access - percentage</h3>
            <ul class="row my-4">
                <li class="col-3">Home - 55%</li>
                <li class="col-3">Home - 55%</li>
                <li class="col-3">Home - 55%</li>
                <li class="col-3">Home - 55%</li>
                <li class="col-3">Home - 55%</li>
                <li class="col-3">Home - 55%</li>
                <li class="col-3">Home - 55%</li>
            </ul>
        </div>
        <div id="admin-pages-last-24">
            <h3>Last 24hr page access</h3>
            <ul class="row my-4">
                <li class="col-3">Home - 2123</li>
                <li class="col-3">Home - 2123</li>
                <li class="col-3">Home - 2123</li>
                <li class="col-3">Home - 2123</li>
                <li class="col-3">Home - 2123</li>
                <li class="col-3">Home - 2123</li>
                <li class="col-3">Home - 2123</li>
            </ul>
        </div>
    </div>
    <div id="admin-page-access-log">
        <h3>Access log</h3>
        <div id="admin-log-window">
            
        </div>
    </div>

</div>
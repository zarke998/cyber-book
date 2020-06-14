<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/pages.php";
    require_once ROOT."/models/log/get_page_access_percentages.php";
    require_once ROOT."/models/log/get_page_access_last_24h.php";
    require_once ROOT."/models/log/get_log_all.php";
?>

<div id="admin-container" class="container">
    <div id="admin-content-section" class="mt-4">
        <h2 class="text-center my-4">Content</h2>
        <div class="d-flex flex-column flex-md-row justify-content-center">
            <a href="index.php?page=<?= Pages::Admin_Add_Book ?>" class="btn header-btn mx-3 mb-3">Add book</a>
            <a href="index.php?page=<?= Pages::Admin_Update_Book ?>" class="btn header-btn mx-3 mb-3">Update book</a>
            <a href="index.php?page=<?= Pages::Admin_Delete_Book ?>" class="btn header-btn mx-3 mb-3">Delete book</a>
        </div>
    </div>
    <div id="admin-statistic-section" class="my-5">
        <div id="admin-pages-percent">
            <h3>Pages access - percentage</h3>
            <ul class="row my-4">
                <?php 
                    $page_percentages = get_page_access_percentages();
                    foreach($page_percentages as $key => $value): ?>
                        <li class="col-3 text-center"><?=$key?> - <?=$value?>%</li>        
                <?php endforeach;?>
            </ul>
        </div>
        <div id="admin-pages-last-24">
            <h3>Last 24hr page access</h3>
            <ul class="row my-4">
                <?php 
                    $page_access_last_24h = get_page_access_last_24h();
                    foreach($page_access_last_24h as $key => $value): ?>
                        <li class="col-3 text-center"><?=$key?> - <?=$value?></li>        
                <?php endforeach;?>
            </ul>
        </div>
    </div>
    <div id="admin-page-access-log">
        <h3>Access log</h3>
        <div id="admin-log-window">
            <p>
                <?php 
                    $log = get_log_all();
                    foreach($log as $line) : ?>
                        <?=$line?><br>
                <?php endforeach;?>
            </p>
        </div>
    </div>

</div>
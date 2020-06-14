<?php
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/book/get_cheapest_books.php";

    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment;filename=cheapest-books.xls");

    $excel_app = new COM("excel.application") or die("Error starting excel.");

    $excel_app->Visible = 0;

    $workbook = $excel_app->Workbooks->Add();
    $sheet = $workbook->Worksheets("Sheet1");
    
    $title_field = $sheet->Range("A1");
    $title_field->activate;
    $title_field->Value = "Title";

    $pages_field = $sheet->Range("B1");
    $pages_field->activate;
    $pages_field->Value = "Pages num.";

    $price_field = $sheet->Range("C1");
    $price_field->activate;
    $price_field->Value = "Price";

    $discount_field = $sheet->Range("D1");
    $discount_field->activate;
    $discount_field->Value = "Discount";

    $total_price_field = $sheet->Range("E1");
    $total_price_field->activate;
    $total_price_field->Value = "Total price";

    $cheapest_books = get_cheapest_books(15);
    

    for($i = 2; $i < count($cheapest_books) + 2; $i++){
        $c = 'A';
        for($j = 0; $j < 5; $j++){
            $indexed_array = array_values($cheapest_books[$i - 2]);

            $column = $j + 1;
            $cell = $c.$column;

            $field = $sheet->Range($cell);
            $field->activate;
            $field->Value = $indexed_array[$j];

            $c++;
        }
    }

    $excel_doc_path = ROOT."/data/cheapest_books.xls";
    $workbook->SaveAs($excel_doc_path, -4143);
    
    //Cleanup
    $workbook->Save();
    $workbook->Saved = true;
    $workbook->Close();

    unserialize($sheet);
    unset($workbook);

    $excel_app->Workbooks->Close();
    $excel_app->Quit();

    unset($excel_app);

    readfile($excel_doc_path);
    unlink($excel_doc_path);

?>
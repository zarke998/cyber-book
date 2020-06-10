<?php 
    function output_json_message($message, $status_code){
        http_response_code($status_code);
        echo json_encode(["message" => $message]);
    }
?>
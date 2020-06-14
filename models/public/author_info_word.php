<?php
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=Andrej-Zarkovski-info.doc");

    $word = new COM("word.application") or die("Error starting word.");

    $word->Visible=1;
    $word->Documents->Add();

    $body = "My name is Andrej Zarkovski. I'm studying web programming at 'Visoka ICT Škola' in Belgrade. In my early childhood I was very interested in how computers work and I continued to learn more about them. Now I am pursuing career in computer programming. I love japanese culture and I love playing video games.

    Portfolio: zarke998.github.io/web-portfolio
    
    GitHub: github.com/zarke998
    
    LinkedIn: linkedin.com/in/andrej-zarkovski-01b8a4188";
    $word->Selection->TypeText($body);

    $word_path = ROOT."/data/author-info.doc";
    $word->Documents[1]->SaveAs($word_path);

    $word->Quit();
    $word = null;

    readfile($word_path);
    unlink($word_path);
?>
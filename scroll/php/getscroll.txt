<?php

/*

commands to get from this to final printable pdf:

php ../getscroll.php
pdflatex scroll.tex
pdfbook scroll.pdf


*/


$scrollurl = $_POST["scrollurl"];
$scroll = file_get_contents($scrollurl);

$scrollurlarray = explode("/",$scrollurl);

$newfilename = $scrollurlarray[sizeof($scrollurlarray) - 1];
$newfilename = explode(".txt",$newfilename)[0];

mkdir("bookfactory/".$newfilename);

$foo = explode("![](",$scroll);
$index = 0;

$indexhtml = "<html><body>\n";
$indexhtml .= "<ul>\n";
$indexhtml .= "<li><a href = \"../bookfactory.php\">back to book factory</a></li>";
$indexhtml .= "<li><a href = \"scroll.tex\">scroll.tex</a></li>";
$indexhtml .= "<li><a href = \"scroll.pdf\">scroll.pdf</a></li>";
$indexhtml .= "<li><a href = \"scroll-book.pdf\">scroll-book.pdf</a></li>";


foreach($foo as $value){
    if($index > 0){
        $imgurl = explode(")",$value)[0];
        copy($imgurl,"bookfactory/".$newfilename."/image".strval($index).".png");
        
        $scroll = str_replace("![](".$imgurl.")","![](bookfactory/".$newfilename."/image".strval($index).".png)",$scroll);
        $indexhtml .= "<li><a href = \"image".strval($index).".png\"><img src = \"image".strval($index).".png\"/></a></li>\n";
    }
    $index++;
}

$indexhtml .= "</ul>\n</body></html>";
file_put_contents("bookfactory/".$newfilename."/index.html",$indexhtml);


file_put_contents("bookfactory/".$newfilename."/scroll.txt",$scroll);


?>
<?php

/*

commands to get from this to final printable pdf:

php ../getscroll.php
pdflatex scrool.tex
pdfbook scroll.pdf


*/

$url = file_get_contents("scrollurl.txt"); //get url 


$textop = "\\documentclass[11pt]{article}\n\\usepackage{hyperref}\n\\usepackage{graphicx}\n\\usepackage[paperheight=8.5in,paperwidth=5.5in,margin=1in]{geometry}\n\\begin{document}";
$texbottom = "\n\\end{document}\n";



$scroll = file_get_contents($url);
$foo = explode("![](",$scroll);

$index = 0;

$imagelist = "";
foreach($foo as $value){
    if($index > 0){
        $imgurl = explode(")",$value)[0];
        copy($imgurl,"image".strval($index).".png");
        $scroll = str_replace("![](".$imgurl.")","\\begin{figure}\n\\includegraphics[scale=0.3]{image".strval($index).".png}\n\\end{figure}",$scroll);
        $imagelist .= "<img src = \"image".strval($index).".png\"/>\n";
    }
    $index++;
}

$scroll = $textop.$scroll.$texbottom;

file_put_contents("scroll.tex",$scroll);


?>
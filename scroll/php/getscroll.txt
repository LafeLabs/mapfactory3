<?php

/*

commands to get from this to final printable pdf:

php ../getscroll.php
pdflatex scroll.tex
pdfbook scroll.pdf


*/

$url = file_get_contents("scrollurl.txt"); //get url 


$textop = "\\documentclass[11pt]{article}\n\\usepackage{hyperref}\n\\usepackage{graphicx}\n\\usepackage[paperheight=8.5in,paperwidth=5.5in,margin=0.5in]{geometry}\n\\begin{document}";
$texbottom = "\n\\end{document}\n";



$scroll = file_get_contents($url);
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
        copy($imgurl,"image".strval($index).".png");
        $scroll = str_replace("![](".$imgurl.")","\\begin{figure}\n\\includegraphics[scale=0.3]{image".strval($index).".png}\n\\end{figure}",$scroll);
        
        $indexhtml .= "<li><a href = \"image".strval($index).".png\"><img src = \"image".strval($index).".png\"/></a></li>\n";
    }
    $index++;
}

$indexhtml .= "</ul>\n</body></html>";
file_put_contents("index.html",$indexhtml);

$scroll = $textop.$scroll.$texbottom;

file_put_contents("scroll.tex",$scroll);


?>
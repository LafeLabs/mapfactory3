<?php

/*

commands to get from this to final printable pdf:

pdflatex scrool.tex
pdfbook scroll.pdf


*/
$textop = "\\documentclass[11pt]{article}\n\\usepackage{hyperref}\n\\usepackage{graphicx}\n\\usepackage[paperheight=8.5in,paperwidth=5.5in,margin=1in]{geometry}\n\\begin{document}";
$texbottom = "\n\\end{document}\n";

$url = "http://geometron.000webhostapp.com/scroll/markdown/ag.txt"; 


$scroll = file_get_contents($url);
$foo = explode("![](",$scroll);

$index = 0;
foreach($foo as $value){
    if($index > 0){
        $imgurl = explode(")",$value)[0];
        echo $imgurl."\n";
        copy($imgurl,"image".strval($index).".png");
        
        $scroll = str_replace("![](".$imgurl.")","\\begin{figure}\n\\includegraphics[scale=0.3]{image".strval($index).".png}\n\\end{figure}",$scroll);
        
    }
    $index++;
}

$scroll = $textop.$scroll.$texbottom;

file_put_contents("scroll.tex",$scroll);

echo($scroll);


?>
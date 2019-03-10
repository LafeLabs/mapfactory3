<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Scroll Factory</title>
<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADf+wAA3/sAAAfgAACv9QAAoAUAAK/1AACv9QAAqBUAAK/1AACoFQAAr/UAAKAFAACv9QAAB+AAAN/7AADf+wAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

_9_LAWS_OF_GEOMETRON_:

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

NO MONEY
NO PROPERTY
NO MINING

EGO DEATH:
    LOOK AT THE INSECTS
    LOOK AT THE FUNGI
    LANGUAGE IS HOW THE MIND PARSES REALITY
    
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

<!-- links to MathJax JavaScript library, un-comment to use math-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script>
	MathJax.Hub.Config({
		tex2jax: {
		inlineMath: [['$','$'], ['\\(','\\)']],
		processEscapes: true,
		processClass: "mathjax",
        ignoreClass: "no-mathjax"
		}
	});//			MathJax.Hub.Typeset();//tell Mathjax to update the math
</script>

<script src = "https://cdnjs.cloudflare.com/ajax/libs/showdown/1.8.6/showdown.js"></script>


</head>
<body>
<div id = "textdatadiv" style = "display:none" class = "no-mathjax"><?php
  
$files = scandir(getcwd()."/textfeed");
foreach($files as $value){
    if(substr($value,-4) == ".txt"){
        echo "\n<p id = \"".$value."\" class = \"textelement\">\n".file_get_contents("textfeed/".$value)."\n</p>\n";
    }
}

?></div>
<div id = "svgfilesdiv" style = "display:none"><?php


$files = scandir(getcwd()."/../symbol/png");
$listtext = "";
foreach($files as $value){
    if(substr($value,-4) == ".png"){
        $listtext .= "../symbol/png/".$value.",";
    }
}
echo $listtext;

$dirs = scandir(getcwd()."/../symbol/symbols");
foreach($dirs as $symboldir){
    if($symboldir != "." && $symboldir != ".."){
        $files = scandir(getcwd()."/../symbol/symbols/".$symboldir."/png");
        $listtext = "";
        foreach($files as $value){
            if(substr($value,-4) == ".png"){
                $listtext .= "../symbol/symbols/".$symboldir."/png/".$value.",";
            }
        }
        echo $listtext;
    }
}

$files = scandir(getcwd()."/../curve/png");
$listtext = "";
foreach($files as $value){
    if(substr($value,-4) == ".png"){
        $listtext .= "../curve/png/".$value.",";
    }
}
echo $listtext;


$dirs = scandir(getcwd()."/../curve/curves");
foreach($dirs as $symboldir){
    if($symboldir != "." && $symboldir != ".."){
        $files = scandir(getcwd()."/../curve/curves/".$symboldir."/png");
        $listtext = "";
        foreach($files as $value){
            if(substr($value,-4) == ".png"){
                $listtext .= "../curve/curves/".$symboldir."/png/".$value.",";
            }
        }
        echo $listtext;
    }
}
?></div>
<div id = "imgurlsdiv" style = "display:none"><?php

echo file_get_contents("../json/imgurls.txt");

?></div>
<div id = "uploadimages" style = "display:none;"><?php

$files = scandir(getcwd()."/../uploadimages");
$listtext = "";
foreach($files as $value){
    if($value != "." && $value != ".." && substr($value,-4) != ".txt"){
        $listtext .= "../uploadimages/".$value.",";
    }
}
echo $listtext;
    
?></div>
<div id = "filenamediv" style = "display:none"><?php

if(isset($_GET['filename'])){
    echo $_GET['filename'];
}
else{
    echo "scroll.txt";
}
    

?></div>
<?php
    echo file_get_contents("html/index.txt");
?>
</body>
</html>
 <!doctype html>
<html>
<head>
<title>Parse SVG's</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

NO MONEY
NO MINING
NO PROPERY

LOOK AT THE FUNGI
LOOK AT THE INSECTS
LANGUAGE IS HOW THE MIND PARSES REALITY

-->

<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

</head>
<body>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>

<a id = "indexlink" href = "index.php"><img style = "width:80px" src = "icons/symbol.svg"></a>

<div id = "scroll">
<?php

    if(isset($_GET['path'])){
        $path = $_GET['path'];
        $svgpath = "/symbols/".$path."svg";
        $svgpath2 = "symbols/".$path."svg/";

    }
    else{
        $svgpath = "/svg";
        $svgpath2 = "svg/";
    }
 
    $svgs = scandir(getcwd().$svgpath);
    $svgs = array_reverse($svgs);
    foreach($svgs as $value){
        if($value != "." && $value != ".." && substr($value,-4) == ".svg"){
            
            echo "\n<p>\n   <a href = \"index.php?url=";
            echo $svgpath2.$value;
            echo "&path=";
            echo $path;
            echo "\">\n";   
            echo "\n    <img src = \"".$svgpath2.$value."\"/>";
            echo "\n    </a>\n</p>\n";
        }
    }
?>
</div>
<script>
    path = document.getElementById("pathdiv").innerHTML;
    if(path.length>1){
        document.getElementById("indexlink").href = "index.php?path=" + path;
    }
</script>
<style>

    #indexlink{
        left:1em;
        top:3em;
        position:absolute;
        z-index:3;
    }

    #scroll{
        border-top:solid;
        position:absolute;
        left:0px;
        top:120px;
        bottom:0px;
        right:0px;
        overflow:scroll;
    }
    img{
        box-sizing: border-box;
        border:solid;
        border-color:white;
    }
    p{
        border:solid;
        box-sizing: border-box;
        border-color:white;
        margin-top:10em;
        margin-bottom:3em;
    }

</style>
</body>
</html>
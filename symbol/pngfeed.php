 <!doctype html>
<html>
<head>
<title>PNG Feed</title>
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
<input id = "codeinput">

<table id  = "linktable">
    <tr>
        <td><a href = "index.php" id = "indexlink"><img style = "width:80px" src = "../mapicons/geometron.svg"></a></td>
        <td><a href = "../scroll/"><img style = "width:80px" src = "../mapicons/scroll.svg"></a></td>
    </tr>
</table>

<div id = "scroll">
    

<?php

    if(isset($_GET['path'])){
        $path = $_GET['path'];
        $svgpath = "/symbols/".$path."png";
        $svgpath2 = "symbols/".$path."png/";

    }
    else{
        $svgpath = "/png";
        $svgpath2 = "png/";
    }
 
    $svgs = scandir(getcwd().$svgpath);
    $svgs = array_reverse($svgs);
    foreach($svgs as $value){
        if($value != "." && $value != ".." && substr($value,-4) == ".png"){
            
            echo "\n<p>\n";      
            echo "\n    <img src = \"".$svgpath2.$value."\"/>";
            echo "\n\n</p>\n";
        }
    }
?>
</div>
<script>
    path = document.getElementById("pathdiv").innerHTML;
    if(path.length>1){
        document.getElementById("indexlink").href = "index.php?path=" + path;
    }
    
    images  = document.getElementById("scroll").getElementsByTagName("IMG");
    for(var index = 0;index < images.length;index++){
        images[index].id = "i" + index.toString();
        images[index].onclick = function(){
            document.getElementById("codeinput").value = "![](" + this.src  + ")";
            document.getElementById("codeinput").select();
        }
    }
    
</script>
<style>

    #linktable{
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
        width:200px;
        cursor:pointer;
    }
    p{
        border:solid;
        box-sizing: border-box;
        border-color:white;
        margin-top:10em;
        margin-bottom:3em;
    }
    #codeinput{
        font-size:26px;
        font-family:courier;
        width:30em;
    }

</style>
</body>
</html>
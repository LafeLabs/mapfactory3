 <!doctype html>
<html>
<head>
<title>Function Plotter</title>
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


</head>
<body>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>

<table id = "linktable">
    <tr>
        <td>
            <a id = "indexlink" href = "index.php">
                <img src = "icons/curve.svg"/>
            </a>
        </td>
        <td>
            <a href = "editor.php">
                <img src = "icons/editor.svg"/>
            </a>
        </td>
        <td>
            <a href = "tree.php">
                <img src = "icons/tree.svg"/>
            </a>
        </td>
    </tr>
</table>

<div id = "scroll">
<?php

    if(isset($_GET['path'])){
        $path = $_GET['path'];
        $svgpath = "/curves/".$path."svg";
        $svgpath2 = "curves/".$path."svg/";

    }
    else{
        $svgpath = "/svg";
        $svgpath2 = "svg/";
    }
 
    $svgs = scandir(getcwd().$svgpath);
    $svgs = array_reverse($svgs);
    foreach($svgs as $value){
        if($value != "." && $value != ".." && substr($value,-4) == ".svg"){
            if(isset($_GET['path'])){
                echo "<a href = \"index.php?url=".$svgpath2.$value."&path=".$path."\">\n";
            }
            else{
                echo "<a href = \"index.php?url=".$svgpath2.$value."\">\n";
            }
            echo "<img src = \"".$svgpath2.$value."\"/>";
            echo "\n</a>\n";
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

#linktable{
    position:absolute;
    top:0px;
    left:0px;
    z-index:3;
}
#linktable img{
    width:50px;
}
#scroll{
    position:absolute;
    left:0px;
    top:110px;
    bottom:0px;
    right:0px;
    overflow:scroll;
}
#scroll img{
    display:block;
    margin:auto;
}
    
</style>
</body>
</html>
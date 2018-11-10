<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Meme Factory</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

Graphical Meme Factory  

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
<!--

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
-->
</head>
<body>
<div id = "pathdiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo $_GET['path'];
    }
?></div>
<div id = "urldiv" style = "display:none"><?php
    if(isset($_GET['url'])){
        echo $_GET['url'];
    }
?></div>
<div id = "datadiv" style = "display:none"><?php
    if(isset($_GET['path']) && isset($_GET['url'])){
        echo file_get_contents($_GET['url']);
    }
    if(isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents($_GET['path']);
    }
    if(isset($_GET['url']) && !isset($_GET['path'])){
        echo file_get_contents($_GET['url']);
    }
    if(!isset($_GET['url']) && !isset($_GET['path'])){
        echo file_get_contents("json/meme.txt");        
    }
?></div>
<?php
    echo file_get_contents("html/index.txt");
?>
</body>
</html>
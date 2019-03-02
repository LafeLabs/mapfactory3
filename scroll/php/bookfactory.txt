<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Book Factory</title>
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
<!--
<script src = "https://cdnjs.cloudflare.com/ajax/libs/showdown/1.8.6/showdown.js"></script>
-->
</head>
<body>
<table>
    <tr>
        <td><a href = "editor.php">
            <img style = "width:80px;" src = "icons/editor.svg"/>
        </a></td>
        <td><a href = "index.php"><img style = "width:80px;" src = "../mapicons/scroll.svg"/></a></td>
        <td>
            <a href = "bookfactory/">
                <img style = "width:80px;" src = "icons/bookfactory.svg"/>  
            </a>
        </td>
    </tr>
<tr>
</table>
<table>
<tr>
    <td>Enter URL of SCROLL:</td>
    <td>
        <input id = "urlinput"/>
    </td>
</tr>
</table>

<pre>
cd scroll
cd bookfactory
php ../getscroll.php
pdflatex scroll.tex
pdfbook scroll.pdf
</pre>

<script>

document.getElementById("urlinput").onchange = function(){
    data = this.value;
    currentFile = "scrollurl.txt";
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename=bookfactory/"+currentFile);//send text to filesaver.php

}

</script>
<style>
#urlinput{
    width:20em;
}
pre{
    background-color:black;
    color:#00ff00;
    font-size:16px;
    font-family:courier;
    width:20em;
    height:8em;
    display:block;
    padding:2em 2em 2em 2em;
}
</style>
</body>
</html>




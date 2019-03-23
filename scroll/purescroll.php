<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Pure Scroll</title>
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
<div id = "filenamediv" style = "display:none"><?php

if(isset($_GET['filename'])){
    echo $_GET['filename'];
}
else{
    echo "scroll.txt";
}
    
?></div>
<div id  = "scroll">

    
</div>
<script>

var converter = new showdown.Converter();

converter.setOption('literalMidWordUnderscores', 'true');
converter.setOption('tables', 'true');

//currentFile = "markdown/scroll.txt";

currentFile = "markdown/" + document.getElementById("filenamediv").innerHTML;


rawhtml = "";
var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        rawhtml = converter.makeHtml(filedata);
        document.getElementById("scroll").innerHTML = rawhtml;
        MathJax.Hub.Typeset();//tell Mathjax to update the math
    }
};
httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
httpc.send();



editmode = true;
    

MathJax.Hub.Typeset();//tell Mathjax to update the math




</script>
<style>
#scroll{
    position:absolute;
    right:0px;
    left:0px;
    top:0px;
    bottom:0px;
    overflow:scroll;
    padding:2em 2em 2em 2em;
    z-index:1;
}
#scroll img{
    display:block;
    margin:auto;
    max-width:90%;
}

</style>
</body>
</html>
<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Duality</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAREAAREAAREAERAAERAAEQABEQABEQABAAAAAAAAAAAAAAAAAAAAAAAAACIiAAAAAAAiIiIiAAAAAiAAIiIgAAAAAAACIiAAAAAAAAIiIAAAACIAIgAgAAAAIgAiACAAAAAAACIiIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD//wAA/D8AAPAPAADgBwAAwAMAAMADAADAAwAAwAMAAMADAADAAwAA4AcAAPAPAAD8PwAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

note that "map" has a broader meaning than just geographic maps like google maps or yahoo or whatever, the wikipedia definition starts like this:

"A map is a symbolic depiction emphasizing relationships between elements of some space, such as objects, regions, or themes."

This is the goal of this project, to make a factory which creates maps in this generalized definition.  

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

<script src = "https://cdnjs.cloudflare.com/ajax/libs/showdown/1.8.6/showdown.js"></script>

-->
<script src = "https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
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
        echo file_get_contents("json/map.txt");        
    }
?></div>
<div id = "page">
<table id = "linktable">
    <tr>
        <td>
            <a id = "indexlink" href = "index.php">
                <img src = "mapicons/mapfactory.svg"/>
            </a>
        </td>
        <td>
            <a id = "linkerlink" href = "linker.php">
                <img src = "mapicons/linker.svg"/>
            </a>
        </td>
        <td>
            <a id = "alignerlink" href = "aligner.php">
                <img src = "mapicons/aligner.svg"/>
            </a>
        </td>
    </tr>
</table>
</div>
<script>
theta = Math.PI/4;

linkimages = document.getElementById("linktable").getElementsByTagName("img");
for(var index = 0;index < linkimages.length;index++){
    linkimages[index].style.width = (innerWidth/16).toString() + "px";
}

    duality = JSON.parse(document.getElementById("datadiv").innerHTML);
    url = document.getElementById("urldiv").innerHTML;
    path = document.getElementById("pathdiv").innerHTML;
    if(path.length > 1){
        pathset = true;
    }
    else{
        pathset = false;
    }
    if(url.length > 1){
        urlset = true;
    }
    else{
        urlset = false;
    }
    

    if(pathset){
        document.getElementById("linkerlink").href += "?path=" + path; 
        document.getElementById("alignerlink").href += "?path=" + path;
        document.getElementById("indexlink").href += "?path=" + path; 
    }
    
    W = innerWidth;
    for(var index = 0;index < duality.length;index++){
        var newimg = document.createElement("IMG");
        newimg.id = "i" + index.toString();
        newimg.className = "boximg";
        document.getElementById("page").appendChild(newimg);
        newimg.src = duality[index].src;
        newimg.style.left = (duality[index].x*W).toString() + "px";
        newimg.style.top = (duality[index].y*W).toString() + "px";
        newimg.style.width = (duality[index].w*W).toString() + "px";
        newimg.style.transform = "rotate(" + duality[index].angle.toString() + "deg)";
    }

boxes = document.getElementById("page").getElementsByClassName("boximg");
mc = new Hammer(document.getElementById("page"));
mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc.on("panleft panright panup pandown tap press", function(ev) {

    theta = Math.PI/4 +(ev.deltaX/200);
    redraw();

});    


redraw();
    
function redraw(){
    boxes[0].style.opacity = Math.cos(theta)*Math.cos(theta).toString();
    boxes[1].style.opacity = Math.sin(theta)*Math.sin(theta).toString();
    
}
</script>
<style>
#linktable{
    position:absolute;
    left:0px;
    top:0px;
    z-index:9999999;
}
#linktable img{
    width:40px;
    background-color:white;
}
#page{
    position:absolute;    
    left:0px;
    top:0px;
    right:0px;
    bottom:0px;
    z-index:2;
}
.boximg{
    position:absolute;
}

</style>
</body>
</html>
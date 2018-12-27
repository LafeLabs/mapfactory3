<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Aligner</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<script src = "https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
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
<div id = "pathdiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo $_GET['path'];
    }
?></div>
<div id = "datadiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo file_get_contents($_GET['path']);
    }
    else{
        echo file_get_contents("json/map.txt");        
    }
?></div>
<a id = "factorylink" href = "index.php" style = "position:absolute;left:10px;top:10px;z-index:4"><img src = "mapicons/mapfactory.svg" style = "width:50px"></a>


<div id = "page"></div>
<img id = "backbutton" class = "button" src = "mapicons/back.svg"/>
<img id = "fwdbutton" class = "button" src = "mapicons/fwd.svg"/>

<div id = "scalebar" class = "bar">SCALE</div>
<div id = "rotatebar" class = "bar">ROTATE</div>
<script>

    path = document.getElementById("pathdiv").innerHTML;
    if(path.length > 1){
        pathset = true;
        document.getElementById("factorylink").href += "?path=" + path;
    }
    else{
        pathset = false;
    }

    map = JSON.parse(document.getElementById("datadiv").innerHTML);
    W = innerWidth;
    for(var index = 0;index < map.length;index++){
        if(map[index].src.length > 0){
            var newimg = document.createElement("IMG");
            newimg.id = "i" + index.toString();
            newimg.className = "boximg";
            document.getElementById("page").appendChild(newimg);
            newimg.src = map[index].src;
            newimg.style.left = (map[index].x*W).toString() + "px";
            newimg.style.top = (map[index].y*W).toString() + "px";
            newimg.style.width = (map[index].w*W).toString() + "px";
            newimg.style.transform = "rotate(" + map[index].angle.toString() + "deg)";   
        }
        if(map[index].text != undefined && map[index].src.length == 0){
            if(map[index].text.length > 1){
                var newdiv = document.createElement("DIV");
                newdiv.className = "boximg";
                newdiv.style.borderTop = "solid";
                newdiv.innerHTML = map[index].text;
                newdiv.style.left = (map[index].x*W).toString() + "px";
                newdiv.style.top = (map[index].y*W).toString() + "px";
                newdiv.style.height = (map[index].w*W/map[index].text.length).toString() + "px";
                newdiv.style.width = (map[index].w*W).toString() + "px";
                newdiv.style.transform = "rotate(" + map[index].angle.toString() + "deg)";
                document.getElementById("page").appendChild(newdiv);
                newdiv.style.fontSize = (map[index].w*W/map[index].text.length).toString() + "px";
            }
        }
        if(map[index].src.length == 0){
            if(map[index].href.includes("scroll/index.php?filename=")){
                var newimg = document.createElement("IMG");
                newimg.id = "i" + index.toString();
                newimg.className = "boximg";
                document.getElementById("page").appendChild(newimg);
                newimg.src = "mapicons/scroll.svg";
                newimg.style.left = (map[index].x*W).toString() + "px";
                newimg.style.top = (map[index].y*W).toString() + "px";
                newimg.style.width = (map[index].w*W).toString() + "px";
                newimg.style.transform = "rotate(" + map[index].angle.toString() + "deg)";
            }
        }
    }
    boxes = document.getElementById("page").getElementsByClassName("boximg");
    mapIndex = 0;
    boxes[mapIndex].style.border = "solid";
    
    x = map[mapIndex].x;
    y = map[mapIndex].y;
    w = map[mapIndex].w;
    angle = map[mapIndex].angle;
    
mc = new Hammer(document.getElementById("page"));
mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc.on("panleft panright panup pandown tap press", function(ev) {

    map[mapIndex].x = (x*W + ev.deltaX)/W;
    map[mapIndex].y = (y*W + ev.deltaY)/W;
    
    boxes[mapIndex].style.left = (x*W + ev.deltaX).toString() + "px";
    boxes[mapIndex].style.top = (y*W + ev.deltaY).toString() + "px";

});    


mc1 = new Hammer(document.getElementById("scalebar"));
mc1.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc1.on("panleft panright panup pandown tap press", function(ev) {
    boxes[mapIndex].style.width = (ev.deltaX + w*W).toString() + "px";
    map[mapIndex].w = (ev.deltaX + w*W)/W;
    if(map[mapIndex].text != undefined && map[mapIndex].src.length == 0){
        if(map[mapIndex].text.length > 1){
            boxes[mapIndex].style.height = (map[mapIndex].w*W/map[mapIndex].text.length).toString() + "px";
            boxes[mapIndex].style.fontSize = (map[mapIndex].w*W/map[mapIndex].text.length).toString() + "px";
        }
    }
});

mc2 = new Hammer(document.getElementById("rotatebar"));
mc2.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc2.on("panleft panright panup pandown tap press", function(ev) {
    map[mapIndex].angle = angle + ev.deltaX*Math.PI/10;
    boxes[mapIndex].style.transform = "rotate(" + (angle + ev.deltaX*Math.PI/10).toString() + "deg)";


});

document.getElementById("fwdbutton").onclick = function(){
    boxes[mapIndex].style.border = "none";
    mapIndex++;
    if(mapIndex > boxes.length - 1){
        mapIndex = 0;
    }
    boxes[mapIndex].style.border = "solid";
    x = map[mapIndex].x;
    y = map[mapIndex].y;
    w = map[mapIndex].w;
    angle = map[mapIndex].angle;
    savemap();
}
document.getElementById("backbutton").onclick = function(){
    boxes[mapIndex].style.border = "none";
    mapIndex--;
    if(mapIndex < 0){
        mapIndex = boxes.length - 1;
    }
    boxes[mapIndex].style.border = "solid";
    x = map[mapIndex].x;
    y = map[mapIndex].y;
    w = map[mapIndex].w;
    angle = map[mapIndex].angle;
    savemap();
}


function savemap(){
    if(pathset){
        currentFile = path;
    }
    else{
        currentFile = "json/map.txt";
    }
    
    data = encodeURIComponent(JSON.stringify(map,null,"    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data=" + data + "&filename=" + currentFile);//send text to filesaver.php
}
</script>
<style>
.bar{
    position:absolute;
    height:50px;
    left:100px;
    right:100px;
    text-align:center;
    z-index:5;
    border-left:solid;
    border-right:solid;
    z-index:99999999;

}
#scalebar{
    bottom:50px;
    border-top:solid;
    border-bottom:solid;
}
#rotatebar{
    bottom:0px;
}
#page{
    position:absolute;
    left:0px;
    top:0px;
    right:0px;
    bottom:0px;
}
body{
    font-family:Helvetica;
    font-size:24px;
}
input{
    font-family:courier;
    font-size:20px;
}

    .button{
        cursor:pointer;
    }
    .button:hover{
        background-color:green;
    }
    .button:active{
        background-color:yellow;
    }
 .boximg{
     position:absolute;
     z-index:-1;
 }   
 #backbutton{
     position:absolute;
     left:0px;
     bottom:0px;
     width:100px;
     height:100px;
     z-index:99999999;

 }
 #fwdbutton{
     position:absolute;
     right:0px;
     bottom:0px;
     width:100px;
     height:100px;
     z-index:99999999;

 }

</style>
</body>
</html>
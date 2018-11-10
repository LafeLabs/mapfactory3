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
        echo file_get_contents("json/meme.txt");        
    }
?></div>
<a id = "factorylink" href = "index.php" style = "position:absolute;left:10px;top:10px;z-index:4"><img src = "mapicons/memefactory.svg" style = "width:50px"></a>

<img id = "savebutton" class = "button" src = "mapicons/memesave.svg" style = "width:80px;position:absolute;right:10px;top:10px;z-index:999999999"/>

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

    meme = JSON.parse(document.getElementById("datadiv").innerHTML);

    W = innerWidth;
    for(var index = 0;index < meme.length;index++){
        var newimg = document.createElement("IMG");
        newimg.id = "i" + index.toString();
        newimg.className = "boximg";
        document.getElementById("page").appendChild(newimg);
        newimg.src = meme[index].src;
        newimg.style.left = (meme[index].x*W).toString() + "px";
        newimg.style.top = (meme[index].y*W).toString() + "px";
        newimg.style.width = (meme[index].w*W).toString() + "px";
        newimg.style.transform = "rotate(" + meme[index].angle.toString() + "deg)";
    }
    boxes = document.getElementById("page").getElementsByClassName("boximg");
    memeIndex = 0;
    boxes[memeIndex].style.border = "solid";
    
    x = meme[memeIndex].x;
    y = meme[memeIndex].y;
    w = meme[memeIndex].w;
    angle = meme[memeIndex].angle;
    
mc = new Hammer(document.getElementById("page"));
mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc.on("panleft panright panup pandown tap press", function(ev) {

    meme[memeIndex].x = (x*W + ev.deltaX)/W;
    meme[memeIndex].y = (y*W + ev.deltaY)/W;
    
    boxes[memeIndex].style.left = (x*W + ev.deltaX).toString() + "px";
    boxes[memeIndex].style.top = (y*W + ev.deltaY).toString() + "px";

});    


mc1 = new Hammer(document.getElementById("scalebar"));
mc1.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc1.on("panleft panright panup pandown tap press", function(ev) {
    boxes[memeIndex].style.width = (ev.deltaX + w*W).toString() + "px";
    meme[memeIndex].w = (ev.deltaX + w*W)/W;
    
});

mc2 = new Hammer(document.getElementById("rotatebar"));
mc2.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc2.on("panleft panright panup pandown tap press", function(ev) {
    meme[memeIndex].angle = angle + ev.deltaX*Math.PI/10;
    boxes[memeIndex].style.transform = "rotate(" + (angle + ev.deltaX*Math.PI/10).toString() + "deg)";


});

document.getElementById("fwdbutton").onclick = function(){
    boxes[memeIndex].style.border = "none";
    memeIndex++;
    if(memeIndex > boxes.length - 1){
        memeIndex = 0;
    }
    boxes[memeIndex].style.borderRight = "solid";
    
   // boxes[memeIndex].style.outline =  "solid";
    x = meme[memeIndex].x;
    y = meme[memeIndex].y;
    w = meme[memeIndex].w;
    angle = meme[memeIndex].angle;
    savememe();
}
document.getElementById("backbutton").onclick = function(){
    boxes[memeIndex].style.border = "none";
    memeIndex--;
    if(memeIndex < 0){
        memeIndex = boxes.length - 1;
    }
    boxes[memeIndex].style.borderRight = "solid";
    x = meme[memeIndex].x;
    y = meme[memeIndex].y;
    w = meme[memeIndex].w;
    angle = meme[memeIndex].angle;
    savememe();
}


function savememe(){
    if(pathset){
        currentFile = path;
    }
    else{
        currentFile = "json/meme.txt";
    }
    
    data = encodeURIComponent(JSON.stringify(meme,null,"    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data=" + data + "&filename=" + currentFile);//send text to filesaver.php
}

document.getElementById("savebutton").onclick = function(){
    timestamp = Math.round(Date.now()/1000).toString();
    currentFile = "memes/meme" + timestamp + ".txt";   
    data = encodeURIComponent(JSON.stringify(meme,null,"    "));
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
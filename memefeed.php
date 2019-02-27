<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Meme Factory</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
</head>
<body>
<div id = "imgurls" style = "display:none;"><?php

    echo file_get_contents("json/imgurls.txt");
    
?></div>
<div id = "mapicons" style = "display:none;"><?php

$files = scandir(getcwd()."/mapicons");
$listtext = "";
foreach($files as $value){
    if($value != "." && $value != ".."){
        $listtext .= $value.",";
    }
}
echo $listtext;
    
?></div>
<div id = "symbols" style = "display:none;"><?php

$files = scandir(getcwd()."/symbol/svg");
$listtext = "";
foreach($files as $value){
    if(substr($value,-4) == ".svg"){
        $listtext .= "symbol/svg/".$value.",";
    }
}
echo $listtext;


$dirs = scandir(getcwd()."/symbol/symbols");
foreach($dirs as $symboldir){
    if($symboldir != "." && $symboldir != ".."){
        $files = scandir(getcwd()."/symbol/symbols/".$symboldir."/svg");
        $listtext = "";
        foreach($files as $value){
            if(substr($value,-4) == ".svg"){
                $listtext .= "symbol/symbols/".$symboldir."/svg/".$value.",";
            }
        }
        echo $listtext;
    }
}


?></div>
<div id = "curves" style = "display:none;"><?php

$files = scandir(getcwd()."/curve/svg");
$listtext = "";
foreach($files as $value){
    if(substr($value,-4) == ".svg"){
        $listtext .= $value.",";
    }
}
echo $listtext;
    
?></div>
<div id = "uploadimages" style = "display:none;"><?php

$files = scandir(getcwd()."/uploadimages");
$listtext = "";
foreach($files as $value){
    if($value != "." && $value != ".." && substr($value,-4) != ".txt"){
        $listtext .= $value.",";
    }
}
echo $listtext;
    
?></div>

<a href = "index.php" id = "backlink">BACK</a>
<div id = "imagescroll"></div>

<img id = "bottomimage" style = "display:none"/>
<img id = "topimage" style = "display:none"/>

<canvas id = "mainCanvas"></canvas>

<div class = "bar" id = "scalebar">S C A L E</div>
<div class = "bar" id = "rotatebar">R O T A T E</div>
    
<script>

    document.getElementById("mainCanvas").width = 0.65*innerWidth;
    document.getElementById("mainCanvas").height = innerHeight - 250;
    
    bottomImage = "";
    topImage = "";
    currentImage = "";
    imageLayer = 0;

    imgurls = JSON.parse(document.getElementById("imgurls").innerHTML);
    mapicons = document.getElementById("mapicons").innerHTML.split(",");
    uploadimages = document.getElementById("uploadimages").innerHTML.split(",");
    symbols = document.getElementById("symbols").innerHTML.split(",");
    curves = document.getElementById("curves").innerHTML.split(",");    
    for(var index = 0;index < uploadimages.length - 1;index++){
        imgurls.push("uploadimages/" + uploadimages[index]);
    }
    
    for(var index = 0;index < symbols.length - 1;index++){
        imgurls.push(symbols[index]);
    }
    for(var index = 0;index < curves.length - 1;index++){
        imgurls.push("curve/svg/" + curves[index]);
    }
    for(var index = 0;index < mapicons.length - 1;index++){
        imgurls.push("mapicons/" + mapicons[index]);
    }
    


    for(var index = 0;index < imgurls.length; index++){
        var newimg = document.createElement("IMG");
        newimg.src = imgurls[index];
        newimg.className = "button";
        document.getElementById("imagescroll").appendChild(newimg);
        newimg.onclick = function(){
            currentImage = this.src;

        }
    }
    
    
/*

mc = new Hammer(document.getElementById("pagebox"));
mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc.on("panleft panright panup pandown tap press", function(ev) {

    map[map.length - 1].x = (0.5*w + ev.deltaX)/w;
    map[map.length - 1].y = (0.25*w + ev.deltaY)/w;
    
    document.getElementById("a" + (map.length - 1).toString()).style.left = (0.5*w + ev.deltaX).toString() + "px";
    document.getElementById("a" + (map.length - 1).toString()).style.top = (0.25*w + ev.deltaY).toString() + "px";

});    

*/
    
</script>
<style>

body{
    font-family:Helvetica;
    font-size:24px;
}
#imagescroll{
        position:absolute;
        left:0%;
        right:70%;
        top:110px;
        bottom:10px;
        border:solid;
        border-width:3px;
        border-radius:10px;
        overflow:scroll;
}
#imagescroll img{
    width:50%;
    display:block;
    margin:auto;
}
.button{
    cursor:pointer;

}
.button:hover{
    background-color:#a0ffa0;
}
.button:active{
    background-color:yellow;
}
#backlink{
    position:absolute;
    left:10px;
    top:10px;
}
#mainCanvas{
    position:absolute;
    right:0px;
    top:100px;
    z-index:-1;
}
.bar{
    position:absolute;
    height:50px;
    left:35%;
    right:0px;
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

</style>
</body>
</html>
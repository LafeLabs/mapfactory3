<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Adder</title>

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

$files = scandir(getcwd()."../symbol/svg");
$listtext = "";
foreach($files as $value){
    if(substr($value,-4) == ".svg"){
        $listtext .= "../symbol/svg/".$value.",";
    }
}
echo $listtext;


$dirs = scandir(getcwd()."../symbol/symbols");
foreach($dirs as $symboldir){
    if($symboldir != "." && $symboldir != ".."){
        $files = scandir(getcwd()."../symbol/symbols/".$symboldir."/svg");
        $listtext = "";
        foreach($files as $value){
            if(substr($value,-4) == ".svg"){
                $listtext .= "../symbol/symbols/".$symboldir."/svg/".$value.",";
            }
        }
        echo $listtext;
    }
}


?></div>
<div id = "curves" style = "display:none;"><?php

$files = scandir(getcwd()."../curve/svg");
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
<a id = "factorylink" href = "index.php" style = "position:absolute;left:10px;top:10px"><img src = "mapicons/memefactory.svg" style = "width:50px"></a>

<table id = "maintable">
    <tr>
        <td id = "gobutton"><img style = "width:100px;" class = "button" src = "mapicons/gobutton.svg"></td>
        <td>
            <img style = "width:100px" id = "mainimage"/>
        </td>
        <td id = "savebutton"><img style = "width:100px" class = "button" src = "mapicons/add.svg"/></td>
    </tr>
    <tr>
        <td>imgurl:<td><input id = "imgurlinput"></td>
    </tr>
</table>

<div id = "pagebox">    
    <div id = "page"></div>    
</div>


<div id = "imagescroll"></div>
<style>
body{
    font-family:Helvetica;
    font-size:24px;
}
input{
    font-family:courier;
    font-size:20px;
}

    #imagescroll{
        position:absolute;
        left:70%;
        right:10px;
        top:110px;
        bottom:10px;
        border:solid;
        border-color:yellow;
        border-width:5px;
        overflow:scroll;
    }
    #imagescroll img{
        width:50%;
        display:block;
        margin:auto;
    }
    #maintable{
        position:absolute;
        width:25%;
        left:30%;
        top:110px;
    }
    #pagebox{
        position:absolute;
        width:30%;
        left:30%;
        height:50%;
        bottom:0px;
        border:solid;
        z-index:10;
    }
    #page{
        position:absolute;
        left:0px;
        right:0px;
        top:0px;
        bottom:0px;
    }
    .button{
        cursor:pointer;
        border:solid;
        margin-top:1em;
        margin-bottom:1em;
    }
    .button:hover{
        background-color:#a0ffa0;
    }
    .button:active{
        background-color:yellow;
    }
    .linkbox{
        position:absolute;
    }
    .linkbox img{
        position:absolute;
        left:0px;
        top:0px;
        width:100%;
    }

</style>

<script>
    path = document.getElementById("pathdiv").innerHTML;
    if(path.length > 1){
        pathset = true;
        document.getElementById("factorylink").href += "?path=" + path;
    }
    else{
        pathset = false;
    }
    

    imgurls = JSON.parse(document.getElementById("imgurls").innerHTML);
    meme = JSON.parse(document.getElementById("datadiv").innerHTML);
    mapicons = document.getElementById("mapicons").innerHTML.split(",");
    
    uploadimages = document.getElementById("uploadimages").innerHTML.split(",");
    for(var index = 0;index < uploadimages.length - 1;index++){
        imgurls.push("uploadimages/" + uploadimages[index]);
    }
    
    symbols = document.getElementById("symbols").innerHTML.split(",");
    for(var index = 0;index < symbols.length - 1;index++){
        imgurls.push(symbols[index]);
    }
    curves = document.getElementById("curves").innerHTML.split(",");
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
            document.getElementById("imgurlinput").value = this.src;
            document.getElementById("mainimage").src = this.src;
        }
    }
    
    w = parseInt(getComputedStyle(document.getElementById("page")).width);

    for(var index = 0;index < meme.length;index++){
        var newimg = document.createElement("IMG");
        newimg.id = "i" + index.toString();
        document.getElementById("page").appendChild(newimg);
        newimg.src = meme[index].src;
        newimg.style.position = "absolute";
        newimg.style.left = (meme[index].x*w).toString() + "px";
        newimg.style.top = (meme[index].y*w).toString() + "px";
        newimg.style.width = (meme[index].w*w).toString() + "px";
        newimg.style.transform = "rotate(" + meme[index].angle.toString() + "deg)";

    }
    
    document.getElementById("gobutton").onclick = function(){
        var newjson = {}
        newjson.w = 0.1;
        newjson.x = 0.5;
        newjson.y = 0.25;
        newjson.angle = 0;
        newjson.src = document.getElementById("imgurlinput").value;
        meme.push(newjson);
        var newimg = document.createElement("IMG");
        newimg.id = "i" + (meme.length - 1).toString();
        document.getElementById("page").appendChild(newimg);
        newimg.src = newjson.src;
        newimg.style.position = "absolute";
        newimg.style.left = (newjson.x*w).toString() + "px";
        newimg.style.top = (newjson.y*w).toString() + "px";
        newimg.style.width = (newjson.w*w).toString() + "px";
        newimg.style.transform = "rotate(" + newjson.angle.toString() + "deg)";
        
    }
    
    document.getElementById("savebutton").onclick = function(){
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


mc = new Hammer(document.getElementById("pagebox"));
mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc.on("panleft panright panup pandown tap press", function(ev) {

    meme[meme.length - 1].x = (0.5*w + ev.deltaX)/w;
    meme[meme.length - 1].y = (0.25*w + ev.deltaY)/w;
    
    document.getElementById("i" + (meme.length - 1).toString()).style.left = (0.5*w + ev.deltaX).toString() + "px";
    document.getElementById("i" + (meme.length - 1).toString()).style.top = (0.25*w + ev.deltaY).toString() + "px";

});    

    
</script>

</body>
</html>
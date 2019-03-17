<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Linker</title>

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
        echo file_get_contents("json/map.txt");        
    }
?></div>
<div id = "linkdatadiv" style = "display:none"><?php

    echo file_get_contents("json/links.txt");

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
        $listtext .= "curve/svg/".$value.",";
    }
}
echo $listtext;
    

$dirs = scandir(getcwd()."/curve/curves");
foreach($dirs as $symboldir){
    if($symboldir != "." && $symboldir != ".."){
        $files = scandir(getcwd()."/curve/curves/".$symboldir."/svg");
        $listtext = "";
        foreach($files as $value){
            if(substr($value,-4) == ".svg"){
                $listtext .= "curve/curves/".$symboldir."/svg/".$value.",";
            }
        }
        echo $listtext;
    }
}


?></div>
<div id = "maps" style = "display:none;"><?php

$files = scandir(getcwd()."/maps");
$listtext = "";
foreach($files as $value){
    if($value != "." && $value != ".."){
        $listtext .= $value.",";
    }
}
echo $listtext;
    
?></div>
<div id = "scrolls" style = "display:none;"><?php

$files = scandir(getcwd()."/scroll/markdown");
$listtext = "";
foreach($files as $value){
    if($value != "." && $value != ".."){
        $listtext .= $value.",";
    }
}
echo $listtext;
    
?></div>
<div id = "memes" style = " display:none"><?php

$files = scandir(getcwd()."/memefactory/memes");
$listtext = "";
foreach($files as $value){
    if($value != "." && $value != ".."){
        $listtext .= $value.",";
    }
}
echo $listtext;


?></div>
<div id = "phpfiles" style = "display:none;"><?php

$files = scandir(getcwd());
$listtext = "";
foreach($files as $value){
    if(substr($value,-4) == ".php"){
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
<div id = "textfeeddata" style = "display:none;" class = "no-mathjax"><?php

$files = scandir(getcwd()."/textfeed");

foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".."){
        $listtext .= $value.",";
        echo "\n<p>".file_get_contents("textfeed/".$value)."</p>\n";
    }
}

$files = scandir(getcwd()."/scroll/textfeed");

foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".."){
        $listtext .= $value.",";
        echo "\n<p>".file_get_contents("scroll/textfeed/".$value)."</p>\n";
    }
}

    
?></div>

<a id = "factorylink" href = "index.php" style = "position:absolute;left:10px;top:10px"><img src = "mapicons/mapfactory.svg" style = "width:50px"></a>

<div id = "linkscroll"></div>
<table id = "maintable">
    <tr>
        <td id = "gobutton"><img style = "width:100px;" class = "button" src = "mapicons/gobutton.svg"></td>
        <td>
            <img style = "width:100px" id = "mainimage"/>
        </td>
        <td id = "savebutton"><img style = "width:100px" class = "button" src = "mapicons/linker.svg"/></td>
    </tr>
    <tr>
        <td>imgurl:</td><td><input id = "imgurlinput"></td>
    </tr>
    <tr>
        <td>href:</td><td><input id = "hrefinput"></td>
    </tr>
    <tr>
        <td>text:</td><td><input id = "textinput"/></td>
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
    #linkscroll{
        position:absolute;
        overflow:scroll;
        left:10px;
        right:75%;
        bottom:10px;
        top:110px;
        border:solid;
        border-color:blue;
        border-width:5px;
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
    
    links = JSON.parse(document.getElementById("linkdatadiv").innerHTML);

    imgurls = JSON.parse(document.getElementById("imgurls").innerHTML);
    if(document.getElementById("datadiv").innerHTML.length>1){
        map = JSON.parse(document.getElementById("datadiv").innerHTML);
    }
    else{
        map = [];
    }

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
        imgurls.push(curves[index]);
    }
    
    for(var index = 0;index < mapicons.length - 1;index++){
        imgurls.push("mapicons/" + mapicons[index]);
    }
    
    maps = document.getElementById("maps").innerHTML.split(",");
    for(var index = 0;index < maps.length - 1;index++){
        links.push("index.php?path=maps/" + maps[index]);
    }
    scrolls = document.getElementById("scrolls").innerHTML.split(",");

    for(var index = 0;index < scrolls.length - 1;index++){
        links.push("scroll/index.php?filename=" + scrolls[index]);
    }

    phpfiles = document.getElementById("phpfiles").innerHTML.split(",");
    for(var index = 0;index < phpfiles.length - 1;index++){
        links.push(phpfiles[index]);
    }
    memes = document.getElementById("memes").innerHTML.split(",");
    for(var index = 0;index < memes.length;index++){
        links.push("memefactory/index.php?path=memes/" + memes[index]);
    }
    

    
    
    for(var index = 0;index < links.length; index++){
        var newp = document.createElement("P");
        newp.innerHTML = links[index];
        newp.className = "button";
        document.getElementById("linkscroll").appendChild(newp);
        newp.onclick = function(){
            document.getElementById("hrefinput").value = this.innerHTML;
        }
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
    
    texts = document.getElementById("textfeeddata").getElementsByTagName("p");
    for(var index = 0;index < texts.length;index++){
        var newp = document.createElement("P");
        newp.innerHTML = texts[index].innerHTML;
        newp.className = "button";
        newp.onclick = function(){
            document.getElementById("textinput").value = this.innerHTML;
            document.getElementById("imgurlinput").value = "";
            document.getElementById("mainimage").src = "";
        }
        document.getElementById("imagescroll").appendChild(newp);

    }
    
    w = parseInt(getComputedStyle(document.getElementById("page")).width);

    for(var index = 0;index < map.length;index++){
        var newimg = document.createElement("IMG");
        var newa = document.createElement("A");
        newa.className = "linkbox";
        newa.appendChild(newimg);
        newa.id = "a" + index.toString();
        newa.href = map[index].href;
        newimg.id = "i" + index.toString();
        document.getElementById("page").appendChild(newa);

        newimg.src = map[index].src;
        if(map[index].text != undefined){
            if(map[index].text.length > 0){
                newimg.src = "mapicons/textfeed.svg";
            }
        }

        newa.style.left = (map[index].x*w).toString() + "px";
        newa.style.top = (map[index].y*w).toString() + "px";
        newa.style.width = (map[index].w*w).toString() + "px";
        newa.style.transform = "rotate(" + map[index].angle.toString() + "deg)";
        newimg.onload = function(){
            this.parentElement.style.height = (this.height).toString() + "px";
        }
    }
    
    document.getElementById("gobutton").onclick = function(){
        var newjson = {}
        newjson.w = 0.1;
        newjson.x = 0.5;
        newjson.y = 0.25;
        newjson.angle = 0;
        newjson.src = document.getElementById("imgurlinput").value;
        newjson.href = document.getElementById("hrefinput").value;
        newjson.text = document.getElementById("textinput").value;
        map.push(newjson);
            var newimg = document.createElement("IMG");
        var newa = document.createElement("A");
        newa.className = "linkbox";
        newa.appendChild(newimg);
        newa.id = "a" + (map.length - 1).toString();
        newa.href = newjson.href;
        newimg.id = "i" + (map.length - 1).toString();
        document.getElementById("page").appendChild(newa);
        if(document.getElementById("textinput").value.length > 0){
            newimg.src = "mapicons/textfeed.svg";
        }
        else{
            newimg.src = newjson.src;
        }
        newa.style.left = (newjson.x*w).toString() + "px";
        newa.style.top = (newjson.y*w).toString() + "px";
        newa.style.width = (newjson.w*w).toString() + "px";
        newa.style.transform = "rotate(" + newjson.angle.toString() + "deg)";
        newimg.onload = function(){
            this.parentElement.style.height = (this.height).toString() + "px";
        }
        
    }
    
    document.getElementById("savebutton").onclick = function(){
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


mc = new Hammer(document.getElementById("pagebox"));
mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc.on("panleft panright panup pandown tap press", function(ev) {

    map[map.length - 1].x = (0.5*w + ev.deltaX)/w;
    map[map.length - 1].y = (0.25*w + ev.deltaY)/w;
    
    document.getElementById("a" + (map.length - 1).toString()).style.left = (0.5*w + ev.deltaX).toString() + "px";
    document.getElementById("a" + (map.length - 1).toString()).style.top = (0.25*w + ev.deltaY).toString() + "px";

});    

    
</script>

</body>
</html>
<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Map Feed</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

</head>
<body>
<div id = "filesdiv" style = "display:none"><?php

$files = scandir(getcwd()."/maps");
$listtext = "";
foreach($files as $value){
    if(substr($value,-4) == ".txt"){
        $listtext .= "maps/".$value;
        $listtext .= ",\n";
    }
}

$listtext = rtrim($listtext, ",\n");

echo $listtext;

?></div>
<div id = "datadiv" style = "display:none"><?php

$files = scandir(getcwd()."/maps");
$listtext = "[\n";
foreach($files as $value){
    if(substr($value,-4) == ".txt"){
        $listtext .= file_get_contents("maps/".$value);
        $listtext .= ",\n";
    }
}

$listtext = rtrim($listtext, ",\n");
$listtext .= "\n]";

echo $listtext;

?></div>

<a href = "index.php" style = "position:absolute;left:10px;top:10px;z-index:4"><img src = "mapicons/mapfactory.svg" style = "width:50px"></a>

<table id = "newmaptable">
    <tr>
        <td>
            NEW MAP NAME:
        </td>
        <td>
            <input id = "newmapname"/>
        </td>
    </tr>
    <tr id = "newmaprow">
        <td>
            LINK TO NEW MAP LINKER:
        </td>
        <td><a id = "newmaplink"></a></td>
    </tr>
</table>

<div id = "memefeed"></div>

<script>

document.getElementById("newmapname").onchange = function(){
    var newname = this.value;
    if(newname.substr(-4) != ".txt"){
        newname += ".txt";
    }
    document.getElementById("newmaprow").style.display = "block";
    document.getElementById("newmaplink").innerHTML = "linker.php?path=maps/" + newname;
    document.getElementById("newmaplink").href = "linker.php?path=maps/" + newname;
}

memes = JSON.parse(document.getElementById("datadiv").innerHTML);
files = document.getElementById("filesdiv").innerHTML.split(",");

W = innerWidth*0.6;

for(var mindex = memes.length - 1;mindex >= 0;mindex--){
    var newdiv = document.createElement("DIV");
    newdiv.style.width = (W).toString()  + "px";
    newdiv.style.height = (1.2*W).toString()  + "px";
    newdiv.style.position = "relative";
    document.getElementById("memefeed").appendChild(newdiv);
    for(var index = 0;index < memes[mindex].length;index++){
        var newimg = document.createElement("IMG");
        newimg.src = memes[mindex][index].src;
        newimg.style.position = "absolute";
        newdiv.appendChild(newimg);
        newimg.style.width = (memes[mindex][index].w*W).toString() + "px";
        newimg.style.left = (memes[mindex][index].x*W).toString() + "px";
        newimg.style.top = (memes[mindex][index].y*W).toString() + "px";
        newimg.style.transform = "rotate(" + (memes[mindex][index].angle).toString() + "deg)";
    }
    var newa = document.createElement("a");
    var newimg = document.createElement("img");
    newa.className = "editlink";
    newimg.src = "mapicons/editor.svg";
    newa.href = "index.php?path=" + files[mindex];
    newa.appendChild(newimg);
    newdiv.appendChild(newa);


}
</script>
<style>
body{
    font-family:Helvetica;
    font-size:24px;
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
#memefeed{
    position:absolute;
    top:110px;
    bottom:0px;
    overflow:scroll;
    left:20%;
    right:20%;
}
.editlink{
    position:absolute;
    top:0px;
    left:0px;
    width:80px;
}
.editlink img{
    width:100%;
}
.deletebutton{
    position:absolute;
    top:0px;
    right:80px;
    width:80px;
}
.deletebutton img{
    width:100%;
}
#newmaptable{
    position:absolute;
    left:200px;
    top:10px;
}
#newmapname{
    width:10em;
}
#newmaprow{
    display:none;
}
</style>
</body>
</html>
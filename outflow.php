<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Outflow</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
</head>
<body>
<div id = "inflow" style = "display:none;"><?php
    echo file_get_contents("json/inflow.txt");
?></div>
<div id = "outflow" style = "display:none;"><?php
    echo file_get_contents("json/outflow.txt");        
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

<table id = "toptable">
    <tr>
        <td>
            <a href = "index.php">
                <img src = "mapicons/mapfactory.svg" style = "width:50px">
            </a>
        </td>
        <td>name of new thing:</td>
        <td><input id = "thingname"/></td>
        <td id = "gobutton"></td>                
    </tr>
</table>


<div id = "scrollscroll"></div>
<div id = "mapscroll"></div>
<div id = "symbolscroll"></div>
<div id = "thingscroll"></div>
<div id = "outscroll"></div>

<script>

    outflow = JSON.parse(document.getElementById("inflow").innerHTML);
    inflow = JSON.parse(document.getElementById("outflow").innerHTML);
    scrolls = document.getElementById("scrolls").innerHTML.split(",");

    currentthing = [];
    
    for(var index = 0;index < scrolls.length - 1;index++){
        var newp = document.createElement("p");
        newp.innerHTML = "scroll/markdown/" + scrolls[index];
        newp.classList.add("button");
        newp.classList.add("scrollp");
        document.getElementById("scrollscroll").appendChild(newp);
        newp.onclick = function(){
            var newp = document.createElement("p");
            newp.innerHTML = this.innerHTML;
            document.getElementById("thingscroll").appendChild(newp);
            var newimg = document.createElement("IMG");
            newimg.classList.add("deletebutton");
            newp.appendChild(newimg);
            newimg.src = "mapicons/deletex.svg"; 
            newimg.onclick = function(){
                document.getElementById("thingscroll").removeChild(this.parentNode);
            }
        }
    }


    symbols = document.getElementById("symbols").innerHTML.split(",");
    for(var index = 0;index < symbols.length - 1;index++){
        var newimg = document.createElement("IMG");
        newimg.src = symbols[index];
        document.getElementById("symbolscroll").appendChild(newimg);
        newimg.onclick = function(){
            var newp = document.createElement("P");
            newp.classList.add("symbolp");
            var newimg = document.createElement("IMG");
            newimg.src = this.src;
            newp.appendChild(newimg);
            document.getElementById("thingscroll").appendChild(newp);
            var dimg = document.createElement("IMG");
            dimg.classList.add("deletebutton");
            newp.appendChild(dimg);
            dimg.src = "mapicons/deletex.svg"; 
            dimg.onclick = function(){
                document.getElementById("thingscroll").removeChild(this.parentNode);
            }
        }
    }
    
    maps = document.getElementById("maps").innerHTML.split(",");
    for(var index = 0;index < maps.length - 1;index++){
        var newp = document.createElement("p");
        newp.innerHTML = "maps/" + maps[index];
        newp.classList.add("button");
        newp.classList.add("mapp");
        document.getElementById("mapscroll").appendChild(newp);
        newp.onclick = function(){
            var newp = document.createElement("p");
            newp.innerHTML = this.innerHTML;
            document.getElementById("thingscroll").appendChild(newp);
            var newimg = document.createElement("IMG");
            newimg.classList.add("deletebutton");
            newp.appendChild(newimg);
            newimg.src = "mapicons/deletex.svg"; 
            newimg.onclick = function(){
                document.getElementById("thingscroll").removeChild(this.parentNode);
            }
        }
    }

document.getElementById("gobutton").onclick = function(){
    
}

</script>


<style>

input{
    font-family:courier;
    font-size:20px;
}

#scrollscroll{
    position:absolute;
    overflow:scroll;
    left:10px;
    width:35%;
    bottom:70%;
    top:80px;
    border:solid;
    border-width:3px;
    border-radius:10px;
}
#mapscroll{
    position:absolute;
    overflow:scroll;
    left:10px;
    width:35%;
    bottom:35%;
    top:31%;
    border:solid;
    border-width:3px;
    border-radius:10px;
}
#symbolscroll{
    position:absolute;
    overflow:scroll;
    left:10px;
    width:35%;
    bottom:5px;
    top:67%;    
    border:solid;
    border-width:3px;
    border-radius:10px;
}

#thingscroll{
    position:absolute;
    overflow:scroll;
    left:37%;
    width:30%;
    bottom:10px;
    top:80px;
    border:solid;
    border-width:3px;
    border-radius:10px;
}
#thingscroll img{
    display:block;
    max-width:50%;
    margin:auto;
}

#outscroll{
    position:absolute;
    overflow:scroll;
    right:5px;
    width:30%;
    bottom:10px;
    top:80px;
    border:solid;
    border-width:3px;
    border-radius:10px;
}
.scrollp{
    border:solid;
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
.deletebutton{
    width:20px;
    border:solid;
    cursor:pointer;
    text-align:right;
}
.deletebutton:hover{
    background-color:green;
}
.deletebutton:active{
    background-color:yellow;
}

#symbolscroll img{
    display:block;
    max-width:50%;
    margin:auto;
    cursor:pointer;
}
#symbolscroll img:hover{
    background-color:green;
}
#symbolscroll img:active{
    background-color:yellow;
}
#toptable{
    position:absolute;
    left:5px;
    top:5px;
    font-family:courier;
    font-size:14px;
}
#thingscroll p{
    border:solid;
}
#gobutton{
    width:40px;
    height:40px;
    background-color:#00ff00;
    border-radius:40%;
    border:solid;
    cursor:pointer;
}
#gobutton:hover{
    background-color:green;
}
#gobutton:active{
    background-color:yellow;
}
</style>

</body>
</html>
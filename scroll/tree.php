<!doctype html>
<html>
<head>
<title>Tree</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

NO MONEY
NO MINING
NO PROPERTY

LOOK AT THE INSECTS
LOOK AT THE FUNGI
LANGUAGE IS HOW THE MIND PARSES REALITY

-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
</head>
<body>
<div id = "dirlistdiv" style = "display:none"><?php

$files = scandir(getcwd()."/markdown");
foreach($files as $value){
    if($value != "." && $value != ".."){
        echo $value.",";
    }
}

?></div>

<table id  = "linktable">
    <tr>
        <td><a href = "editor.php">
                <img  style = "width:80px" src = "icons/editor.svg"/>
            </a></td>
        <td><a href = "index.php">
            <img style = "width:80px" src = "../mapicons/scroll.svg"/>
        </a></td>
    </tr>
</table>

<table id = "maintable">
    <tr>
        <td>filename:</td>
        <td>
            <input id = "nameinput"/>
        </td>
        <td class = "button" id = "newbutton">CREATE NEW SCROLL</td>
    </tr>
</table>

    <h1>SCROLLS</h1>

<ul id = "dirlinklist">
    
</ul>

<script>

dirlist = document.getElementById("dirlistdiv").innerHTML.split(",");
for(var index = 0;index < dirlist.length - 1;index++){
    var newli = document.createElement("LI");
    var newa = document.createElement("A");
    newa.innerHTML = dirlist[index];
    newa.href = "index.php?filename=" + dirlist[index];
    newli.appendChild(newa);
    document.getElementById("dirlinklist").appendChild(newli);
}


document.getElementById("newbutton").onclick = function(){
    path = document.getElementById("nameinput").value;
    if(path.length > 0){
        var newli = document.createElement("LI");
        var newa = document.createElement("A");
        newa.innerHTML = path;
        newa.href = "index.php?filename=" + path;
        newli.appendChild(newa);
        document.getElementById("dirlinklist").appendChild(newli); 
        
    }

}

</script>
<style>
    body{
        font-size:24px;
        font-family:Helvetica;
    }
    
    
#maintable{
    position:absolute;
    top:0px;
    left:0px;
}
#linktable{
    position:absolute;
    top:0px;
    right:0px;
}
    
    
.button{
    cursor:pointer;
    text-align:center;
    background-color:white;
    border-radius:0.5em;
    padding-left:2em;
    padding-right:2em;
    color:black;
    z-index:2;
}
.button:hover{
    background-color:green;
}
.button:active{
    background-color:yellow;
}
</style>

</body>
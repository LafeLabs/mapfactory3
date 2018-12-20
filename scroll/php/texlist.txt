<!doctype html>
<html>
<head>
<title>TeX List</title>
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

$files = scandir(getcwd()."/latex");
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

    <h1>tex files</h1>

<ul id = "texfileslinklist">
    
</ul>

<script>

dirlist = document.getElementById("dirlistdiv").innerHTML.split(",");
for(var index = 0;index < dirlist.length - 1;index++){
    if(dirlist[index].substring(dirlist[index].length - 4) == ".tex"){
        var newli = document.createElement("LI");
        var newa = document.createElement("A");
        newa.innerHTML = dirlist[index];
        newa.href = "texeditor.php?filename=" + dirlist[index];
        newli.appendChild(newa);
        document.getElementById("texfileslinklist").appendChild(newli);
    }

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
    
#linktable{
    position:absolute;
    top:0px;
    right:0px;
}
    
    
</style>
</body>
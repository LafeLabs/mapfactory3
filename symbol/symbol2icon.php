<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Symbol 2 Icon</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

</head>
<body>
<div id = "symbolsdiv" style = "display:none"><?php

$files = scandir(getcwd()."/svg");
$listtext = "";
foreach($files as $value){
    if(substr($value,-4) == ".svg"){
        $listtext .= $value.",";
    }
}
echo $listtext;

?></div>
<div id = "iconssdiv" style = "display:none"><?php

$files = scandir(getcwd()."/../mapicons");
$listtext = "";
foreach($files as $value){
    if(substr($value,-4) == ".svg"){
        $listtext .= $value.",";
    }
}
echo $listtext;

?></div>

<a href = "index.php" style = "position:absolute;left:10px;top:10px;z-index:4"><img src = "icons/geometron.svg" style = "width:50px"></a>

<img class = "button" src = "mapicons/gobutton.svg" id = "savebutton"/>

<table id = "maintable">
<tr>
    <td>NEW ICON NAME:</td>
    <td><input id = "nameinput"></td>
</tr>
</table>

<script>
    symbols = document.getElementById("symbolsdiv").innerHTML.split(",");

    icons = document.getElementById("iconsdiv").innerHTML.split(",");
    
    

document.getElementById("savebutton").onclick = function(){

    
}    
    

    
function saveicon(){

    name = document.getElementById("nameinput").value;
    data = encodeURIComponent(icon,null,"    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data=" + data + "&filename=../mapicons/" + name + ".svg");//send text to filesaver.php
}


</script>
<style>
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
#maintable{
    position:absolute;
    top:100px;
    left:0px;
}
#savebutton{
    position:absolute;
    right:0px;
    top:0px;
    width:100px;
}
</style>
</body>
</html>
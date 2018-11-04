<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Map 2 Link</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

</head>
<body>
<div id = "listdiv" style = "display:none"><?php

$files = scandir(getcwd()."/maps");
$listtext = "";
foreach($files as $value){
    if($value != "." && $value != ".."){
        $listtext .= $value.",";
    }
}
echo $listtext;

?></div>
<div id = "datadiv" style = "display:none"><?php

echo file_get_contents("json/map.txt");

?></div>

<a href = "index.php" style = "position:absolute;left:10px;top:10px;z-index:4"><img src = "mapicons/mapfactory.svg" style = "width:50px"></a>

<img class = "button" src = "mapicons/gobutton.svg" id = "savebutton"/>

<table id = "maintable">
<tr>
    <td>NEW NAME:</td>
    <td><input id = "nameinput"></td>
</tr>
</table>

<script>
    map = JSON.parse(document.getElementById("datadiv").innerHTML);

    maps = document.getElementById("listdiv").innerHTML.split(",");
    
    for(var index = 0;index < maps.length - 1;index++){
        var newtr = document.createElement("TR");
        var newtd = document.createElement("TD");
        var newa = document.createElement("A");
        newa.href =  "index.php?url=maps/" + maps[index];
        newa.innerHTML = maps[index];
        newtd.appendChild(newa);
        newtr.appendChild(newtd);
        document.getElementById("maintable").appendChild(newtr);
        
    }


document.getElementById("savebutton").onclick = function(){
    savemap();
}    
    
function savemap(){
    name = document.getElementById("nameinput").value;
    data = encodeURIComponent(JSON.stringify(map,null,"    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data=" + data + "&filename=maps/" + name + ".txt");//send text to filesaver.php
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
 <!doctype html>
<html>
<head>
 <!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE
NO MONEY
NO PROPERTY
NO MINING
EGO DEATH:
    LOOK TO THE INSECTS
    LOOK TO THE FUNGI
    LANGUAGE IS HOW THE MIND PARSES REALITY
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<title>Text Editor</title>
</head>
<body>
<div id = "filenamediv" style = "display:none"><?php

    if(isset($_GET['filename'])){
        echo $_GET['filename'];
    }
    else{
        echo "json/map.txt";
    }
?></div>
<table id = "linktable">
<tr>
    <td>
        <a id = "mapeditorlink" href = "mapeditor.php">
            <img src = "mapicons/mapeditor.svg"/>
        </a>
    </td>
    <td>
        <a href = "editor.php">
            <img src = "mapicons/editor.svg"/>
        </a>
    </td>
    <td>
        <a href = "index.php" id = "indexlink">
            <img src = "mapicons/mapfactory.svg"/>
        </a>
    </td>
</tr>    
</table>
<table>
    <tr>
        <td>filename:</td>
        <td><input id = "filenameinput"/></td>
    </tr>
</table>
<textarea id = "maintextarea"></textarea>

<script>

document.getElementById("maintextarea").style.height = (innerHeight - 150).toString() + "px";

currentFile = document.getElementById("filenamediv").innerHTML;

if(currentFile.substring(0,5) == "maps/"){
    document.getElementById("indexlink").href += "?path=" + currentFile;
    document.getElementById("mapeditorlink").href += "?path=" + currentFile;
    
}

var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        document.getElementById("maintextarea").value = filedata;
    }
};
httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
httpc.send();


document.getElementById("maintextarea").onkeyup = function(){
    data = this.value;
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
}

document.getElementById("filenameinput").onchange = function(){
    currentFile = this.value;
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            filedata = this.responseText;
            document.getElementById("maintextarea").value = filedata;
        }
    }
    httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
    httpc.send();
}

</script>
<style>
body{

    font-family:helvetica;
    font-size:18px;
}
#filenameinputtable{
    position:absolute;
    left:0px;
    top:0px;
}
#filenameinputtable td{
    background-color:white;
}
#maintextarea{
    position:absolute;
    top:100px;
    left:0px;
    background-color:black;
    font-family:courier;
    font-size:16px;
    color:#00ff00;
    width:90%;
}
#linktable{
    position:absolute;
    right:0px;
    top:0px;
}
#linktable img{
    width:80px;
    background-color:white;
}
</style>
</body>
</html>
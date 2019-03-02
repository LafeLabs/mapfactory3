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
    
to convert a pdf to a book format use
"pdfbook" command line utility
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
<title>PHP Editor replicator</title>
</head>
<body>
<div id = "filenamediv" style = "display:none"><?php

if(isset($_GET['filename'])){
    echo $_GET['filename'];
}
else{
    echo "scroll.tex";
}
    

?></div>
<table id = "linktable">
    <tr>
        <td>
            <a href = "tree.php">
            <img src = "icons/tree.svg"/>
            </a>
        </td>
        <td>
            <a id = "indexlink" href = "index.php">
            <img src = "../mapicons/scroll.svg"/>
            </a>
        </td>
        <td>
            <a href = "editor.php">
            <img src = "../mapicons/editor.svg"/>
            </a>
        </td>

    </tr>
</table>

<div id = "namediv"></div>
<div id="maineditor" contenteditable="true" spellcheck="false"></div>
<div id = "filescroll">

<?php

$files = scandir(getcwd()."/latex");
foreach($files as $value){
    if($value != "." && $value != ".." && substr($value,-4) == ".tex"){
        echo "<a href = \"texeditor.php?filename=".$value."\">".$value."</a>";
    }
}


?></div>

<script>

if(document.getElementById("filenamediv").innerHTML.length > 1){
    document.getElementById("indexlink").href += "?filename=" + document.getElementById("filenamediv").innerHTML.split(".tex")[0] + ".txt";
}

currentFile = "latex/" + document.getElementById("filenamediv").innerHTML;
var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        editor.setValue(filedata);
    }
};
httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
httpc.send();

document.getElementById("namediv").innerHTML = currentFile;
document.getElementById("namediv").style.color = "#0000ff";
document.getElementById("namediv").style.borderColor = "#0000ff";

editor = ace.edit("maineditor");
editor.setTheme("ace/theme/cobalt");
editor.getSession().setMode("ace/mode/latex");
editor.getSession().setUseWrapMode(true);
editor.$blockScrolling = Infinity;

document.getElementById("maineditor").onkeyup = function(){
    data = encodeURIComponent(editor.getSession().getValue());
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
    var fileType = currentFile.split("/")[0]; 
    var fileName = currentFile.split("/")[1];
}


</script>
<style>
#linktable{
    position:absolute;
    right:0px;
    top:0px;
    cursor:pointer;
}
#linktable img{
    width:80px;
}
#linktable img:hover{
    background-color:green;
}

#namediv{
    position:absolute;
    top:5px;
    left:20%;
    font-family:courier;
    padding:0.5em 0.5em 0.5em 0.5em;
    border:solid;
    background-color:#a0a0a0;

}
a{
    color:white;
    display:block;
    margin-bottom:0.5em;
    margin-left:0.5em;
}
body{
    background-color:#b0b0b0;
}

.file{
    cursor:pointer;
    border-radius:0.25em;
    border:solid;
    padding:0.25em 0.25em 0.25em 0.25em;
}
.files:hover{
    background-color:green;
}
.files:active{
    background-color:yellow;
}
#filescroll{
    position:absolute;
    overflow:scroll;
    top:200px;
    bottom:0%;
    right:0%;
    left:75%;
    border:solid;
    border-radius:5px;
    border-width:3px;
    background-color:#101010;
    font-family:courier;
    font-size:22px;
}


#maineditor{
    position:absolute;
    left:0%;
    top:5em;
    bottom:1em;
    right:30%;
    font-size:22px;
}

#pdflatexbutton{
    position:absolute;
    right:10px;
    top:10px;
    border:solid;
    background-color:white;
    border-radius:5px;
    cursor:pointer;
}
#pdflatexbutton:hover{
    background-color:green;
}
#pdflatexbutton:active{
    background-color:yellow;
}


</style>

</body>
</html>
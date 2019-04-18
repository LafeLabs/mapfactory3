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
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
<title>PHP Editor replicator</title>
</head>
<body>
<div id = "linkscroll">
    <a href = "text2php.php">text2php.php</a>
    <a href = "index.php">index.php</a>
    <a href = "copy.php">copy.php</a>
    <a href = "linker.php">linker.php</a>
    <a href = "aligner.php">aligner.php</a>
    <a href = "uploader.php">uploader.php</a>
    <a href = "linkfeed.php">linkfeed.php</a>
    <a href = "textfeed.php">textfeed.php</a>
    <a href = "mapfeed.php">mapfeed.php</a>
    <a href = "imagefeed.php">imagefeed.php</a>
    <a href = "mapeditor.php">mapeditor.php</a>
    <a href = "duality.php">duality.php</a>
    <a href = "outflow.php">outflow.php</a>
    <a href = "inflow.php">inflow.php</a>
    <a href = "texteditor.php">texteditor.php</a>

    <a href = "dnagenerator.php">dnagenerator.php</a>
</div>
<div id = "namediv"></div>
<div id="maineditor" contenteditable="true" spellcheck="false"></div>
<div id = "filescroll">

    <div class = "html file">html/index.txt</div>
    <div class = "php file">php/memefeed.txt</div>
    <div class = "php file">php/rget.txt</div>
    <div class = "php file">php/index.txt</div>
    <div class = "php file">php/editor.txt</div>
    <div class = "php file">php/texteditor.txt</div>
    <div class = "php file">php/replicator.txt</div>
    <div class = "php file">php/metareplicator.txt</div>
    <div class = "php file">php/filesaver.txt</div>
    <div class = "php file">php/fileloader.txt</div>
    <div class = "php file">php/text2php.txt</div>
    <div class = "php file">php/dnagenerator.txt</div>

    <div class = "php file">php/linkfeed.txt</div>
    <div class = "php file">php/mapfeed.txt</div>
    <div class = "php file">php/imagefeed.txt</div>
    <div class = "php file">php/duality.txt</div>
    <div class = "php file">php/uploader.txt</div>
    <div class = "php file">php/upload.txt</div>
    <div class = "php file">php/linker.txt</div>
    <div class = "php file">php/aligner.txt</div>
    <div class = "php file">php/mapeditor.txt</div>
    <div class = "php file">php/newmapfactory.txt</div>

    <div class = "php file">php/copy.txt</div>
    <div class = "php file">php/textfeed.txt</div>
    <div class = "php file">php/deletefile.txt</div>

    <div class = "php file">php/flow.txt</div>
    <div class = "php file">php/outflow.txt</div>
    <div class = "php file">php/inflow.txt</div>

    <div class = "php file">symbol/replicator.php</div>
    <div class = "php file">scroll/replicator.php</div>
    <div class = "php file">curve/replicator.php</div>
    <div class = "php file">memefactory/replicator.php</div>
    <div class = "php file">three/replicator.php</div>

    <div class = "json file">json/dna.txt</div>
    <div class = "json file">json/map.txt</div>
    <div class = "json file">json/factory.txt</div>
    <div class = "json file">json/links.txt</div>
    <div class = "json file">json/listoflists.txt</div>
    <div class = "json file">json/imgurls.txt</div>
    <div class = "json file">json/inflow.txt</div>
    <div class = "json file">json/outflow.txt</div>

</div>

<script>
currentFile = "html/index.txt";
var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        editor.setValue(filedata);
    }
};
httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
httpc.send();
files = document.getElementById("filescroll").getElementsByClassName("file");
for(var index = 0;index < files.length;index++){
    files[index].onclick = function(){
        currentFile = this.innerHTML;
        //use php script to load current file;
        var httpc = new XMLHttpRequest();
        httpc.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                filedata = this.responseText;
                editor.setValue(filedata);
                var fileType = currentFile.split("/")[0]; 
                var fileName = currentFile.split("/")[1];
              
            }
        };
        httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
        httpc.send();
        if(this.classList[0] == "css"){
            editor.getSession().setMode("ace/mode/css");
            document.getElementById("namediv").style.color = "yellow";
            document.getElementById("namediv").style.borderColor = "yellow";
        }
        if(this.classList[0] == "html"){
            editor.getSession().setMode("ace/mode/html");
            document.getElementById("namediv").style.color = "#0000ff";
            document.getElementById("namediv").style.borderColor = "#0000ff";
        }
        if(this.classList[0] == "scrolls"){
            editor.getSession().setMode("ace/mode/html");
            document.getElementById("namediv").style.color = "#87CEEB";
            document.getElementById("namediv").style.borderColor = "#87CEEB";
        }
        if(this.classList[0] == "javascript"){
            editor.getSession().setMode("ace/mode/javascript");
            document.getElementById("namediv").style.color = "#ff0000";
            document.getElementById("namediv").style.borderColor = "#ff0000";
        }
        if(this.classList[0] == "bytecode"){
            editor.getSession().setMode("ace/mode/text");
            document.getElementById("namediv").style.color = "#654321";
            document.getElementById("namediv").style.borderColor = "#654321";
        }
        if(this.classList[0] == "php"){
            editor.getSession().setMode("ace/mode/php");
            document.getElementById("namediv").style.color = "#800080";
            document.getElementById("namediv").style.borderColor = "#800080";
        }
        if(this.classList[0] == "json"){
            editor.getSession().setMode("ace/mode/json");
            document.getElementById("namediv").style.color = "orange";
            document.getElementById("namediv").style.borderColor = "orange";
        }

        document.getElementById("namediv").innerHTML = currentFile;
    }
}
document.getElementById("namediv").innerHTML = currentFile;
document.getElementById("namediv").style.color = "#0000ff";
document.getElementById("namediv").style.borderColor = "#0000ff";

editor = ace.edit("maineditor");
editor.setTheme("ace/theme/cobalt");
editor.getSession().setMode("ace/mode/html");
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
#namediv{
    position:absolute;
    top:5px;
    left:20%;
    font-family:courier;
    padding:0.5em 0.5em 0.5em 0.5em;
    border:solid;
    background-color:#101010;

}
a{
    color:white;
    display:block;
    margin-bottom:0.5em;
    margin-left:0.5em;
}
body{
    background-color:#404040;
}
.html{
    color:#0000ff;
}
.css{
    color:yellow;
}
.php{
    color:#800080;
}
.javascript{
    color:#ff0000;
}
.bytecode{
    color:#654321;
}
.json{
    color:orange;
}
.scrolls{
    color:#87ceeb;
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
    top:60%;
    bottom:0%;
    right:0%;
    left:75%;
    border:solid;
    border-radius:5px;
    border-width:3px;
    background-color:#101010;
    font-family:courier;
    font-size:22px;
    z-index:99999999;
}
#linkscroll{
    position:absolute;
    overflow:scroll;
    top:5em;
    bottom:50%;
    right:0px;
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



</style>

</body>
</html>
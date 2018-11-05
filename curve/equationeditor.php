<!doctype html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
<script id = "topfunctions">

<?php
if(isset($_GET['url'])){
    $urlfilename = $_GET['url'];
    $svgcode = file_get_contents($_GET['url']);
    $topcode = explode("</topfunctions>",$svgcode)[0];
    $outcode = explode("<topfunctions>",$topcode)[1];
    echo $outcode;
}
if(isset($_GET['path'])){
    echo file_get_contents($_GET['path']."javascript/topfunctions.txt");
}
if(!isset($_GET['url']) && !isset($_GET['path'])){
    echo file_get_contents("javascript/topfunctions.txt");
}

?>

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    <script>
	MathJax.Hub.Config({
		tex2jax: {
		inlineMath: [['$','$'], ['\\(','\\)']],
		processEscapes: true,
		processClass: "mathjax",
        ignoreClass: "no-mathjax"
		}
	});//			MathJax.Hub.Typeset();//tell Mathjax to update the math
</script>

<title>PHP Editor replicator</title>
</head>
<body  class="no-mathjax">
<div id = "backurldata" style = "display:none"><?php

    if(isset($_GET['backlink'])){
        echo $_GET['backlink'];
    }
    

?></div>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>
<div id = "plotdatadiv" style = "display:none;"><?php

    if(isset($_GET['path'])){
        echo file_get_contents($_GET['path']."json/plotdata.txt");
    }
    else{
        echo file_get_contents("json/plotdata.txt");
    }

?></div>
    
<div id = "jsondatadiv" style = "display:none;"><?php

    if(isset($_GET['url'])){
        $urlfilename = $_GET['url'];
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</currentjson>",$svgcode)[0];
        $outcode = explode("<currentjson>",$topcode)[1];
        echo $outcode;
    }
    if(isset($_GET['path'])){
        echo file_get_contents($_GET['path']."json/currentjson.txt");
    }
    if(!isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents("json/currentjson.txt");
    }


?></div>
    
    
    <a href = "editor.php" id = "editorlink">editor.php</a>
    <a href = "index.php" id = "indexlink">index.php</a>
    <a href = "tree.php" id = "treelink">tree.php</a>

<div id = "namediv"></div>
<div id="maineditor" contenteditable="true" spellcheck="false"></div>

<canvas id = "mainCanvas"></canvas>
<div id = "mathscroll"  class = "mathjax"><?php

    if(isset($_GET['path'])){
        echo file_get_contents($_GET['path']."html/equation.txt");
    }
    else{
        echo file_get_contents("html/equation.txt");
    }

?></div>


<div id = "filescroll">

    <div class = "html file">html/equation.txt</div>
    <div class = "javascript file">javascript/topfunctions.txt</div>
    <div class = "json file">json/currentjson.txt</div>
    <div class = "json file">json/plotdata.txt</div>

</div>

<script>

init();
function init(){
    
    path = document.getElementById("pathdiv").innerHTML;
    if(path.length > 1){
        document.getElementById("indexlink").href = "index.php?path=" + path;
    }

    backlink = document.getElementById("backurldata").innerHTML;
    currentjson = JSON.parse(document.getElementById("jsondatadiv").innerHTML);

    constants = currentjson.constants;
    plotparams = currentjson.plotparams;
    funcparams = currentjson.funcparams;
    if(document.getElementById("plotdatadiv").innerHTML.length > 4){
        plotdata  = JSON.parse(document.getElementById("plotdatadiv").innerHTML);
    }

}

redraw();
function redraw(){

    currentSVG = "<svg width=\"" + plotparams.plotwidth.toString() + "\" height=\"" + plotparams.plotheight.toString() + "\" viewbox = \"0 0 " + plotparams.plotwidth.toString() + " " + plotparams.plotheight.toString() + "\"  xmlns=\"http://www.w3.org/2000/svg\">\n";

    document.getElementById("mainCanvas").width = plotparams.plotwidth;
    document.getElementById("mainCanvas").height = plotparams.plotheight;

    ctx = document.getElementById("mainCanvas").getContext("2d");
    ctx.clearRect(0, 0, plotparams.plotwidth,plotparams.plotheight);
    ctx.lineWidth = 2;

    plotfunction();
    
    currentSVG += "</svg>";

    currentjson = {};
    currentjson.constants = constants;
    currentjson.plotparams = plotparams;
    currentjson.funcparams = funcparams;

}

    
currentFile = "javascript/topfunctions.txt";

var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        editor.setValue(filedata);
    }
};

if(path.length>1){
    httpc.open("GET", "fileloader.php?filename=" + path + currentFile, true);
}
else{
    httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
}

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

        if(path.length>1){
            httpc.open("GET", "fileloader.php?filename=" + path + currentFile, true);
        }
        else{
            httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
        }
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
document.getElementById("namediv").style.color = "#ff0000";
document.getElementById("namediv").style.borderColor = "#ff0000";

editor = ace.edit("maineditor");
editor.setTheme("ace/theme/cobalt");
editor.getSession().setMode("ace/mode/javascript");
editor.getSession().setUseWrapMode(true);
editor.$blockScrolling = Infinity;

document.getElementById("maineditor").onkeyup = function(){

    data = encodeURIComponent(editor.getSession().getValue());
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");

    if(path.length > 1){
        httpc.send("data="+data+"&filename=" + path +  currentFile);//send text to filesaver.php
    }
    else{
        httpc.send("data="+data+"&filename=" + currentFile);//send text to filesaver.php
    }

    var fileType = currentFile.split("/")[0]; 
    var fileName = currentFile.split("/")[1];
    
    if(currentFile == "html/equation.txt"){
        document.getElementById("mathscroll").innerHTML = editor.getSession().getValue();
        MathJax.Hub.Typeset();//tell Mathjax to update the math
    }
    if(currentFile == "json/currentjson.txt"){
        currentjson = JSON.parse(editor.getSession().getValue());
        constants = currentjson.constants;
        plotparams = currentjson.plotparams;
        funcparams = currentjson.funcparams;
        redraw();
    }

    
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
    font-size:24px;
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
    top:80%;
    bottom:0%;
    right:0%;
    left:75%;
    border:solid;
    border-radius:5px;
    border-width:3px;
    background-color:#101010;
    font-family:courier;
    font-size:18px;
}


#indexlink{
    position:absolute;
    top:0.5em;
    right:10em;
}
#editorlink{
    position:absolute;
    top:1.8em;
    right:10em;
}
#treelink{
    position:absolute;
    top:6em;
    right:10em;
}

#maineditor{
    position:absolute;
    left:0%;
    top:50%;
    bottom:1em;
    right:65%;
}
#mainCanvas{
    position:absolute;
    left:35%;
    top:8%;
    background-color:white;
    z-index:-2;
}
#mathscroll{
    padding:1em 1em 1em 1em;
    position:absolute;
    left:38%;
    right:27%;
    top:60%;
    background-color:white;
    bottom:1em;
    overflow:scroll;
}

</style>

</body>
</html>
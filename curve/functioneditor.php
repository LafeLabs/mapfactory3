<!doctype html>
<html>
<head>
<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIiIiIiIiIiIAERAAERAAEQABEQABEQABIiIiIiIiIiIiIiIiIiIiIgAAAAAAAAAAAAAAAAAAIgAwAAAAAAIAIwMAAAAAIAAyADAAAAIAAwAAAAAAAAAAACAAMAIAAwAAAgADIAAwAAAAIAIwAwAAAAACIAMwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//AAD/8wAAf+wAAL/cAADfuwAAAAAAAHbvAAC53wAA2b8AAOZ/AAD//wAA" rel="icon" type="image/x-icon" />
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

<script src = "https://cdnjs.cloudflare.com/ajax/libs/showdown/1.8.6/showdown.js"></script>
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
    echo file_get_contents("curves/".$_GET['path']."javascript/topfunctions.txt");
}
if(!isset($_GET['url']) && !isset($_GET['path'])){
    echo file_get_contents("javascript/topfunctions.txt");
}

?>

</script>

<title>Function Editor</title>
</head>
<body  class="no-mathjax">
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
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
        echo file_get_contents("curves/".$_GET['path']."json/currentjson.txt");
    }
    if(!isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents("json/currentjson.txt");
    }


?></div>
    
<table id = "linktable">
    <tr>
        <td>    
            <a id = "indexlink" href = "index.php">
                <img src = "icons/curve.svg"/>
            </a>
        </td>
        <td>    
            <a href = "editor.php">
                <img src = "icons/editor.svg"/>
            </a>
        </td>
        <td>    
            <a href = "tree.php">
                <img src = "icons/tree.svg"/>
            </a>
        </td>

    </tr>
</table>    

<div id="maineditor" contenteditable="true" spellcheck="false"></div>
<div id = "jsoneditor" contenteditable="true" spellcheck="false"></div>

<div id = "scrolldata" style = "display:none"><?php

    if(isset($_GET['url'])){
        $urlfilename = $_GET['url'];
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</equation>",$svgcode)[0];
        $outcode = explode("<equation>",$topcode)[1];
        echo $outcode;
    }
    if(isset($_GET['path'])){
        echo file_get_contents("curves/".$_GET['path']."markdown/equation.txt");
    }
    if(!isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents("markdown/equation.txt");
    }

?></div>
<div id = "scroll" class = "mathjax"></div>
<textarea id  = "scrolleditor"></textarea>
<script>

var converter = new showdown.Converter();
converter.setOption('literalMidWordUnderscores', 'true');


path = document.getElementById("pathdiv").innerHTML;
if(path.length > 1){
    document.getElementById("indexlink").href = "index.php?path=" + path;
}
currentjson = JSON.parse(document.getElementById("jsondatadiv").innerHTML);


editor = ace.edit("maineditor");
editor.setTheme("ace/theme/cobalt");
editor.getSession().setMode("ace/mode/javascript");
editor.getSession().setUseWrapMode(true);
editor.$blockScrolling = Infinity;

editor2 = ace.edit("jsoneditor");
editor2.setTheme("ace/theme/cobalt");
editor2.getSession().setMode("ace/mode/json");
editor2.getSession().setUseWrapMode(true);
editor2.$blockScrolling = Infinity;

var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        editor.setValue(filedata);
    }
};

if(path.length>1){
    httpc.open("GET", "fileloader.php?filename=curves/" + path + "javascript/topfunctions.txt", true);
}
else{
    httpc.open("GET", "fileloader.php?filename=javascript/topfunctions.txt", true);
}
httpc.send();

editor2.setValue(document.getElementById("jsondatadiv").innerHTML);

document.getElementById("scroll").innerHTML = converter.makeHtml(document.getElementById("scrolldata").innerHTML);
document.getElementById("scrolleditor").value = document.getElementById("scrolldata").innerHTML;


document.getElementById("maineditor").onkeyup = function(){

    data = encodeURIComponent(editor.getSession().getValue());
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");

    if(path.length > 1){
        httpc.send("data="+data+"&filename=curves/" + path +  "javascript/topfunctions.txt");//send text to filesaver.php
    }
    else{
        httpc.send("data="+data+"&filename=javascript/topfunctions.txt");//send text to filesaver.php
    }
}

document.getElementById("jsoneditor").onkeyup = function(){

    data = encodeURIComponent(editor2.getSession().getValue());
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");

    if(path.length > 1){
        httpc.send("data="+data+"&filename=curves/" + path +  "json/currentjson.txt");//send text to filesaver.php
    }
    else{
        httpc.send("data="+data+"&filename=json/currentjson.txt");//send text to filesaver.php
    }
}

document.getElementById("scrolleditor").onkeyup = function(){
    document.getElementById("scroll").innerHTML = converter.makeHtml(this.value);
    MathJax.Hub.Typeset();//tell Mathjax to update the math
    data = encodeURIComponent(this.value);
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    if(path.length > 1){
        httpc.send("data="+data+"&filename=curves/" + path + "markdown/equation.txt");//send text to filesaver.php
    }
    else{
        httpc.send("data="+data+"&filename=markdown/equation.txt");//send text to filesaver.php
    }
    
}
</script>
<style>
body{

    font-family:Helvetica;
}
#linktable{
    position:absolute;
    left:0px;
    top:0px;
}
#linktable img{
    width:50px;
}

#maineditor{
    position:absolute;
    left:0px;
    top:110px;
    bottom:260px;
    right:60%;
}
#jsoneditor{
    position:absolute;
    left:0px;
    height:200px;
    bottom:0px;
    right:60%;
}


#scroll{
    padding:1em 1em 1em 1em;
    position:absolute;
    text-align:justify;
    right:0px;
    left:60%;
    top:110px;
    background-color:white;
    bottom:40%;
    border:solid;
    border-radius:10px;
    overflow:scroll;
}
#scroll h1,h2,h3,h4{
    width:100%;
    text-align:center;
}
#scrolleditor{
    position:absolute;
    right:10px;
    left:60%;
    width:35%;
    top:70%;
    height:25%;
    background-color:white;
    bottom:10px;
    border:solid;
    overflow:scroll;
}

</style>

</body>
</html>
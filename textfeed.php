<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Text Feed</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

_9_LAWS_OF_GEOMETRON_:

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

NO MONEY
NO PROPERTY
NO MINING

EGO DEATH:
    LOOK AT THE INSECTS
    LOOK AT THE FUNGI
    LANGUAGE IS HOW THE MIND PARSES REALITY
    
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

<!-- links to MathJax JavaScript library, un-comment to use math-->

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
</head>
<body>
<div id = "datadiv" style = "display:none" class = "no-mathjax"><?php
  
$files = scandir(getcwd()."/textfeed");
foreach(array_reverse($files) as $value){
    if(substr($value,-4) == ".txt"){
        echo "\n<p id = \"".$value."\" class = \"textelement\">\n".file_get_contents("textfeed/".$value)."\n</p>\n";
    }
}

?></div>
<table id = "linktable">
    <tr>
        <td><a href = "editor.php">
            <img src = "mapicons/editor.svg">
        </a></td>
        <td><a href = "index.php">
            <img src = "mapicons/mapfactory.svg">
        </a></td>
    </tr>
</table>

<div class="no-mathjax" id = "wordsinputbox">WORDS:<input  class = "mathjax" id = "wordsinput"/></div>
<div  class="no-mathjax" id = "datadiv" style = "display:none"></div>

<div id = "scrolldiv"  class = "mathjax"></div>

<script>

document.getElementById("wordsinput").select();

mathIndex = 0;

textelements = document.getElementById("datadiv").getElementsByClassName("textelement");
    
for(var index = 0;index < textelements.length;index++){
        var newp = document.createElement("p");
        newp.innerHTML = textelements[index].innerHTML;
        newp.className = "scrollelement";
        document.getElementById("scrolldiv").appendChild(newp);

        var newimg = document.createElement("img");
        newimg.src = "mapicons/deletex.svg";
        newp.appendChild(newimg);
        newimg.className= "button";
        newimg.alt = textelements[index].id;
        newimg.style.width = "30px";
        newimg.onclick = function(){
            textname = "textfeed/" + this.alt;
            var httpc = new XMLHttpRequest();
            var url = "deletefile.php";         
            httpc.open("POST", url, true);
            httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
            httpc.send("filename=" + textname);//send text to filesaver.php
            document.getElementById("scrolldiv").removeChild(this.parentElement);
        }
    
}
    
MathJax.Hub.Typeset();//tell Mathjax to update the math


document.getElementById("wordsinput").onchange = function(){
    data = encodeURIComponent(this.value);
    timestamp = Math.round((new Date().getTime())/1000);
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data=" + data + "&filename=" + "textfeed/text" + timestamp + ".txt");//send text to filesaver.php


    var newp = document.createElement("P");
    newp.className = "scrollelement";
    newp.innerHTML = this.value;
    
    if(document.getElementById("scrolldiv").innerHTML.length > 0){
        var ps = document.getElementById("scrolldiv").getElementsByTagName("P");
        document.getElementById("scrolldiv").insertBefore(newp,ps[0]);
    }
    else{
        document.getElementById("scrolldiv").appendChild(newp);
    }
    MathJax.Hub.Typeset();//tell Mathjax to update the math
    this.value = "";
    
    var newimg = document.createElement("img");
    newimg.src = "mapicons/deletex.svg";
    newp.appendChild(newimg);
    newimg.className= "button";
    newimg.alt = "text" + timestamp + ".txt";
    newimg.style.width = "30px";
    newimg.onclick = function(){
            textname = "textfeed/" + this.alt;
            var httpc = new XMLHttpRequest();
            var url = "deletefile.php";         
            httpc.open("POST", url, true);
            httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
            httpc.send("filename=" + textname);//send text to filesaver.php
            document.getElementById("scrolldiv").removeChild(this.parentElement);
        }
}

document.getElementById("wordsinput").onkeydown = function(e) {
    charCode = e.keyCode || e.which;
    if(charCode == 050){
        this.value = textelements[mathIndex].innerHTML;
        mathIndex++;
        if(mathIndex > textelements.length - 1){
            mathIndex = 0;
        }
    }
    if(charCode == 046){
        this.value = textelements[mathIndex].innerHTML;
        mathIndex--;
        if(mathIndex < 0){
            mathIndex = textelements.length - 1;
        }
    }
}


</script>
<style>

    .button{
        cursor:pointer;
        font-size:30px;
        padding-left:1em;
        padding-right:1em;
        padding-top:10px;
        padding-bottom:10px;
    }
    .button:hover{
        background-color:green;
    }
    .button:active{
        background-color:yellow;
    }
    #wordsinput{
        width:25em;
        font-size:30px;
    }
    #wordsinputbox{
        position:absolute;
        top:3em;
        left:1em;
    }
    #linktable{
        position:absolute;
        right:10px;
        top:10px;
    }
    #linktable img{
        width:80px;
    }
    #scrolldiv{
        position:absolute;
        top:6em;
        bottom:0px;
        right:0px;
        left:0px;
        overflow:scroll;
        padding:1em 1em 1em 1em;
        border-top:solid;
    }
</style>

</body>
</html>
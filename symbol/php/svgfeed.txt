 <!doctype html>
<html>
<head>
<title>Parse SVG's</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

NO MONEY
NO MINING
NO PROPERY

LOOK AT THE FUNGI
LOOK AT THE INSECTS
LANGUAGE IS HOW THE MIND PARSES REALITY

-->

<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

</head>
<body>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>
<div id = "datadiv" style = "display:none"><?php
  
      if(isset($_GET['path'])){
        $path = $_GET['path'];
        $svgpath = "/symbols/".$path."svg";
    }
    else{
        $svgpath = "/svg";
    }
 
    $svgs = scandir(getcwd().$svgpath);
    $svgs = array_reverse($svgs);
    foreach($svgs as $value){
        if($value != "." && $value != ".." && substr($value,-4) == ".svg"){
            echo $value.",";
        }
    }
    
?></div>

<a id = "indexlink" href = "index.php"><img style = "width:80px" src = "icons/symbol.svg"></a>

<div id = "scroll">

</div>
<script>
    path = document.getElementById("pathdiv").innerHTML;
    if(path.length>1){
        document.getElementById("indexlink").href = "index.php?path=" + path;
        pathset = true;
    }
    else{
        pathset = false;
    }

    symbols = document.getElementById("datadiv").innerHTML.split(",");
    for(var index = 0;index < symbols.length - 1;index++){
        var newdiv = document.createElement("div");
        newdiv.className = "symbolbox";
        var newa = document.createElement("A");
        var newimg = document.createElement("IMG");
        newa.appendChild(newimg);
        newdiv.appendChild(newa);
        document.getElementById("scroll").appendChild(newdiv);
        if(pathset){
            newimg.src  = "symbols/" + path + "svg/" + symbols[index];
            newa.href = "index.php?url=symbols/" + path + "svg/" + symbols[index] + "&path=" + path;
        }
        else{
            newimg.src  = "svg/" + symbols[index];
            newa.href = "index.php?url=svg/" + symbols[index];
        }
        var newimg = document.createElement("img");
        newimg.src = "icons/delete.svg";
        newdiv.appendChild(newimg);
        newimg.className= "button";
        newimg.onclick = function(){
            imagename = this.parentElement.getElementsByTagName("img")[0].src.split("symbol/")[1];
            var httpc = new XMLHttpRequest();
            var url = "deletefile.php";         
            httpc.open("POST", url, true);
            httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
            httpc.send("filename=" + imagename);//send text to filesaver.php
            document.getElementById("scroll").removeChild(this.parentElement);
        }
        
    }

    
</script>
<style>
    .symbolbox{
        display:block;
        margin:auto;
        border-top:solid;
    }

    #indexlink{
        left:1em;
        top:3em;
        position:absolute;
        z-index:3;
    }

    #scroll{
        border-top:solid;
        position:absolute;
        left:0px;
        top:120px;
        bottom:0px;
        right:0px;
        overflow:scroll;
    }
    img{
        box-sizing: border-box;
        border:solid;
        border-color:white;
    }
    p{
        border:solid;
        box-sizing: border-box;
        border-color:white;
        margin-top:10em;
        margin-bottom:3em;
    }
    .button{
        cursor:pointer;
        width:80px;
        display:block;

    }
    .button:hover{
        background-color:green;
    }
</style>
</body>
</html>
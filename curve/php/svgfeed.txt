 <!doctype html>
<html>
<head>
<title>Curve Feed</title>
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
<!--
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
-->

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
        $svgpath = "/curves/".$path."svg";
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

    curves = document.getElementById("datadiv").innerHTML.split(",");
    for(var index = 0;index < curves.length - 1;index++){
        var newdiv = document.createElement("div");
        newdiv.className = "curvebox";
        var newa = document.createElement("A");
        var newimg = document.createElement("IMG");
        newa.appendChild(newimg);
        newdiv.appendChild(newa);
        document.getElementById("scroll").appendChild(newdiv);
        if(pathset){
            newimg.src  = "curves/" + path + "svg/" + curves[index];
            newa.href = "index.php?url=curves/" + path + "svg/" + curves[index] + "&path=" + path;
        }
        else{
            newimg.src  = "svg/" + curves[index];
            newa.href = "index.php?url=svg/" + curves[index];
        }
        var newimg = document.createElement("img");
        newimg.src = "icons/delete.svg";
        newdiv.appendChild(newimg);
        newimg.className= "button";
        newimg.onclick = function(){
            imagename = this.parentElement.getElementsByTagName("img")[0].src.split("curve/")[1];
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

#linktable{
    position:absolute;
    top:0px;
    left:0px;
    z-index:3;
}
#linktable img{
    width:50px;
}
#scroll{
    position:absolute;
    left:0px;
    top:110px;
    bottom:0px;
    right:0px;
    overflow:scroll;
}
#scroll img{
    display:block;
    margin:auto;
}
    .curvebox{
        display:block;
        margin:auto;
        border-top:solid;
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
<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Linker</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
</head>
<body>
<div id = "datadiv" style = "display:none"><?php

echo file_get_contents("json/map.txt");

?></div>
<div id = "linkdatadiv" style = "display:none"><?php

    echo file_get_contents("json/links.txt");

?></div>
<div id = "imgurls" style = "display:none;"><?php

    echo file_get_contents("json/imgurls.txt");
    
?></div>

<a href = "index.php" style = "position:absolute;left:10px;top:10px"><img src = "icons/mapfactory.svg" style = "width:50px"></a>

<div id = "linkscroll"></div>
<table id = "maintable">
    <tr>
        <td id = "gobutton"><img style = "width:100px;" class = "button" src = "icons/gobutton.svg"></td>
        <td>
            <img style = "width:100px" id = "mainimage"/>
        </td>
        <td></td>
    </tr>
    <tr>
        <td>imgurl:<td><input id = "imgurlinput"></td>
    </tr>
    <tr>
        <td>href:<td><input id = "hrefinput"></td>
    </tr>
</table>

<div id = "page"></div>

<div id = "imagescroll"></div>
<style>
body{
    font-family:Helvetica;
    font-size:24px;
}
input{
    font-family:courier;
    font-size:20px;
}
    #linkscroll{
        position:absolute;
        overflow:scroll;
        left:10px;
        right:75%;
        bottom:10px;
        top:110px;
        border:solid;
        border-color:blue;
        border-width:5px;
    }
    #imagescroll{
        position:absolute;
        left:70%;
        right:10px;
        top:110px;
        bottom:10px;
        border:solid;
        border-color:yellow;
        border-width:5px;
    }
    #imagescroll img{
        width:50%;
        display:block;
        margin:auto;
    }
    #maintable{
        position:absolute;
        width:25%;
        left:30%;
        top:110px;
    }
    #page{
        position:absolute;
        width:30%;
        left:30%;
        height:50%;
        bottom:0px;
        border:solid;
    }
    .button{
        cursor:pointer;
        border:solid;
        margin-top:1em;
        margin-bottom:1em;
    }
    .button:hover{
        background-color:green;
    }
    .button:active{
        background-color:yellow;
    }
    .linkbox{
        position:absolute;
    }
    .linkbox img{
        position:absolute;
        left:0px;
        top:0px;
        width:100%;
    }

</style>

<script>
    links = JSON.parse(document.getElementById("linkdatadiv").innerHTML);
    imgurls = JSON.parse(document.getElementById("imgurls").innerHTML);
    map = JSON.parse(document.getElementById("datadiv").innerHTML);
    
    for(var index = 0;index < links.length; index++){
        var newp = document.createElement("P");
        newp.innerHTML = links[index];
        newp.className = "button";
        document.getElementById("linkscroll").appendChild(newp);
        newp.onclick = function(){
            document.getElementById("hrefinput").value = this.innerHTML;
        }
    }
    for(var index = 0;index < imgurls.length; index++){
        var newimg = document.createElement("IMG");
        newimg.src = imgurls[index];
        newimg.className = "button";
        document.getElementById("imagescroll").appendChild(newimg);
        newimg.onclick = function(){
            document.getElementById("imgurlinput").value = this.src;
            document.getElementById("mainimage").src = this.src;
        }
    }
    
    w = parseInt(getComputedStyle(document.getElementById("page")).width);

    for(var index = 0;index < map.length;index++){
        var newimg = document.createElement("IMG");
        var newa = document.createElement("A");
        newa.className = "linkbox";
        newa.appendChild(newimg);
        newa.id = "a" + index.toString();
        newa.href = map[index].href;
        newimg.id = "i" + index.toString();
        document.getElementById("page").appendChild(newa);
        newimg.src = map[index].src;
        newa.style.left = (map[index].x*w).toString() + "px";
        newa.style.top = (map[index].y*w).toString() + "px";
        newa.style.width = (map[index].w*w).toString() + "px";
        newa.style.transform = "rotate(" + map[index].angle.toString() + "deg)";
        newimg.onload = function(){
            this.parentElement.style.height = (this.height).toString() + "px";
        }
    }
    
</script>

</body>
</html>
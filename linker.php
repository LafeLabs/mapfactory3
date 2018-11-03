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
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
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
        <td id = "savebutton"><img style = "width:100px" class = "button" src = "icons/linker.svg"/></td>
    </tr>
    <tr>
        <td>imgurl:<td><input id = "imgurlinput"></td>
    </tr>
    <tr>
        <td>href:<td><input id = "hrefinput"></td>
    </tr>
</table>

<div id = "pagebox">    
    <div id = "page"></div>    
</div>


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
    #pagebox{
        position:absolute;
        width:30%;
        left:30%;
        height:50%;
        bottom:0px;
        border:solid;
        z-index:10;
    }
    #page{
        position:absolute;
        left:0px;
        right:0px;
        top:0px;
        bottom:0px;
    }
    .button{
        cursor:pointer;
        border:solid;
        margin-top:1em;
        margin-bottom:1em;
    }
    .button:hover{
        background-color:#a0ffa0;
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
    
    document.getElementById("gobutton").onclick = function(){
        var newjson = {}
        newjson.w = 0.1;
        newjson.x = 0.5;
        newjson.y = 0.25;
        newjson.angle = 0;
        newjson.src = document.getElementById("imgurlinput").value;
        newjson.href = document.getElementById("hrefinput").value;
        map.push(newjson);
            var newimg = document.createElement("IMG");
        var newa = document.createElement("A");
        newa.className = "linkbox";
        newa.appendChild(newimg);
        newa.id = "a" + (map.length - 1).toString();
        newa.href = newjson.href;
        newimg.id = "i" + (map.length - 1).toString();
        document.getElementById("page").appendChild(newa);
        newimg.src = newjson.src;
        newa.style.left = (newjson.x*w).toString() + "px";
        newa.style.top = (newjson.y*w).toString() + "px";
        newa.style.width = (newjson.w*w).toString() + "px";
        newa.style.transform = "rotate(" + newjson.angle.toString() + "deg)";
        newimg.onload = function(){
            this.parentElement.style.height = (this.height).toString() + "px";
        }
        
    }
    
    document.getElementById("savebutton").onclick = function(){
        data = encodeURIComponent(JSON.stringify(map,null,"    "));
        var httpc = new XMLHttpRequest();
        var url = "filesaver.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        httpc.send("data=" + data + "&filename=" + "json/map.txt");//send text to filesaver.php
    }


mc = new Hammer(document.getElementById("pagebox"));
mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc.on("panleft panright panup pandown tap press", function(ev) {

    map[map.length - 1].x = (0.5*w + ev.deltaX)/w;
    map[map.length - 1].y = (0.25*w + ev.deltaY)/w;
    
    document.getElementById("a" + (map.length - 1).toString()).style.left = (0.5*w + ev.deltaX).toString() + "px";
    document.getElementById("a" + (map.length - 1).toString()).style.top = (0.25*w + ev.deltaY).toString() + "px";

});    

    
</script>

</body>
</html>
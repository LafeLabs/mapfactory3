<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Image Feed</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
</head>
<body>
<div id = "imgurldiv" style = "display:none"><?php

    echo file_get_contents("json/imgurls.txt");

?></div>
<a href = "index.php" style = "position:absolute;left:10px;top:10px">
    <img src  = "mapicons/mapfactory.svg" style = "width:50px"/>
</a>

<div id = "tablebox">
    <table id = "maintable"></table>
</div>

<table id = "bottomtable">
    <tr>
        <td id = "enterbutton" class = "button">ENTER IMAGE URL:</td><td><input id = "urlinput"/></td>
    </tr>
</table>
<script>
    images = JSON.parse(document.getElementById("imgurldiv").innerHTML);
    for(var index = 0;index < images.length;index++){
        var newtr = document.createElement("TR");
        document.getElementById("maintable").appendChild(newtr);
        var newtd = document.createElement("TD");
        var newimg = document.createElement("IMG");
        newimg.className = "feedimage";
        newimg.src = images[index];
        newtd.appendChild(newimg);
        newtr.appendChild(newtd);
        var deltd = document.createElement("TD");
        newtr.appendChild(deltd);
        deltd.className = "button";
        var newimg = document.createElement("IMG");
        newimg.className = "delbutton";
        newimg.src = "mapicons/deletelink.svg";
        deltd.appendChild(newimg);
        deltd.onclick  = function(){
            document.getElementById("maintable").removeChild(this.parentNode);
            var newimages = document.getElementById("maintable").getElementsByClassName("feedimage");
            images = [];
            for(var iindex = 0;iindex < newimages.length;iindex++){
                images.push(newimages[iindex].src);
            }
            saveimages();
        }
    }
    
    document.getElementById("urlinput").onchange = function(){
        images.push(this.value);
        var newtr = document.createElement("TR");
        document.getElementById("maintable").appendChild(newtr);
        var newtd = document.createElement("TD");
        var newimg = document.createElement("IMG");
        newimg.className = "feedimage";
        newimg.src = this.value;
        newtd.appendChild(newimg);
        newtr.appendChild(newtd);
        var deltd = document.createElement("TD");
        newtr.appendChild(deltd);
        deltd.className = "button";
        var newimg = document.createElement("IMG");
        newimg.className = "delbutton";
        newimg.src = "mapicons/deletelink.svg";
        deltd.appendChild(newimg);
        deltd.onclick  = function(){
            document.getElementById("maintable").removeChild(this.parentNode);
            var newimages = document.getElementById("maintable").getElementsByClassName("feedimage");
            images = [];
            for(var iindex = 0;iindex < newimages.length;iindex++){
                links.push(newimages[iindex].src);
            }
            saveimages();
        }
        saveimages();
    }
    document.getElementById("enterbutton").onclick = function(){
        images.push(document.getElementById("urlinput").value);
        var newtr = document.createElement("TR");
        document.getElementById("maintable").appendChild(newtr);
        var newtd = document.createElement("TD");
        var newimg = document.createElement("IMG");
        newimg.className = "feedimage";
        newimg.src = document.getElementById("urlinput").value;
        newtd.appendChild(newimg);
        newtr.appendChild(newtd);
        var deltd = document.createElement("TD");
        newtr.appendChild(deltd);
        deltd.className = "button";
        var newimg = document.createElement("IMG");
        newimg.className = "delbutton";
        newimg.src = "mapicons/deletelink.svg";
        deltd.appendChild(newimg);
        deltd.onclick  = function(){
            document.getElementById("maintable").removeChild(this.parentNode);
            var newimages = document.getElementById("maintable").getElementsByClassName("feedimage");
            images = [];
            for(var iindex = 0;iindex < newimages.length;iindex++){
                links.push(newimages[iindex].src);
            }
            saveimages();
        }
        saveimages();
    }
    
    function saveimages(){
        data = encodeURIComponent(JSON.stringify(images,null,"    "));
        var httpc = new XMLHttpRequest();
        var url = "filesaver.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        httpc.send("data=" + data + "&filename=" + "json/imgurls.txt");//send text to filesaver.php

    }
</script>
<style>
body{
    font-family:Helvetica;
    font-size:36px;
}
input{
    width:20em;
    font-family:courier;
    font-size:24px;
}
    .button{
        cursor:pointer;
    }
    .button:hover{
        background-color:green;
    }
    button:active{
        background-color:yellow;
    }
    #tablebox{
        position:absolute;
        top:100px;
        left:50px;
        bottom:100px;
        right:50px;
        border:solid;
        overflow:scroll;
    }
    #bottomtable{
        position:absolute;
        bottom:0px;
        left:0px;
        z-index:99999999;
    }
    .delbutton{
        width:50px;
    }
    .feedimage{
        width:100px;
    }
</style>
</body>
</html>
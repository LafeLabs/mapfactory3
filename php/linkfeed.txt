<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Link Creator</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
</head>
<body>
<div id = "linkdatadiv" style = "display:none"><?php

    echo file_get_contents("json/links.txt");

?></div>
<a href = "index.php" style = "position:absolute;left:10px;top:10px">
    <img src  = "mapicons/mapfactory.svg" style = "width:50px"/>
</a>

<div id = "tablebox">
    <table id = "maintable"></table>
</div>

<table id = "bottomtable">
    <tr>
        <td>ENTER URL:</td><td><input id = "urlinput"/></td>
    </tr>
</table>
<script>
    links = JSON.parse(document.getElementById("linkdatadiv").innerHTML);
    for(var index = 0;index < links.length;index++){
        var newtr = document.createElement("TR");
        document.getElementById("maintable").appendChild(newtr);
        var newtd = document.createElement("TD");
        newtd.innerHTML = links[index];
        newtd.className = "linktd";
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
            var newlinks = document.getElementById("maintable").getElementsByClassName("linktd");
            links = [];
            for(var lindex = 0;lindex < newlinks.length;lindex++){
                links.push(newlinks[lindex].innerHTML);
            }
            savelinks();
        }
    }
    
    document.getElementById("urlinput").onchange = function(){
        links.push(this.value);
        var newtr = document.createElement("TR");
        document.getElementById("maintable").appendChild(newtr);
        var newtd = document.createElement("TD");
        newtd.innerHTML = this.value;
        newtd.className = "linktd";
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
            var newlinks = document.getElementById("maintable").getElementsByClassName("linktd");
            links = [];
            for(var lindex = 0;lindex < newlinks.length;lindex++){
                links.push(newlinks[index].innerHTML);
            }
            savelinks();
        }
        savelinks();
    }
    
    function savelinks(){
        data = encodeURIComponent(JSON.stringify(links,null,"    "));
        var httpc = new XMLHttpRequest();
        var url = "filesaver.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        httpc.send("data=" + data + "&filename=" + "json/links.txt");//send text to filesaver.php

    }
</script>
<style>
body{
    font-family:Helvetica;
    font-size:36px;
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
</style>
</body>
</html>
<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>External Image Feed</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
</head>
<body>
<div id = "imgurllistdatadiv" style = "display:none"><?php

    echo file_get_contents("json/listofimgurls.txt");

?></div>

<div id = "listdatadiv" style = "display:none"><?php

    echo file_get_contents("json/listoflists.txt");

?></div>


<a href = "index.php" style = "position:absolute;left:10px;top:10px">
    <img src  = "mapicons/mapfactory.svg" style = "width:50px"/>
</a>

<div id = "tablebox">
    <table id = "maintable"></table>
</div>
<div id = "tablebox2">
    <table id = "maintable2"></table>
</div>

<table id = "bottomtable">
    <tr>
        <td>ENTER LIST.TXT URL:</td><td><input id = "urlinput"/></td>
    </tr>
    <tr>
        <td>ENTER IMGURLS.TXT URL:</td><td><input id = "imgurlinput"/></td>
    </tr>
</table>
<script>
    links = JSON.parse(document.getElementById("listdatadiv").innerHTML);
    

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
    
    links2 = JSON.parse(document.getElementById("imgurllistdatadiv").innerHTML);
    
    for(var index = 0;index < links2.length;index++){
        var newtr = document.createElement("TR");
        document.getElementById("maintable2").appendChild(newtr);
        var newtd = document.createElement("TD");
        newtd.innerHTML = links2[index];
        newtd.className = "link2td";
        newtr.appendChild(newtd);
        var deltd = document.createElement("TD");
        newtr.appendChild(deltd);
        deltd.className = "button";
        var newimg = document.createElement("IMG");
        newimg.className = "delbutton";
        newimg.src = "mapicons/deletelink.svg";
        deltd.appendChild(newimg);
        deltd.onclick  = function(){
            document.getElementById("maintable2").removeChild(this.parentNode);
            var newlinks = document.getElementById("maintable2").getElementsByClassName("link2td");
            links2 = [];
            for(var lindex = 0;lindex < newlinks.length;lindex++){
                links2.push(newlinks[lindex].innerHTML);
            }
            savelinks2();
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
    
    document.getElementById("imgurlinput").onchange = function(){
        links2.push(this.value);
        var newtr = document.createElement("TR");
        document.getElementById("maintable2").appendChild(newtr);
        var newtd = document.createElement("TD");
        newtd.innerHTML = this.value;
        newtd.className = "link2td";
        newtr.appendChild(newtd);
        var deltd = document.createElement("TD");
        newtr.appendChild(deltd);
        deltd.className = "button";
        var newimg = document.createElement("IMG");
        newimg.className = "delbutton";
        newimg.src = "mapicons/deletelink.svg";
        deltd.appendChild(newimg);
        deltd.onclick  = function(){
            document.getElementById("maintable2").removeChild(this.parentNode);
            var newlinks = document.getElementById("maintable").getElementsByClassName("link2td");
            links2 = [];
            for(var lindex = 0;lindex < newlinks.length;lindex++){
                links2.push(newlinks[index].innerHTML);
            }
            savelinks2();
        }
        savelinks2();
    }
    
    function savelinks(){
        data = encodeURIComponent(JSON.stringify(links,null,"    "));
        var httpc = new XMLHttpRequest();
        var url = "filesaver.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        httpc.send("data=" + data + "&filename=" + "json/listoflists.txt");//send text to filesaver.php
    }
    function savelinks2(){
        data = encodeURIComponent(JSON.stringify(links2,null,"    "));
        var httpc = new XMLHttpRequest();
        var url = "filesaver.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        httpc.send("data=" + data + "&filename=" + "json/listofimgurls.txt");//send text to filesaver.php
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
        bottom:45%;
        right:50px;
        border:solid;
        overflow:scroll;
        font-family:courier;
        font-size:14px;
    }
    #tablebox2{
        position:absolute;
        bottom:100px;
        left:50px;
        top:55%;
        right:50px;
        border:solid;
        overflow:scroll;
        font-family:courier;
        font-size:14px;
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
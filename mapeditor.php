<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Map Editor</title>

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

<a href = "index.php" style = "position:absolute;left:10px;top:10px;z-index:4"><img src = "icons/mapfactory.svg" style = "width:50px"></a>

<table id = "maintable">
    <tr>
        <td>href</td>
        <td>src</td>
        <td>x</td>
        <td>y</td>
        <td>w</td>
        <td>angle</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>

<script>
    map = JSON.parse(document.getElementById("datadiv").innerHTML);

    for(var index = 0;index < map.length;index++){
        var newtr = document.createElement("TR");
        document.getElementById("maintable").appendChild(newtr);
        newtr.className = "inputrow";
//        newtr.id = "row" + index.toString();
        var newtd = document.createElement("TD");
        var newinput = document.createElement("INPUT");
        newinput.className = "hrefinput";
        newinput.value = map[index].href;
        newtd.appendChild(newinput);
        newtr.appendChild(newtd);
        var newtd = document.createElement("TD");
        var newinput = document.createElement("INPUT");
        newinput.className = "srcinput";
        newinput.value = map[index].src;
        newtd.appendChild(newinput);
        newtr.appendChild(newtd);
        var newtd = document.createElement("TD");
        var newinput = document.createElement("INPUT");
        newinput.className = "xinput";
        newinput.value = map[index].x;
        newtd.appendChild(newinput);
        newtr.appendChild(newtd);
        var newtd = document.createElement("TD");
        var newinput = document.createElement("INPUT");
        newinput.className = "yinput";
        newinput.value = map[index].y;
        newtd.appendChild(newinput);
        newtr.appendChild(newtd);
        var newtd = document.createElement("TD");
        var newinput = document.createElement("INPUT");
        newinput.className = "winput";
        newinput.value = map[index].w;
        newtd.appendChild(newinput);
        newtr.appendChild(newtd);
        var newtd = document.createElement("TD");
        var newinput = document.createElement("INPUT");
        newinput.className = "angleinput";
        newinput.value = map[index].angle;
        newtd.appendChild(newinput);
        newtr.appendChild(newtd);

        var newtd = document.createElement("TD");
        var newimg = document.createElement("IMG");
        newimg.classList.add("deletebutton","button");
        newimg.style.width = "35px";
        newimg.src = "icons/deletex.svg";
        newtd.appendChild(newimg);
        newtr.appendChild(newtd);
        newimg.onclick = function(){
            thisrow = this.parentNode.parentNode;
            document.getElementById("maintable").removeChild(thisrow);
        }
        
        var newtd = document.createElement("TD");
        var newimg = document.createElement("IMG");
        newimg.classList.add("upbutton","button");
        newimg.style.width = "35px";
        newimg.src = "icons/uparrow.svg";
        newimg.onclick = function(){
            thisrow = this.parentNode.parentNode;
            prevrow = thisrow.previousSibling;
            document.getElementById("maintable").removeChild(thisrow);
            document.getElementById("maintable").insertBefore(thisrow,prevrow);
        }
        newtd.appendChild(newimg);
        newtr.appendChild(newtd);
        var newtd = document.createElement("TD");
        var newimg = document.createElement("IMG");
        newimg.classList.add("downbutton","button");
        newimg.style.width = "35px";
        newimg.src = "icons/downarrow.svg";
        newimg.onclick = function(){
            thisrow = this.parentNode.parentNode;
            nextnextrow = thisrow.nextSibling.nextSibling;
            document.getElementById("maintable").removeChild(thisrow);
            document.getElementById("maintable").insertBefore(thisrow,nextnextrow);
        }
        newtd.appendChild(newimg);
        newtr.appendChild(newtd);


    }


deletebuttons = document.getElementById("maintable").getElementsByClassName("deletebutton");
upbuttons = document.getElementById("maintable").getElementsByTagName("upbutton");
downbuttons = document.getElementById("maintable").getElementsByClassName("downbutton");

inputstyle = document.createElement("style");
document.body.appendChild(inputstyle);
inputstyle.innerHTML = "input{width:" + (0.1*innerWidth).toString() +"px}";    
    
function savemap(){
    data = encodeURIComponent(JSON.stringify(map,null,"    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data=" + data + "&filename=" + "json/map.txt");//send text to filesaver.php
}
</script>
<style>
body{
    font-family:Helvetica;
    font-size:24px;
}
input{
    font-family:courier;
    font-size:20px;
}

    .button{
        cursor:pointer;
    }
    .button:hover{
        background-color:green;
    }
    .button:active{
        background-color:yellow;
    }
#maintable{
    position:absolute;
    top:100px;
    left:0px;
}
</style>
</body>
</html>
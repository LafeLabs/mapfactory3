 <!doctype html>
<html>
<head>
    <!--
EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE
NO MONEY
NO PROPERTY
NO MINING
EGO DEATH:
    LOOK TO THE INSECTS
    LOOK TO THE FUNGI
    LANGUAGE IS HOW THE MIND PARSES REALITY

ALL CODE IS PUBLIC DOMAIN NO PATENTS NO COPYRIGHTS
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

<div style = "display:none" id = "datadiv"><?php
    if(isset($_GET['path'])){
        echo file_get_contents("symbols/".$_GET['path']."json/stylejson.txt");
    }
    else{
        echo file_get_contents("json/stylejson.txt");
    }
?></div>    
<div style = "display:none" id = "jsondatadiv"><?php
    if(isset($_GET['path'])){
        echo file_get_contents("symbols/".$_GET['path']."json/currentjson.txt");
    }
    else{
        echo file_get_contents("json/currentjson.txt");
    }
?></div>    

<a href = "index.php" id = "indexlink"><img style = "width:100px" src = "icons/symbol.svg"/></a>

<table id = "maintable">
    <tr>
        <td>layer</td>
        <td>linewidth</td>
        <td>line color</td>
        <td></td>
        <td>fill color</td>
        <td></td>
    </tr>
    <tr>
        <td>0</td>
        <td><input></td>
        <td><input></td>
        <td><canvas></canvas></td>
        <td><input></td>
        <td><canvas></canvas></td>
    </tr>
    <tr>
        <td>1</td>
        <td><input></td>
        <td><input></td>
        <td><canvas></canvas></td>
        <td><input></td>
        <td><canvas></canvas></td>
    </tr>
    <tr>
        <td>2</td>
        <td><input></td>
        <td><input></td>
        <td><canvas></canvas></td>
        <td><input></td>
        <td><canvas></canvas></td>
    </tr>
    <tr>
        <td>3</td>
        <td><input></td>
        <td><input></td>
        <td><canvas></canvas></td>
        <td><input></td>
        <td><canvas></canvas></td>
    </tr>
    <tr>
        <td>4</td>
        <td><input></td>
        <td><input></td>
        <td><canvas></canvas></td>
        <td><input></td>
        <td><canvas></canvas></td>
    </tr>
    <tr>
        <td>5</td>
        <td><input></td>
        <td><input></td>
        <td><canvas></canvas></td>
        <td><input></td>
        <td><canvas></canvas></td>
    </tr>
    <tr>
        <td>6</td>
        <td><input></td>
        <td><input></td>
        <td><canvas></canvas></td>
        <td><input></td>
        <td><canvas></canvas></td>
    </tr>
    <tr>
        <td>7</td>
        <td><input></td>
        <td><input></td>
        <td><canvas></canvas></td>
        <td><input></td>
        <td><canvas></canvas></td>
    </tr>
</table>
<script>

jsonmode = false;
if(document.getElementById("jsondatadiv").innerHTML.length > 10){
    currentJSON = JSON.parse(document.getElementById("jsondatadiv").innerHTML);
    stylejson = currentJSON.styleJSON;
    jsonmode = true;
}
else{
    stylejson = JSON.parse(document.getElementById("datadiv").innerHTML);
}

path = document.getElementById("pathdiv").innerHTML;
if(path.length>1){
    currentFile = "symbols/" + path + "json/stylejson.txt";
    currentFile2 = "symbols/" + path + "json/currentjson.txt";
    document.getElementById("indexlink").href = "index.php?path=" + path; 
}
else{
    currentFile = "json/stylejson.txt";
    currentFile2 = "json/currentjson.txt";
}

canvaswidth = 100;
canvasheight = 20;
inputs = document.getElementById("maintable").getElementsByTagName("input");

init();


function init(){
    
    for(var index = 0;index < 8;index++){
        inputs[3*index].value = stylejson["line" + index.toString()];
        inputs[3*index + 1].value = stylejson["color" + index.toString()];
        inputs[3*index + 2].value = stylejson["fill" + index.toString()];
    }

    canvases = document.getElementById("maintable").getElementsByTagName("canvas");
    for(var index = 0;index < canvases.length;index++){
        canvases[index].width = canvaswidth;
        canvases[index].height = canvasheight;
    }
    
    redraw();
}

function redraw(){
    
    for(var index = 0;index < 8;index++){
        ctx = canvases[2*index].getContext("2d");
        ctx.clearRect(0,0,canvaswidth,canvasheight);
        ctx.strokeStyle = stylejson["color" + index.toString()];
        ctx.lineWidth = stylejson["line" + index.toString()];
        ctx.beginPath();
        ctx.moveTo(0,0.5*canvasheight);
        ctx.lineTo(canvaswidth,0.5*canvasheight);
        ctx.stroke();		
        ctx.closePath();
        
        ctx = canvases[2*index + 1].getContext("2d");
        ctx.fillStyle = stylejson["fill" + index.toString()];
        ctx.fillRect(0,0,canvaswidth,canvasheight);
    
    }
    document.getElementById("datadiv").innerHTML = JSON.stringify(stylejson,null,"    ");
    
    data = encodeURIComponent(JSON.stringify(stylejson,null,"    "));
    data2 = encodeURIComponent(JSON.stringify(currentJSON,null,"    "));
    
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php

    var httpc2 = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc2.open("POST", url, true);
    httpc2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc2.send("data="+data2+"&filename="+currentFile2);//send text to filesaver.php

}

for(var index = 0;index < 8;index++){
    inputs[3*index].id = "i" + (3*index).toString();
    inputs[3*index  + 1].id = "i" + (3*index + 1).toString();
    inputs[3*index  + 2].id = "i" + (3*index + 2).toString();

    inputs[3*index].onchange = function(){
        var inputIndex = parseInt(this.id.substring(1));
        stylejson["line" + (inputIndex/3).toString()] = parseInt(this.value);
        redraw();
    }
    inputs[3*index + 1].onchange = function(){
        var inputIndex = parseInt(this.id.substring(1));
        stylejson["color" + ((inputIndex - 1)/3).toString()] = this.value;
        redraw();
    }
    inputs[3*index + 2].onchange = function(){
        var inputIndex = parseInt(this.id.substring(1));
        stylejson["fill" + ((inputIndex - 2)/3).toString()] = this.value;
        redraw();
    }
}

</script>
<style>
body,input{
    font-size:22px;
    font-family:helvetica;
}
input{
    width:3em;
}
canvas{
    border:solid;
}
td{
    text-align:center;
    border:solid;
    width:200px;
}
table{
    border-collapse:collapse;
    width:100%;
}
</style>


</body>
</html>
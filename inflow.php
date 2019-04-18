<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Inflow</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
</head>
<body>
<div id = "inflow" style = "display:none;"><?php
    echo file_get_contents("json/inflow.txt");
?></div>
<div id = "thingsdiv" style = "display:none;"><?php
    $inflow = json_decode(file_get_contents("json/inflow.txt"));
    foreach($inflow as $source){
        $source = json_decode(file_get_contents($source."/json/outflow.txt"));
        foreach($source as $thing){
            echo $thing->name;
            echo ",";
        }
    }
?></div>


<table id = "toptable">
    <tr>
        <td>
            <a href = "index.php">
                <img src = "mapicons/mapfactory.svg" style = "width:50px">
            </a>
        </td>
        <td>name of new source:</td>
        <td><input id = "thingname"/></td>
        <td id = "gobutton"></td>                
    </tr>
</table>


<div id = "sourcesscroll"></div>
<div id = "thingscroll"></div>
<div id = "fetchscroll"></div>

<script>

inflow = JSON.parse(document.getElementById("inflow").innerHTML);

for(var index = 0;index < inflow.length;index++){
    var newp = document.createElement("P");
    newp.innerHTML = inflow[index];
    document.getElementById("sourcesscroll").appendChild(newp);
    
}


document.getElementById("gobutton").onclick = function(){

}

</script>


<style>

input{
    font-family:courier;
    font-size:20px;
}

#sourcesscroll{
    position:absolute;
    overflow:scroll;
    left:10px;
    width:35%;
    bottom:70%;
    top:80px;
    border:solid;
    border-width:3px;
    border-radius:10px;
}
#fetchscroll{
    position:absolute;
    overflow:scroll;
    left:10px;
    width:35%;
    bottom:35%;
    top:31%;
    border:solid;
    border-width:3px;
    border-radius:10px;
}

#thingscroll{
    position:absolute;
    overflow:scroll;
    left:37%;
    width:30%;
    bottom:10px;
    top:80px;
    border:solid;
    border-width:3px;
    border-radius:10px;
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
.deletebutton{
    width:20px;
    border:solid;
    cursor:pointer;
    text-align:right;
}
.deletebutton:hover{
    background-color:green;
}
.deletebutton:active{
    background-color:yellow;
}

#toptable{
    position:absolute;
    left:5px;
    top:5px;
    font-family:courier;
    font-size:14px;
}
#thingscroll p{
    border:solid;
}
#gobutton{
    width:40px;
    height:40px;
    background-color:#00ff00;
    border-radius:40%;
    border:solid;
    cursor:pointer;
}
#gobutton:hover{
    background-color:green;
}
#gobutton:active{
    background-color:yellow;
}
</style>

</body>
</html>
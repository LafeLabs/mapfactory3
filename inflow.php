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
<div id = "linkscroll"></div>

<a id= "thisoutlink" href = "json/outflow.txt">json/outflow.txt</a>

<script>

inflow = JSON.parse(document.getElementById("inflow").innerText);

for(var index = 0;index < inflow.length;index++){
    var newp = document.createElement("P");
    newp.innerHTML = inflow[index];
    newp.className = "button";
    document.getElementById("sourcesscroll").appendChild(newp);
    newp.onclick = function(){
        var httpc = new XMLHttpRequest();
        httpc.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                filedata = this.responseText;
                things = JSON.parse(filedata);
                for(var index = 0;index < things.length;index++){
                    var newa = document.createElement("A");
                    var newp = document.createElement("P");
                    newp.appendChild(newa);
                    document.getElementById("thingscroll").appendChild(newp);
                    newa.href = "fget.php?baseurl=" + sourceurl;
                    newa.href += "&thingname=" + things[index].name;
                    newa.innerHTML = newa.href;
                }
            }
        };
        sourceurl = this.innerHTML;
        httpc.open("GET", "fileloader.php?filename=" + this.innerHTML, true);
        httpc.send();
    }
}

/*
outflow = JSON.parse(document.getElementById("outflow").innerText);

for(var index = 0;index < outflow.length;index++){
    for(var sindex = 0;sindex < outflow[index].scrolls.length;sindex++){
        var newp = document.createElement("P");
        var newa = document.createElement("A");
        newa.innerHTML = outflow[index].scrolls[sindex].split("markdown/")[1];
        newa.href = "scroll/index.php?filename=" + outflow[index].scrolls[sindex].split("markdown/")[1];
        newp.appendChild(newa);
        document.getElementById("linkscroll").appendChild(newp);
    }
    for(var mindex = 0;mindex < outflow[index].maps.length;mindex++){
        var newp = document.createElement("P");
        var newa = document.createElement("A");
        newa.innerHTML = outflow[index].maps[mindex];
        newa.href = "index.php?path=" + outflow[index].maps[sindex];
        newp.appendChild(newa);
        document.getElementById("linkscroll").appendChild(newp);
    }    
    for(var sindex = 0;sindex < outflow[index].symbols.length;sindex++){
        var newp = document.createElement("P");
        var newa = document.createElement("A");
        newa.innerHTML = outflow[index].symbols[sindex];
        newa.href =      outflow[index].symbols[sindex];
        newp.appendChild(newa);
        document.getElementById("linkscroll").appendChild(newp);
    }    
    
}
*/

document.getElementById("gobutton").onclick = function(){
    var newsource = document.getElementById("thingname").value;
    inflow.push(newsource);
    data = encodeURIComponent(JSON.stringify(inflow,null,"    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data=" + data + "&filename=" + "json/inflow.txt");//send text to filesaver.php
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
    right:55%;
    bottom:53%;
    top:80px;
    border:solid;
    border-width:3px;
    border-radius:10px;
}
#thingscroll{
    position:absolute;
    overflow:scroll;
    left:10px;
    right:55%;
    bottom:10px;
    top:50%;
    border:solid;
    border-width:3px;
    border-radius:10px;
}

#linkscroll{
    position:absolute;
    overflow:scroll;
    right:10px;
    left:55%;
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
#thisoutlink{
    position:absolute;
    right:0px;
    top:0px;
    font-family:courier;
}
</style>

</body>
</html>
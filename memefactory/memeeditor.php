<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Meme Editor</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

</head>
<body>
<div id = "pathdiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo $_GET['path'];
    }
?></div>
<div id = "datadiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo file_get_contents($_GET['path']);
    }
    else{
        echo file_get_contents("json/meme.txt");        
    }
?></div>

<a id = "factorylink" href = "index.php" style = "position:absolute;left:10px;top:10px;z-index:4"><img src = "mapicons/memefactory.svg" style = "width:50px"></a>
<img class = "button" src = "mapicons/gobutton.svg" id = "savebutton"/>
<a id = "jsonlink"></a>
<div id = "tablescroll">
  <table id = "maintable">
    <thead>
    <tr id = "toprow">
        <td>src</td>
        <td>x</td>
        <td>y</td>
        <td>w</td>
        <td>angle</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </thead>
    <tbody id = "mainttablebody"></tbody>
  </table>
    
</div>

<script>

    path = document.getElementById("pathdiv").innerHTML;
    if(path.length > 1){
        pathset = true;
        document.getElementById("factorylink").href += "?path=" + path;
    
        document.getElementById("jsonlink").href = path;
        document.getElementById("jsonlink").innerHTML = path;
    }
    else{
        pathset = false;
        document.getElementById("jsonlink").href = "json/meme.txt";
        document.getElementById("jsonlink").innerHTML = "json/meme.txt";
    }


    meme = JSON.parse(document.getElementById("datadiv").innerHTML);

    for(var index = 0;index < meme.length;index++){
        var newtr = document.createElement("TR");
        document.getElementById("mainttablebody").appendChild(newtr);
        newtr.className = "inputrow";
//        newtr.id = "row" + index.toString();
        var newtd = document.createElement("TD");
        var newinput = document.createElement("INPUT");
        newinput.className = "srcinput";
        newinput.value = meme[index].src;
        newtd.appendChild(newinput);
        newtr.appendChild(newtd);
        var newtd = document.createElement("TD");
        var newinput = document.createElement("INPUT");
        newinput.className = "xinput";
        newinput.value = meme[index].x;
        newtd.appendChild(newinput);
        newtr.appendChild(newtd);
        var newtd = document.createElement("TD");
        var newinput = document.createElement("INPUT");
        newinput.className = "yinput";
        newinput.value = meme[index].y;
        newtd.appendChild(newinput);
        newtr.appendChild(newtd);
        var newtd = document.createElement("TD");
        var newinput = document.createElement("INPUT");
        newinput.className = "winput";
        newinput.value = meme[index].w;
        newtd.appendChild(newinput);
        newtr.appendChild(newtd);
        var newtd = document.createElement("TD");
        var newinput = document.createElement("INPUT");
        newinput.className = "angleinput";
        newinput.value = meme[index].angle;
        newtd.appendChild(newinput);
        newtr.appendChild(newtd);

        var newtd = document.createElement("TD");
        var newimg = document.createElement("IMG");
        newimg.classList.add("deletebutton","button");
        newimg.style.width = "35px";
        newimg.src = "mapicons/deletex.svg";
        newtd.appendChild(newimg);
        newtr.appendChild(newtd);
        newimg.onclick = function(){
            thisrow = this.parentNode.parentNode;
            document.getElementById("mainttablebody").removeChild(thisrow);
        }


        var newtd = document.createElement("TD");
        var newimg = document.createElement("IMG");
        newimg.classList.add("upbutton","button");
        newimg.style.width = "35px";
        newimg.src = "mapicons/uparrow.svg";
        newimg.onclick = function(){
            thisrow = this.parentNode.parentNode;
            if(thisrow.previousSibling != null){
                prevrow = thisrow.previousSibling;
                document.getElementById("mainttablebody").removeChild(thisrow);
                document.getElementById("mainttablebody").insertBefore(thisrow,prevrow);           
            }
        }
        newtd.appendChild(newimg);
        newtr.appendChild(newtd);
        
        var newtd = document.createElement("TD");
        var newimg = document.createElement("IMG");
        newimg.classList.add("downbutton","button");
        newimg.style.width = "35px";
        newimg.src = "mapicons/downarrow.svg";
        newimg.onclick = function(){
            thisrow = this.parentNode.parentNode;
            if(thisrow.nextSibling != null && thisrow.nextSibling.nextSibling != null){
                //neither last nor second to last
                nextnextrow = thisrow.nextSibling.nextSibling;
                document.getElementById("mainttablebody").removeChild(thisrow);
                document.getElementById("mainttablebody").insertBefore(thisrow,nextnextrow);
            }
            else{
                if(thisrow.nextSibling != null){
                    //second to last
                    document.getElementById("mainttablebody").removeChild(thisrow);
                    document.getElementById("mainttablebody").appendChild(thisrow);
                }else{
                    //last
                    //do nothing
                }
            }
        }
        newtd.appendChild(newimg);
        newtr.appendChild(newtd);   

        var newtd =  document.createElement("TD");
        var newimg = document.createElement("IMG");
        newimg.style.width = "35px";
        newimg.src = meme[index].src;
        newtd.appendChild(newimg);
        newtr.appendChild(newtd);   

        
    }



inputstyle = document.createElement("style");
document.body.appendChild(inputstyle);
inputstyle.innerHTML = "input{width:" + (0.1*innerWidth).toString() +"px}";    
    
document.getElementById("savebutton").onclick = function(){
    meme = [];
    bodyrows = document.getElementById("mainttablebody").getElementsByTagName("TR");
    for(var index = 0;index < bodyrows.length;index++){
        var localinputs = bodyrows[index].getElementsByTagName("INPUT");
        var localjson = {};
        localjson.src = localinputs[0].value;
        localjson.x = parseFloat(localinputs[1].value);
        localjson.y = parseFloat(localinputs[2].value);
        localjson.w = parseFloat(localinputs[3].value);
        localjson.angle = parseFloat(localinputs[4].value);
        meme.push(localjson);
    }
    savemap();
}    
    
function savemap(){
    if(pathset){
        currentFile = path;
    }
    else{
        currentFile = "json/meme.txt";
    }

    data = encodeURIComponent(JSON.stringify(meme,null,"    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data=" + data + "&filename=" + currentFile);//send text to filesaver.php
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
#tablescroll{
    position:absolute;
    left:0px;
    right:0px;
    top:110px;
    bottom:0px;
    overflow:scroll;
}
#maintable{
}
#savebutton{
    position:absolute;
    right:0px;
    top:0px;
    width:100px;
}
#jsonlink{
    position:absolute;
    left:50%;
    top:0px;
}
</style>
</body>
</html>
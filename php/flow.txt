<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Flow</title>

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
<div id = "outflow" style = "display:none;"><?php
    echo file_get_contents("json/outflow.txt");        
?></div>

<a id = "factorylink" href = "index.php" style = "position:absolute;left:10px;top:10px"><img src = "mapicons/mapfactory.svg" style = "width:50px"></a>

<div id = "linkscroll"></div>
<table id = "maintable">
    <tr>
        <td id = "gobutton"><img style = "width:100px;" class = "button" src = "mapicons/gobutton.svg"></td>
        <td>
            <img style = "width:100px" id = "mainimage"/>
        </td>
        <td id = "savebutton"><img style = "width:100px" class = "button" src = "mapicons/linker.svg"/></td>
    </tr>
    <tr>
        <td>imgurl:</td><td><input id = "imgurlinput"></td>
    </tr>
    <tr>
        <td>href:</td><td><input id = "hrefinput"></td>
    </tr>
    <tr>
        <td>text:</td><td><input id = "textinput"/></td>
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
        overflow:scroll;
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
    outflow = JSON.parse(document.getElementById("inflow").innerHTML);
    inflow = JSON.parse(document.getElementById("outflow").innerHTML);

</script>

</body>
</html>
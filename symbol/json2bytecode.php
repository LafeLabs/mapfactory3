<div id = "label1">JSON INPUT:</div>
<div id = "label2">BYTECODE OUTPUT:</div>
<div id = "gobutton">CONVERT</div>
<textarea id = "jsoninput"></textarea>
<textarea id = "bytecodeoutput"></textarea>
<script>
    document.getElementById("gobutton").onclick = function(){
        currentjson = JSON.parse(document.getElementById("jsoninput").value);
        foo = "";
        for(var index = 0;index < currentjson.table.length;index++){
            foo += currentjson.table[index] + "\n";
        }
        document.getElementById("bytecodeoutput").value = foo;
    }
</script>
<style>
    #label1{
        position:absolute;
        left:10px;
        top:10px;
    }
    #jsoninput{
        position:absolute;
        left:100px;
        top:100px;
        width:200px;
        height:300px;
    }
    #label2{
        position:absolute;
        right:10px;
        top:10px;
    }
    #bytecodeoutput{
        position:absolute;
        right:100px;
        top:100px;
        width:200px;
        height:300px;
    }
    #gobutton{
        position:absolute;
        left:50%;
        top:10px;
        border:solid;
        border-radius:10px;
        text-align:center;
        cursor:pointer;
    }
    #gobutton:hover{
        background-color:green;
    }
    #gobutton:active{
        background-color:yellow;
    }
</style>
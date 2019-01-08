 <!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Copy Map Factory</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

</head>
<body>
<a href = "index.php" style = "position:absolute;left:10px;top:10px;z-index:4"><img src = "mapicons/mapfactory.svg" style = "width:50px"></a>

<div id = "mainscroll">

<h2>How to make your own Map Factory</h2>

<p>To create your own instance of this software you need to create a free web hosting account, upload one program, then run that program and the code will all be copied over.  Then you can custommize it as you see fit, and show others how to replicate it.</p>

<h2>Steps to copy the factory:</h2>
<ol>
    <li>
            Get your free hosting account at <a href = "https://www.000webhost.com/free-website-sign-up">https://www.000webhost.com/free-website-sign-up</a>.  They will try to get you to get the paid hosting, which you can do later if you want but to get started the free one is fine.  You have to choose a name for your site, but since this is decentralized, picking a catchy name is not important, just something you can easily write down.  It could even be nonsense, as long as it's easy to write down and remember.   
    </li>
    <li>Navigate to the part of 000webhost where you can upload files to your main web directory.  Create a new file by clicking the appropriate icon and name it replicator.php.</li>
    <li>
        Open replicator.php in the editor, again clicking the appropriate link in the 000webhost interface, and copy and paste the code in this box:
        <textarea id = "replicatorcode"></textarea>
                Then save that file and close it.
    </li>
    <li>
        Navigate your browser to the location of your web address.  This is [your chosen site name].000webhostapp.com/.  You should see a listing of the files in your site, which is just replicator.php.  Click on it to run it, and wait, up to a couple minutes, while the files copy.  
    </li>
    <li>
        After a minute or two you should see a link to "index.php".  Click on it.  You are now in your new instance of Watershed Factory.
    </li>
    <li>
        If you don't have access to fancy GUI nonsense and are working from a shell command line using something like vi where copy paste are broken, you can type this php file in by hand to create a copy of replicator.php locally.  This file is called metareplicator.php.  You probably want to do something like 
        <pre>
            sudo vi metareplicator.php
            php metareplicator.php
        </pre>
        Here it is:
        <textarea id = "metareplicatorcode"></textarea>
    </li>
    <li>
        DO NOT PUT ANYTHING SECRET, PROPRIETARY, PERSONAL, CLASSIFIED, PRIVATE OR OF ANY MONETARY VALUE ON HERE!  This system is based on a "disposable server" model.  That is, on the assumption that the number of web servers is already greater than the number of human minds, and that each server can have thousands of instances of software like this, meaning the number of instances is many thousands per human mind for all of humanity.  This changes how we think of information and ultimately renders moot what is known as "cybersecurity".  However for the time being, as you have information which does need to be protected, keep it off this network or expect it to be copied and destroyed.  
    </li>
    
</ol>


     
</div>


<script>

    currentFile = "php/replicator.txt";
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            data = this.responseText;
            document.getElementById("replicatorcode").value = data;
        }
    };
    httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
    httpc.send();
    
    currentFile2 = "php/metareplicator.txt";
    var httpc2 = new XMLHttpRequest();
    httpc2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            data = this.responseText;
            document.getElementById("metareplicatorcode").value = data;
        }
    };
    httpc2.open("GET", "fileloader.php?filename=" + currentFile2, true);
    httpc2.send();

</script>
<style>
body{
    font-family:Helvetica;
    font-size:24px;
}
#mainscroll{
    position:absolute;
    overflow:scroll;
    bottom:0px;
    left:10px;
    right:10px;
    top:110px;
}
#replicatorcode{
    display:block;
    margin:auto;
    width:80%;
    height:35em;
    font-family:courier;
}
#metareplicatorcode{
    display:block;
    margin:auto;
    width:80%;
    height:10em;
    font-family:courier;
}

</style>
</body>
</html>
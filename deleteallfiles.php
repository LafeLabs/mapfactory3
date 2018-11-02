<?php
/*
DANGER ZONE!
THIS WILL DESTROY ALL THE THINGS!
NUKE IT FROM ORBIT; IT'S THE ONLY WAY TO BE SURE

More specifically this deletes everything in the directory in which it exists, including all the sub directories in that directory.  If this is executed at the top level of a web site it will completely clear out the site, including every kind of image, symbol, code, etc.  All links to that site will permanently fail.  

That being said, this is a critical tool for a decentralized and open web, and we must be prepared to use this often and easily as a every day part of using this web.  This is like erasing a chalk board: done at the wrong time it's a disaster, but if never done, the board becomes useless.  

This also puts the latest replicator.php file in the directory so that it can spawn the whole factory and you don't have to log into the server to restart.  
*/

$replicator = file_get_contents("https://raw.githubusercontent.com/LafeLabs/factory2/master/php/replicator.txt");
file_put_contents("replicator.php",$replicator);

function rrmdir($src) {
    $dir = opendir($src);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            $full = $src . '/' . $file;
            if ( is_dir($full) ) {
                rrmdir($full);
            }
            else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src);
}


$files = scandir(getcwd());

foreach($files as $value){
    if(is_dir($value) && $value != "." && $value != ".."){
        rrmdir($value);
    }
    else{
        if($value != "replicator.php"){
            unlink($value);
        }
    }

}
    


?>
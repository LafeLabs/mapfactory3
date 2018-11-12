<?php
$target_dir = "uploadimages/";
$files = scandir(getcwd()."/uploadimages");
$imageIndex =  count($files) - 1;
$infilename = basename( $_FILES["fileToUpload"]["name"]);
$extension = substr($infilename,-4);
$target_file = $target_dir . "image" . $imageIndex . $extension;
$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($target_file)) {
    $imageIndex +=  1;
    $target_file = $target_dir . "image" . $imageIndex . $extension;
}
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        
        $files = scandir(getcwd()."/uploadimages");
        $listtext = "";
        foreach(array_reverse($files) as $value){
            if($value != "." && $value != ".." && substr($value,-4) != ".txt"){
                $listtext .= $value.",";
            }
        }
        $file = fopen("uploadimages/list.txt","w");// create new file with this name
        fwrite($file,$listtext); //write data to file
        fclose($file);  //close file
}
else{
    echo "upload failed for some reason, possibly image size. Try screen shotting and uploading that(smaller) image.";    
        $files = scandir(getcwd()."/uploadimages");
        $listtext = "";
        foreach(array_reverse($files) as $value){
            if($value != "." && $value != ".." && substr($value,-4) != ".txt"){
                $listtext .= $value.",";
            }
        }
        $file = fopen("uploadimages/list.txt","w");// create new file with this name
        fwrite($file,$listtext); //write data to file
        fclose($file);  //close file
}


?>
<p style = "font-size:5em">
    <a href = "uploader.php">BACK</a>
</p>



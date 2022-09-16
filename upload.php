<!DOCTYPE html>                                                                                     
<html>
<body>
	<p>
	Upload a photo of your pet for other people to see!
	</p>
	<form action="/upload.php" method="post" enctype="multipart/form-data">
	<input type="file" id="fileToUpload" name="fileToUpload">
	<input type="submit" value="Upload Image" name="submit">
	</form>
</body>
</html>
<?php
$target_dir = "uploads/";

$images = glob($target_dir."*.*");

foreach($images as $image) {
    echo '<img src="'.$image.'" /><br />';
}


  if (isset($_POST["submit"])){

      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;

        $blacklist = array(".php","html","shtml",".phtml", ".php3", ".php4");
        foreach ($blacklist as $item) {
        if(preg_match("/$item$/", $_FILES['fileToUpload']['name'])) {
          echo "We do not allow uploading php,html,shtml,phtml,php3,php4 files.";
          $uploadOk = 0;

        }
        }
 
        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }
  
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          // $filename = pathinfo($target_file, PATHINFO_FILENAME) . "." . strtolower(pathinfo($target_file, PATHINFO_EXTENSION)) ;
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
 }
        ?>				

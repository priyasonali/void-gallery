<?php
$allowedExt = "jpg";
$temp = explode(".", $_FILES["item"]["name"]);
$extension = end($temp);
$extension = strtolower($extension);

$fname=substr(md5(uniqid(rand(), true)), 16, 10).".jpg";
while(file_exists('uploads/photos/' . $fname)){
$fname=substr(md5(uniqid(rand(), true)), 16, 10).".jpg";
}

if($_FILES["item"]["name"]==null) die("Error handling upload. Invalid parameters.");
else if($extension != $allowedExt) die("Invalid extension. Only .jpg allowed.");
else if($_FILES['item']['error'] > 0) die("Unexpected error while attempting upload.");
else if(!getimagesize($_FILES['item']['tmp_name'])) die("Invalid file format or not an image.");
else if(!($_FILES['item']['type'] == 'image/jpg' || $_FILES['item']['type'] == 'image/jpeg')) die("Invalid file type. Not JPEG or corrupt file.");
else if($_FILES['item']['size'] > 300000) die("Maximum allowed file size of 3MB exceeded.");
else if(!move_uploaded_file($_FILES['item']['tmp_name'], 'uploads/photos/' . $fname)) die("Unable to upload. Denied access at server.");

else{

echo "Successful upload !!";

/*
echo '<img src="img/upload/'.$fname.'" id="cropbox" />
<hr>
<form class="form-inline">
<input type="hidden" id="picsrc" value="'.$fname.'" />
<input type="hidden" id="x" name="x" />
<input type="hidden" id="y" name="y" />
<input type="hidden" id="w" name="w" />
<input type="hidden" id="h" name="h" />
<button type="button" class="btn btn-large btn-inverse uploadSubmit">Crop Image</button>
</form>
';
*/
}
?>
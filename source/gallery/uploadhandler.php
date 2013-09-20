<?php

$allowedExt = "jpg";
$temp = explode(".", $_FILES["item"]["name"]);
$extension = end($temp);
$extension = strtolower($extension);

$fname=substr(md5(uniqid(rand(), true)), 16, 10).".jpg";
while(file_exists('uploads/photos/' . $fname)){
$fname=substr(md5(uniqid(rand(), true)), 16, 10).".jpg";
}

if($_FILES['item']['error'] > 0) die("Unable to handle upload. Corrupt file or file too large.");
else if($_FILES['item']['size'] > 1000000) die("Maximum allowed file size of 1MB exceeded.");
else if($extension != $allowedExt) die("Invalid extension. Only .jpg allowed.");
else if(!getimagesize($_FILES['item']['tmp_name'])) die("Invalid file format or not an image.");
else if(!($_FILES['item']['type'] == 'image/jpg' || $_FILES['item']['type'] == 'image/jpeg')) die("Invalid file type. Not JPEG or corrupt file.");
else if(!move_uploaded_file($_FILES['item']['tmp_name'], 'uploads/photos/' . $fname)) die("Unable to upload. Denied access at server.");

else{
echo '
<form class="form-inline lead">
Now, 
<input type="hidden" id="picsrc" value="'.$fname.'" />
<input type="hidden" id="x" name="x" />
<input type="hidden" id="y" name="y" />
<input type="hidden" id="w" name="w" />
<input type="hidden" id="h" name="h" />
<input type="hidden" id="cid" name="cid"/>
<button type="button" class="btn btn-primary uploadSubmit">Crop Photo</button>
to create its thumbnail.
</form>

<img src="gallery/uploads/photos/'.$fname.'" id="cropbox" />
</section>
';
}
?>
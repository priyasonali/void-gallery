<?php

if(!empty($_FILES["item"]["name"]))
{
$allowedExt = "jpg";
$temp = explode(".", $_FILES["item"]["name"]);
$extension = end($temp);
$extension = strtolower($extension);

$fname=substr(md5(uniqid(rand(), true)), 16, 10).".jpg";
while(file_exists('uploads/photos/' . $fname)){
$fname=substr(md5(uniqid(rand(), true)), 16, 10).".jpg";
}

if($_FILES['item']['error'] > 0) echo "<p class='text-danger'>Unable to handle upload. Corrupt file or file too large. <a href=''>Click here</a> to retry.</p>";
else if($_FILES['item']['size'] > 1000000) echo "<p class='text-danger'>Maximum allowed file size of 1MB exceeded. <a href=''>Click here</a> to retry.</p>";
else if($extension != $allowedExt) echo "<p class='text-danger'>Invalid extension. Only .jpg allowed. <a href=''>Click here</a> to retry.</p>";
else if(!getimagesize($_FILES['item']['tmp_name'])) echo "<p class='text-danger'>Invalid file format or not an image. <a href=''>Click here</a> to retry.</p>";
else if(!($_FILES['item']['type'] == 'image/jpg' || $_FILES['item']['type'] == 'image/jpeg')) echo "<p class='text-danger'>Invalid file type. Not JPEG or corrupt file. <a href=''>Click here</a> to retry.</p>";
else if(!move_uploaded_file($_FILES['item']['tmp_name'], 'uploads/photos/' . $fname)) echo "<p class='text-danger'>Unable to upload. Denied access at server. <a href=''>Click here</a> to retry.</p>";

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
}
else
echo "<script>window.location.assign('../?p=error6');</script>";

?>
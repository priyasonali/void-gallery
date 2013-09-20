<?php

function parseInt($string) {
if(preg_match('/(\d+)/', $string, $array)) {
return $array[1];
} else {
return 0;
}
}

$test = false;
$chklist = array(
					"initcollection",
					"initphoto",
					"initvideo",
					"initupload",
					"viewcollection",
					"addvideo"
				);
				
$msglist = array(
					'<strong>Void Gallery [<em>Error Code: 0</em>]: </strong>Improper error handling or tampered link.
					<a href="?p=initcollection" class="alert-link">Click here</a> to re-initialize.',
					'<strong>Void Gallery [<em>Error Code: 1</em>]: </strong>Tampered/Broken link detected ! Unable to traverse.
				  <a href="?p=initcollection" class="alert-link">Click here</a> to re-initialize.',
					'<strong>Void Gallery [<em>Error Code: 2</em>]: </strong>This photo gallery is empty.
					<a href="?p=initcollection" class="alert-link">Click here</a> to re-initialize.',
					'<strong>Void Gallery [<em>Error Code: 3</em>]: </strong>This video gallery is empty.
					<a href="?p=initcollection" class="alert-link">Click here</a> to re-initialize.',
					'<strong>Void Gallery [<em>Error Code: 4</em>]: </strong>Upload Handler failed to start.'
				);

function showmsg($msg)
{
	echo '
			<div class="container">
				<div class="alert alert-dismissable alert-danger">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  '.$msg.'
				</div>
			</div>
		';
}				
				
if(!empty ($_REQUEST['p']))
	{
		$p=$_REQUEST['p'];
	}
else
	{
		$p="initcollection";
	}


if(strchr($p,"error")!=false)
{
	$errcode = parseInt($p);
	$msglistsize = sizeOf($msglist);
	if($errcode < $msglistsize)
	showmsg($msglist[$errcode]);
	else
	showmsg($msglist[0]);
}
else
{
	foreach ($chklist as $value)
	  {
		if($p == $value) 
		{
			$test= true;
			break;
		}
	  }
	  
	$test1 = strchr($p,"http://");
	$test2 = strchr($p,"https://");
	$test3 = strchr($p,"www.");

	if($test == false || $test1 != false || $test2 != false || $test3 != false  )
		{
			showmsg($msglist[1]);
		}
	else
		{
			$link = "gallery/".$p.".php";
			require $link;
		}
}
?>
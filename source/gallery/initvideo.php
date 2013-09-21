<?php
if(!defined('socket')) {
echo "<script>window.location.assign('../?p=error6');</script>";
}
$session = 0;
if(isset($_SESSION['gallerySession']))
{
if($_SESSION['gallerySession'] == "admin")
$session = 1;
}
echo '<section class="container">';

		require 'dbconnect.php';
	
		if(!empty($_REQUEST['cid']))
		{
			$cid = $_REQUEST['cid'];
		}
		else
		{
			echo '<script>window.location.assign("?p=error1");</script>';
		}
		if($cid<1 || !is_numeric($cid))	echo '<script>window.location.assign("?p=error1");</script>';
		
	    //Number of records
		$res = mysqli_query($con,"SELECT * FROM  assign WHERE cid=".$cid." AND vid != 0");
		$total_record=0;
		while($ro1 = mysqli_fetch_array($res))
		{
			$vid = $ro1['vid'];
			if ($session == 1)
			$total_record++;
			else
			{
				$res1 = mysqli_query($con,"SELECT * FROM video WHERE vid=".$vid." AND vstatus=1");
				while($ro2 = mysqli_fetch_array($res1))
				{
					$total_record++;
				}
			}
		}
		if($total_record==0) echo '<script>window.location.assign("?p=error3");</script>';

		//Limit of records to be displayed on each page
		$limit = 12; 

		//Total number of pages 
		$total_page = ceil($total_record/$limit);
	
		//Value of current page
		if( !empty($_REQUEST{'page'} ) )
			{
				$page =$page_num= $_REQUEST['page'];
				//Start point of each page
				$from = ($page - 1) * $limit;
			}
			else
			{
				$page=1;
				$from = 0;
			}
		
		//Checking for tampered link
		if($page>$total_page)
		{
			$page=$total_page;
			echo '<script>window.location.assign("?p=initvideo&cid='.$cid.'&page='.$page.'");</script>';						
		}
		else if($page<1 || !is_numeric($page))	echo '<script>window.location.assign("?p=error1");</script>';
			
		//Pagination variable
		$pagination=  '<section class="container text-center">
							<ul class="pagination">';	
		

			//Current page is less than 5
			if($page<=5)
			{
				//Previous
				$pagination.= '<li id="left" class="disabled"><a href="#">&laquo;</a></li>';

				//Total page greater than 5
				if($total_page>5)
				{
					for($i=1;$i<=5;$i++)
					{
					if($i!=$page)
						{
							//Page numbers
							$pagination.= "<li><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";
						}	
						//If total page less than 5
					else
					//Active page
					$pagination.= "<li class='active'><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";	
					}
					//Next
					$pagination.= "<li><a href='?p=initvideo&cid=".$cid."&page=6'>&raquo;</a></li>";
				}

				//If total page less than 5 
				else
				{
					for($i=1;$i<=$total_page;$i++)
					{
						if($i!=$page)
						{
							//Page numbers
							$pagination.= "<li><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";

						}	
						else
						//Active page
						$pagination.= "<li class='active'><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";
					}
					//Next
					$pagination.= "<li class='disabled'><a href='#'>&raquo;</a></li>";
				}

			}

			//If current page is greater than 5
			else
			{
				
				//If current page is 5 or it's multiple
				if($page%5==0)
					{
						$previous=$page-5;
						$next=$page+1;
						$page=$page-4;
						
						
						if($total_page>$page+5)
							{     
								//Previous
								$pagination.=  '<li id="left"><a href="?p=initvideo&cid='.$cid.'&page='.$previous.'">&laquo;</a></li>';
								for($i=$page;$i<($page+5);$i++)
									{
										if($i!=$page_num)
											{
												//Page numbers
												$pagination.= "<li><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";

											}	
										else
										//Active page
										$pagination.= "<li class='active'><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";	
									}
									//Next
									$pagination.= "<li><a href='?p=initvideo&cid=".$cid."&page=".$next."'>&raquo;</a></li>";
							}
						else
							{
								//Previous
								$pagination.=  '<li id="left"><a href="?p=initvideo&cid='.$cid.'&page='.$frst.'">&laquo;</a></li>';
									for($i=$page;$i<=$total_page;$i++)
										{
											if($i!=$page_num)
												{
													//Page numbers
													$pagination.= "<li><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";

												}	
											else
											//Active page
											$pagination.= "<li class='active'><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";	
										}
									//Next
									$pagination.= "<li class='disabled'><a href='#'>&raquo;</a></li>";
							}
					}

					//If current page is not 5 or it's multiple
					else
						{
							while($page%5!=0)
								{
									$page--;
								}
								
							$page++;
							$previous=$page-1;
							$next=$page+5;
							if($total_page>$page+5)
								{
									//Previous
									$pagination.=  '<li id="left"><a href="?p=initvideo&cid='.$cid.'&page='.$previous.'">&laquo;</a></li>';
									for($i=$page;$i<($page+5);$i++)
										{
											if($i!=$page_num)
												{
													//Page numbers
													$pagination.= "<li><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";
												}	
											else
											//Active page
											$pagination.= "<li class='active'><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";	
										}
									//Next
									$pagination.= "<li><a href='?p=initvideo&cid=".$cid."&page=".$next."'>&raquo;</a></li>";
								}
							else
								{
									//Previous
									$pagination.=  '<li id="left"><a href="?p=initvideo&cid='.$cid.'&page='.$previous.'">&laquo;</a></li>';
									for($i=$page;$i<=$total_page;$i++)
										{
											if($i!=$page_num)
												{
													//Page numbers
													$pagination.= "<li><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";

												}	
											else
											//Active page
											$pagination.= "<li class='active'><a href='?p=initvideo&cid=".$cid."&page=$i'>$i</a></li>";	
										}
									//Next
									$pagination.= "<li class='disabled'><a href='#'>&raquo;</a></li>";
								}
						}
				}

			$pagination.= "</ul></section>";
			
			$result2 = mysqli_query($con,"SELECT * FROM collection WHERE cid=".$cid." ");
			while($row2 = mysqli_fetch_array($result2))
				{
					$cname = $row2['cname']; 
				}
					echo '<div class="page-header">
									<h1>Videos in <a href="?p=viewcollection&cid='.$cid.'">'.$cname.'</a> ';
									if ($session == 1)
									echo '<a title="Add Video" href="?p=addvideo&cid='.$cid.'"><span class="glyphicon glyphicon-plus-sign"></span></a>';
									echo '</h1>
							</div>
						</section>
						<section class="container videoView">
							<div class="row">';
			
			$result3 = mysqli_query($con,"SELECT * FROM assign WHERE cid=".$cid." AND vid !=0 ORDER BY aid DESC LIMIT $from, $limit");
			while($row1 = mysqli_fetch_array($result3))
				{
					$vid = $row1['vid']; 
				
					if($session==1)
					$result = mysqli_query($con,"SELECT * FROM video WHERE vid=".$vid."  ");
					else
					$result = mysqli_query($con,"SELECT * FROM video WHERE vid=$vid AND vstatus=1 ");
					
					while($row = mysqli_fetch_array($result))
						{
							
							$vcode = $row['vcode']; 
							$vname = $row['vname']; 
							$vdesc = $row['vdesc']; 
							$vdate = $row['vdate']; 
							$vstatus = $row['vstatus']; 
							$vview = $row['vview']; 
								
															
							echo '					
								<div class="col-md-3 text-center panel panel-default">
									<div class="row">';
									if($vstatus==0)
									echo'<em> <h3 class="videoName text-muted">'.$vname.'</h3></em>';
									else
									echo' <h3 class="videoName">'.$vname.'</h3>';
									if ($session == 1)
									echo '<div class="row">										
											<a class="editVideo" title="Edit video" href="#" data-vid="'.$vid.'" data-vstatus="'.$vstatus.'" data-vname="'.$vname.'" data-vdesc="'.$vdesc.'"><span class="glyphicon glyphicon-edit"></span></a>&nbsp&nbsp&nbsp
											<a class="deleteVideo" title="Delete video" href="#" data-cid="'.$cid.'" data-vid="'.$vid.'"><span class="glyphicon glyphicon-trash"></span></a>
										  </div>';
									echo' <a class="fancybox-media" href="http://www.youtube.com/watch?v='.$vcode.'" data-vid="'.$vid.'"><img class="img-thumbnail" src="http://img.youtube.com/vi/'.$vcode.'/0.jpg" alt="video" /></a>
									</div>
									<div class="row">
										<div class="col-md-7">
											<p><strong>Added On:<br></strong><em><span class="videoDate">'.$vdate.'</span></em></p>
										</div>
										<div class="col-md-4">
											<p><strong>Views:<br></strong><em><span class="videoStatus">'.$vview.'</span></em></p>
										</div>
									</div>
									<div class="descWrap">
										<p class="videoDesc text-left">
										'.$vdesc.'
										</p>
									</div>
								</div>
								';
						}
				}
		echo '
				</div>
			</section>
		';
echo $pagination;
?>
	


<aside class="modal fade" id="systemModal" tabindex="-1" role="dialog" aria-labelledby="systemLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  <h4 class="modal-title">Modal title</h4>
		</div>
		<div class="modal-body">
		  ...
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  <button type="button" class="btn btn-primary">Save changes</button>
		</div>
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</aside><!-- /.modal -->

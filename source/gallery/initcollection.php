<?php
if(!defined('secureplug')) {
echo "<script>window.location.assign('../?p=error6');</script>";
}
$session = 0;
if(isset($_SESSION['gallerySession']))
{
if($_SESSION['gallerySession'] == "admin")
$session = 1;
}
?>
<section class="container">
	<div class="page-header">
		<h1>Collections <?php if ($session == 1) echo '<a class="addCollection" title="Add New Collection"  href="#"><span class="glyphicon glyphicon-plus-sign"></span></a>'; ?></h1>
	</div>
</section>

<section class="container collectionView">

		<?php
		require 'gallery/dbconnect.php';
		
			//Number of records
			if ($session == 1)
			$result = mysqli_query($con,"SELECT * FROM  collection");
			else
			$result = mysqli_query($con,"SELECT * FROM  collection WHERE cstatus = 1");
			$total_record=0;
			while($row = mysqli_fetch_array($result))
			{
				$total_record++;
			}
			
			//Check for empty records
			if($total_record == 0)
			{
			if ($session == 1)
			echo 'Welcome to <span class="text-danger lead"><strong>Void Gallery</strong></span>.<br><br>
			To begin with, <a class="addCollection" title="Add New Collection"  href="#">create</a> a new collection.';
			else
			echo 'The gallery seems to be empty. Please come back later.';
			}
			else
			{
				//Limit of records to be displayed on each page
				$limit = 12; 

				//Total number of pages 
				$total_page = ceil($total_record/$limit);
			
				//Value of current page
				if( !empty($_REQUEST{'page'} ) )
				{
					$page = $page_num = $_REQUEST['page'];
					//Start point of each page
					$from = ($page - 1) * $limit;
				}
				else
				{
					$page = $page_num = 1;
					$from = 0;
				}
				
				//Checking for tampered link
				if($page>$total_page)
				{
					$page=$total_page;
					echo '<script>window.location.assign("?p=initcollection&page='.$page.'");</script>';						
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
								$pagination.= "<li><a href='?p=initcollection&page=$i'>$i</a></li>";
							}	
							//If total page less than 5
						else
						//Active page
						$pagination.= "<li class='active'><a href='?p=initcollection&page=$i'>$i</a></li>";	
						}
						//Next
						$pagination.= "<li><a href='?p=initcollection&page=6'>&raquo;</a></li>";
					}

						//If total page less than 5 
					else
					{
						for($i=1;$i<=$total_page;$i++)
						{
							if($i!=$page)
							{
								//Page numbers
								$pagination.= "<li><a href='?p=initcollection&page=$i'>$i</a></li>";

							}	
							else
							//Active page
							$pagination.= "<li class='active'><a href='?p=initcollection&page=$i'>$i</a></li>";
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
									$pagination.=  '<li id="left"><a href="?p=initcollection&page='.$previous.'">&laquo;</a></li>';
									for($i=$page;$i<($page+5);$i++)
										{
											if($i!=$page_num)
												{
													//Page numbers
													$pagination.= "<li><a href='?p=initcollection&page=$i'>$i</a></li>";

												}	
											else
											//Active page
											$pagination.= "<li class='active'><a href='?p=initcollection&page=$i'>$i</a></li>";	
										}
										//Next
										$pagination.= "<li><a href='?p=initcollection&page=".$next."'>&raquo;</a></li>";
								}
							else
								{
									//Previous
									$pagination.=  '<li id="left"><a href="?p=initcollection&page='.$frst.'">&laquo;</a></li>';
									for($i=$page;$i<=$total_page;$i++)
										{
											if($i!=$page_num)
												{
													//Page numbers
													$pagination.= "<li><a href='?p=initcollection&page=$i'>$i</a></li>";

												}	
											else
											//Active page
											$pagination.= "<li class='active'><a href='?p=initcollection&page=$i'>$i</a></li>";	
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
										$pagination.=  '<li id="left"><a href="?p=initcollection&page='.$previous.'">&laquo;</a></li>';
										for($i=$page;$i<($page+5);$i++)
											{
												if($i!=$page_num)
													{
														//Page numbers
														$pagination.= "<li><a href='?p=initcollection&page=$i'>$i</a></li>";
													}	
												else
												//Active page
												$pagination.= "<li class='active'><a href='?p=initcollection&page=$i'>$i</a></li>";	
											}
										//Next
										$pagination.= "<li><a href='?p=initcollection&page=".$next."'>&raquo;</a></li>";
									}
								else
									{
										//Previous
										$pagination.=  '<li id="left"><a href="?p=initcollection&page='.$previous.'">&laquo;</a></li>';
										for($i=$page;$i<=$total_page;$i++)
											{
												if($i!=$page_num)
													{
														//Page numbers
														$pagination.= "<li><a href='?p=initcollection&page=$i'>$i</a></li>";

													}	
												else
												//Active page
												$pagination.= "<li class='active'><a href='?p=initcollection&page=$i'>$i</a></li>";	
											}
										//Next
										$pagination.= "<li class='disabled'><a href='#'>&raquo;</a></li>";
									}
							}
				}

				$pagination.= "</ul></section>";
			
				$count=0;
				if ($session == 1)
				$result = mysqli_query($con,"SELECT * FROM collection ORDER BY cid DESC LIMIT $from, $limit ");
				else
				$result = mysqli_query($con,"SELECT * FROM collection WHERE cstatus=1 ORDER BY cid DESC LIMIT $from, $limit ");
				while($row = mysqli_fetch_array($result))
				{
					$count++;
					$total_items=0;
					$cid = $row['cid']; 
					$cname = $row['cname']; 
					$cdesc = $row['cdesc']; 
					$cdate = $row['cdate']; 
					$cstatus = $row['cstatus']; 
					$length=strlen($cdesc);
					if($length>140)
					{
						$shortdesc = substr($cdesc, 0, 140);
						$descPart = $shortdesc.'...<a href="p=?viewcollection&cid='.$cid.'"><button class="btn btn-primary btn-xs">More<span class="glyphicon glyphicon-chevron-right pull-right"></span></button></a>';
					}
					else
					{
						$shortdesc = $cdesc;
						$descPart = $shortdesc;
					}
					$result1 = mysqli_query($con,"SELECT * FROM assign WHERE cid=".$cid."");
					while($row1 = mysqli_fetch_array($result1))
					{
						$total_items++;
					}
					if($cstatus==0)
					{
						$imgSrc = 'gallery/img/collection-disabled.png';
						$titlePart = '<em><h3 class="collectionName text-muted">'.$cname.'</h3></em>';
					}
					else 
					{
						$imgSrc = 'gallery/img/collection.png';
						$titlePart = '<h3 class="collectionName">'.$cname.'</h3>';
					}
					if($count==1 || $count==5 || $count==9)
					{
						echo '<div class="row">';
					}					
					echo '					
						<div class="col-md-3 text-center panel panel-default">
							'.$titlePart;
					if ($session == 1) echo '
							<div class="row">
									<a class="editCollection" title="Edit Collection" href="#" data-cid="'.$cid.'" data-cstatus="'.$cstatus.'" data-cname="'.$cname.'" data-cdesc="'.$cdesc.'"><span class="glyphicon glyphicon-edit"></span></a>&nbsp&nbsp&nbsp
									<a class="addToCollection" title="Add Items" href="#" data-cid="'.$cid.'" data-cstatus="'.$cstatus.'" data-cname="'.$cname.'" data-cdesc="'.$cdesc.'"><span class="glyphicon glyphicon-plus-sign"></span></a>&nbsp&nbsp&nbsp
									<a class="deleteCollection" title="Delete Collection" href="#" data-cid="'.$cid.'" data-cstatus="'.$cstatus.'" data-cname="'.$cname.'" data-cdesc="'.$cdesc.'"><span class="glyphicon glyphicon-trash"></span></a>
							</div>';
							
					
					echo '
							<a href="?p=viewcollection&cid='.$cid.'">
								<img src="'.$imgSrc.'" width="150px" height="150px" alt="collection"/>
							</a>
							<div class="row">
								<div class="col-md-7">
									<p><strong>Last Updated:<br></strong><em><span class="collectionDate">'.$cdate.'</span></em></p>
								</div>
								<div class="col-md-4">
									<p><strong>Items:<br></strong><em><span class="collectionDate">'.$total_items.'</span></em></p>
								</div>
							</div>
							<div class="descWrap">
								<p class="collectionDesc text-left">
									'.$descPart.'
								</p>
							</div>
						</div>';
						if($count==4 || $count==8 || $count==12)
						{
							echo '</div>';
						}
				}
				echo '
					</section>';
				echo $pagination;
			}	
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

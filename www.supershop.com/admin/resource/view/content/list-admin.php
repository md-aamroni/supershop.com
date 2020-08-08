<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/AdminController.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$adminCtrl = new AdminController;
$eloquent = new Eloquent;


## ===*=== [D]ELETE ADMIN DATA ===*=== ##
if( isset($_POST['try_delete']) )
{
	$rowDeleted = $adminCtrl->deleteAdminData($_POST['id']);
}
## ===*=== [D]ELETE ADMIN DATA ===*=== ##


## ===*=== [C]HANGE ADMIN STATUS ===*=== ##
if( isset($_POST['try_status_change']) )
{
	$statusChange = $adminCtrl->changeAdminStatus($_POST['id'], $_POST['current_status']);
}
## ===*=== [C]HANGE ADMIN STATUS ===*=== ##


## ===*=== [F]ETCH ADMIN DATA ===*=== ##
$adminList = $adminCtrl->listAdminData();
## ===*=== [F]ETCH ADMIN DATA ===*=== ##
?>

<!--=*= ADMIN LIST SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home </a> </li>
				<li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> List Admin </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					List of Admin
				</header>
				<div class="panel-body">
					
					<?php
						# DELETE CONFIRMATION MESSAGE
						if( isset($_POST['try_delete']) )
						{
							if($rowDeleted > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE ADMIN DATA IS <strong> DELETED SUCCESSFULLY </strong>
										</div>';
							}
							else
							{
								echo '<div class="alert alert-warning fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											SOMETHING WENT WRONG TO DELETE DATA! <strong> PLEASE RECHECK </strong>
										</div>';
							}
						}
						
						# STATUS CHANGE CONFIRMATION MESSAGE
						if( isset($_POST['try_status_change']) )
						{
							if($statusChange > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE ADMIN STATUS IS <strong> CHANGED SUCCESSFULLY </strong>
										</div>';
							}
							else
							{
								echo '<div class="alert alert-warning fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											SOMETHING WENT WRONG TO CHANGE STATUS! <strong> PLEASE RECHECK </strong>
										</div>';
							}
						}
					?>
					
					<div class="adv-table">
						<table class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th style="width: 5%"> ID </th>
									<th style="width: 22%"> Admin Name </th>
									<th style="width: 20%"> Admin Email </th>
									<th style="width: 10%"> Admin Image </th>
									<th style="width: 18%"> Admin Type </th>
									<th style="width: 10%"> Admin Status </th>
									<th style="width: 15%" class="hidden-phone"> Action </th>
								</tr>
							</thead>
							<tbody>
								
								<?php 
									#== ADMIN DATA TABLE
									$n = 1;
									foreach($adminList AS $eachRow)
									{
										# IF IMAGE IS NOT FOUND OR SOMEHOW MISSING
										if(empty($eachRow['admin_image']))
										{
											$adminImage = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
										}
										else
										{
											$adminImage = $GLOBALS['ADMINS_DIRECTORY'].$eachRow['admin_image'];
										}
										
										echo '
										<tr class="gradeA">
											<td>'. $n .'</td>
											<td>'. $eachRow['admin_name'] .'</td>
											<td>'. $eachRow['admin_email'] .'</td>
											<td class="center">
												<a target="_blank" href="'. $adminImage .'">
													<img src="'. $adminImage .'" class="img-circle" height="48px" width="45px" style="border: 1px outset green;">
												</a>
											</td>
											<td>'.$eachRow['admin_type'].'</td>
											<td class="center">
												<div>
													<form action="" method="post">
														<input type="hidden" name="id" value="'. $eachRow['id'] .'" />
														<input type="hidden" name="current_status" value="'. $eachRow['admin_status'] .'" />
														<button name="try_status_change" class="btn btn-info btn-xs" style="width: 76px;" type="submit">'. $eachRow['admin_status'] .'</button>
													</form>
												</div>
											</td>
											<td class="center">
												<div class="row">
													<form action="" method="post" style="display: inline">
														<input type="hidden" name="id" value="'. $eachRow['id'] .'" />
														<button name="try_delete" type="submit" style="width: 76px;" class="btn btn-danger btn-xs" type="button">
															<i class="fa fa-trash-o"></i> Delete
														</button>
													</form>
													<form action="edit-admin.php" method="post" style="display: inline">
														<input type="hidden" name="id" value="'. $eachRow['id'] .'" />
														<button name="try_edit" class="btn btn-warning btn-xs" style="width: 76px;" type="submit">
															<i class="fa fa-pencil-square"></i> Edit
														</button>
													</form>
												</div>
											</td>
										</tr>
										';
										$n++;
									}
								?>
								
							</tbody>
							<tfoot>
								<tr>
									<th> ID </th>
									<th> Admin Name </th>
									<th> Admin Email </th>
									<th> Admin Image </th>
									<th> Admin Type </th>
									<th> Admin Status </th>
									<th> Action </th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= ADMIN LIST SECTION START =*=-->
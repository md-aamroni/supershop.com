<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;


## ===*=== [D]ELETE PAGES DATA ===*=== ##
if(isset($_REQUEST['did']))
{	
	#== DELETE THE DATA
	$tableName = $whereValue = null;
	$tableName = "pages";
	$whereValue["id"] = $_REQUEST['did'];
	$deletePagesData = $eloquent->deleteData($tableName, $whereValue);
}
## ===*=== [D]ELETE PAGES DATA ===*=== ##


## ===*=== [C]HANGE PAGES STATUS ===*=== ##
if(isset($_POST['change_status']))
{
	$tableName = $whereValue = $columnValue = null;
	$tableName = "pages";
	$whereValue["id"] = $_POST['page_status_id'];
	
	if($_POST['current_status'] == "Active")
	{
		$columnValue["page_status"] = "Inactive";
	}
	else if($_POST['current_status'] == "Inactive")
	{
		$columnValue["page_status"] = "Active";
	}
	
	$updatecustomerStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
## ===*=== [C]HANGE PAGES STATUS ===*=== ##


## ===*=== [F]ETCH PAGES DATA ===*=== ##
$columnName = $tableName = null;
$columnName = "*";
$tableName = "pages";
$pagesDetails = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH PAGES DATA ===*=== ##
?>

<!--=*= CUSTOMER LIST SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home </a> </li>
				<li> <a href="dashboard.php">Dashboard</a></li>
				<li class="active"> Pages List </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					List of Page Details
				</header>
				<div class="panel-body">
					
					<?php
						# DELETE CONFIRMATION MESSAGE
						if(isset($_REQUEST['did']))
						{
							if($deletePagesData > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE PAGES DATA IS <strong> DELETED SUCCESSFULLY </strong>
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
						if(isset($_POST['change_status']))
						{
							if($updatecustomerStatus > 0)
							{
								echo '<div class="alert alert-success fade in">
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> 
											THE PAGES STATUS IS <strong> UPDATED SUCCESSFULLY </strong>
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
						<table class="display table table-bordered" id="dynamic-table">
							<thead>
								<tr>
									<th style="width: 4%"> ID </th>
									<th style="width: 10%"> Pages </th>
									<th style="width: 25%"> Meta Keyword </th>
									<th style="width: 40%"> Meta Description </th>
									<th style="width: 7%"> Status </th>
									<th style="width: 14%"> Action </th>
								</tr>
							</thead>
							<tbody>
								
							<?php 
								#== CUSTOMER DATA TABLE
								$n = 1;
								foreach ($pagesDetails as $eachRow) 
								{
									echo '
									<tr class="gradeX">
										<td>'. $n .'</td>
										<td>'. $eachRow["page_title"] .'</td>
										<td>'. $eachRow["meta_keyword"] .'</td>
										<td>'. $eachRow["meta_description"] .'</td>
										
										<td>
											<form method="post" action="">
												<input type="hidden" name="page_status_id" value="'. $eachRow["id"] .'"/>
												<input type="hidden" name="current_status" value="'. $eachRow["page_status"] .'"/>
												<button name="change_status" class="btn btn-info btn-xs" style="width: 66px;" type="submit">'. $eachRow["page_status"] .'</button>
											</form>
										</td>
										<td class="center">
											<div class="row">
											<a data-id="'. $eachRow['id'] .'" class="btn btn-danger btn-xs deleteButton" href="#deleteModal" style="width: 76px;" data-toggle="modal">
												<i class="fa fa-trash-o"></i> Delete
											</a>
												<form method="post" action="edit-pages.php" style="display: inline;">
													<input type="hidden" name="id" value="'. $eachRow['id'] .'"/>
													<button name="try_edit" class="btn btn-warning btn-xs" style="width: 66px;" type="submit">
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
									<th> Pages </th>
									<th> Meta Keyword </th>
									<th> Meta Description </th>
									<th> Status </th>
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
<!--=*= CUSTOMER LIST SECTION START =*=-->

<!--=*= DELETE MODAL =*=-->
<div class="modal small fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"> Delete Pages </h4>
			</div>
			<div class="modal-body">
				<h5> Are you sure you want to delete this Pages Data? </h5>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default"data-dismiss="modal" aria-hidden="true"> Cancel </button> 
				<a href="pages-details.php" class="btn btn-danger" id="modalDelete"> Delete </a>
			</div>
		</div>
	</div>
</div>
<!--=*= DELETE MODAL =*=-->

<!--=*= SCRIPT TO DELETE DATA =*=-->
<script type="text/javascript">
	$('.deleteButton').click(function(){
		var id = $(this).data('id');
		
		$('#modalDelete').attr('href','pages-details.php?did='+id);
	})
</script>	
<!--=*= SCRIPT TO DELETE DATA =*=-->
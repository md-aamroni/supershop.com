<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;


## ===*=== [D]ELETE CUSTOMERS DATA ===*=== ##
if(isset($_POST['customer_review']))
{
	$tableName = $whereValue = null;
	$tableName = "contacts";
	$whereValue["id"] = $_POST['review_id'];
	$deleteReviewData = $eloquent->deleteData($tableName, $whereValue);
}	
## ===*=== [D]ELETE CUSTOMERS DATA ===*=== ##


## ===*=== [L]IST OF CONTACTED USER ===*=== ##
$columnName = $tableName = null;
$columnName = "*";
$tableName = "contacts";
$reviewData = $eloquent->selectData($columnName, $tableName);
## ===*=== [L]IST OF CONTACTED USER ===*=== ##
?>

<!--=*= REVIEW SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home </a> </li>
				<li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> Review </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					List of Reviews
				</header>
				<div class="panel-body">
					
					<?php
						#== DELETE CONFIRMATION MESSAGE
						if(isset($_REQUEST['did']))
						{
							if($deleteReviewData > 0)
							{
								echo '<div class="alert alert-success fade in">
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> 
											THE CUSTOMER DATA IS <strong> DELETED SUCCESSFULLY </strong>
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
					?>	
					
					<div class="adv-table">
						<table class="display table table-bordered" id="dynamic-table">
							<thead>
								<tr>
									<th style="width: 5%"> ID </th>
									<th style="width: 15%"> User Name </th>
									<th style="width: 15%"> User Email </th>
									<th style="width: 10%"> User Mobile </th>
									<th style="width: 37%"> User Comments </th>
									<th style="width: 10%"> Date </th>
									<th style="width: 8%"> Action </th>
								</tr>
							</thead>
							<tbody>
								
							<?php
								#== CUSTOMER REVIEW DATA TABLE
								$n = 1;
								foreach ($reviewData as $eachRow) 
								{
									echo '
									<tr class="gradeX">
										<td>'. $n .'</td>
										<td>'. $eachRow["contacts_name"] .'</td>
										<td>'. $eachRow["contacts_email"] .'</td>
										<td>'. $eachRow["contacts_phone"] .'</td>
										<td style="width: 400px;">'. $eachRow["contacts_overview"] .'</td>
										<td>'. $eachRow["created_at"] .'</td>
										<td class="center">
											<form action="" method="post">
												<input type="hidden" name="review_id" value="'. $eachRow["id"] .'"> 
												<button type="submit" name="customer_review" style="width: 76px;" class="btn btn-danger btn-xs float-right">
													<i class="fa fa-trash-o"></i> Delete
												</button>
											</form>
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
									<th> User Name </th>
									<th> User Email </th>
									<th> User Mobile </th>
									<th> User Comments </th>
									<th> Date </th>
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
<!--=*= REVIEW SECTION END =*=-->																			
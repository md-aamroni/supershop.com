<?php
	class AdminController extends Controller
{
	## [L]ogin Function | ADMIN LOGIN
	public function tryLogin($username, $password)
	{
		$sql_code = "SELECT * FROM `admins` WHERE `admin_email`=:VALUE1 AND `admin_password`=:VALUE2";
		$query = $this->connection->prepare($sql_code);
		
		$values = array(
			':VALUE1' => $username,
			':VALUE2' => $password
			);
		$query->execute($values);
		
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}	
	
	## [L]ogin Function | ADMIN LOGIN FOR LOCKSCREEN
	public function unLock($password)
	{
		$sql_code = "SELECT * FROM `admins` WHERE `admin_password`=:VALUE";
		$query = $this->connection->prepare($sql_code);
		
		$values = array(
			':VALUE' => $password
			);
		$query->execute($values);
		
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}
	
	
	## [I]nsert Function | CREATE NEW DATA
	public function createAdminData($admin_name, $admin_email, $admin_image, $admin_password, $admin_type, $admin_status)
	{
		// TO INSERT COLUMN DATA BY SQL QUERY HERE, WE JUST ASSIGN ANOTHER VALUE TO PASS THE DATA
		$sql_code = "
		INSERT INTO `admins` (`admin_name`, `admin_email`, `admin_image`, `admin_password`, `admin_type`, `admin_status`, `created_at`) 
		VALUES (:ADMIN_NAME, :ADMIN_EMAIL, :ADMIN_IMAGE, :ADMIN_PASSWORD, :ADMIN_TYPE, :ADMIN_STATUS, :CREATED_AT)
		";
		
		$query = $this->connection->prepare($sql_code);		// PREPARE YOUR SQL QUERY

		// PUT YOUR VALUES IN A ARRAY
		$values = array(
			':ADMIN_NAME'			=> $admin_name, 
			':ADMIN_EMAIL' 			=> $admin_email, 
			':ADMIN_IMAGE'			=> $admin_image, 
			':ADMIN_PASSWORD'	=> $admin_password,
			':ADMIN_TYPE' 				=> $admin_type,
			':ADMIN_STATUS'			=> $admin_status,
			':CREATED_AT'				=> date("Y-m-d H:i:s")
		);
		
		$query->execute($values);										// PASS YOUR VALUES IN THE EXECUTE FUNCTION, AND RUN SQL QUERY
		$totalRowInserted = $query->rowCount();				// COUNT TOTAL ROWS THAT OUR SQL QUERY HAS INSERTED
		$lastInsertId = $this->connection->lastInsertId();		// BRING THE LAST INSERT ID FROM DATABASE

			return $totalRowInserted;
	}
	
	
	## [L]ist Function | LIST OF DATA
	public function listAdminData()
	{
		$sql_code = "SELECT * FROM `admins`";
		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}
	

	## [U]pdate Function | TO UPDATE EXISTING DATA
	public function editAdminData($id, $admin_name, $admin_email, $admin_image, $admin_type, $admin_status)
	{
		// PUT YOUR SQL QUERY IN A VARIABLE
		$sql_code = "
			UPDATE `admins` 
			SET `admin_name`=:ADMIN_NAME,
				`admin_email`=:ADMIN_EMAIL,
				`admin_image`=:ADMIN_IMAGE,
				`admin_type`=:ADMIN_TYPE,
				`admin_status`=:ADMIN_STATUS
			WHERE `id` = :ID
		";

		$query = $this->connection->prepare($sql_code);
		$values = array(	
				':ADMIN_NAME'	=> $admin_name,
				':ADMIN_EMAIL'	=> $admin_email,
				':ADMIN_IMAGE'	=> $admin_image,
				':ADMIN_TYPE'		=> $admin_type,
				':ADMIN_STATUS'	=> $admin_status,
				':ID'						=> $id
		);
		
		$query->execute($values);
		$totalRowUpdated = $query->rowCount();
		
			return $totalRowUpdated;
	}	
	
	## [U]pdate Function | UPDATE if image will be static
	public function updateAdminData($id, $admin_name, $admin_email, $admin_type, $admin_status)
	{
		# PUT YOUR SQL QUERY IN A VARIABLE
		$sql_code = "
			UPDATE `admins` 
			SET `admin_name`=:ADMIN_NAME,
				`admin_email`=:ADMIN_EMAIL,
				`admin_type`=:ADMIN_TYPE,
				`admin_status`=:ADMIN_STATUS
			WHERE `id` = :ID
		";

		# PREPARE YOUR SQL QUERY
		$query = $this->connection->prepare($sql_code);

		# PUT YOUR VALUES IN A ARRAY
		$values = array(
			':ADMIN_NAME' => $admin_name,
			':ADMIN_EMAIL' => $admin_email,
			':ADMIN_TYPE' => $admin_type,
			':ADMIN_STATUS' => $admin_status,
			':ID' => $id
		);

		# PASS YOUR VALUES IN THE EXECUTE FUNCTION, AND RUN SQL QUERY
		$query->execute($values);

		# COUNT TOTAL ROWS THAT OUR SQL QUERY HAS UPDATED/AFFECTED
		$totalRowUpdated = $query->rowCount();
		
		return $totalRowUpdated;
	}
	
	
	## [D]elete Function | DELETE DATA
	public function deleteAdminData($admin_id)
	{
		$sql_code = "DELETE FROM `admins` WHERE id=:ID";
		$query = $this->connection->prepare($sql_code);
		$values = array( ':ID' => $admin_id );
		$query->execute($values);
		$deletedRowNumber = $query->rowCount();
		
			return $deletedRowNumber;
	}
	
	
	## [C]hange Function | TO CHANGE EXISTING VALUE
	public function changeAdminStatus($admin_id, $current_status)
	{
		// CHECK EXISTING DATA AND THEN REPLACE THE DATA
		if($current_status == "Active")
			$sql_code = "UPDATE `admins` SET `admin_status`='Inactive' WHERE `id` = :ID";	
		else if($current_status == "Inactive")
			$sql_code = "UPDATE `admins` SET `admin_status`='Active' WHERE `id` = :ID";

		$query = $this->connection->prepare($sql_code);
		$values = array( ':ID' => $admin_id );
		$query->execute($values);
		$totalRowUpdated = $query->rowCount();
		
			return $totalRowUpdated;
	}
	
	
	## [G]et Function | TO GET PREVIOUS DATA INTO THE INPUT FIELD AS VALUE OR PLACEHOLDER BASED ON ADMIN ID
	public function getAdminData($admin_id)
	{
		$sql_code = "SELECT * FROM `admins` WHERE `id`=:ID";
		$query = $this->connection->prepare($sql_code);
		
		$values = array( ':ID' => $admin_id );
		$query->execute($values);
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}
	
}
?>
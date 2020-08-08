<?php
	
	class PageController extends Controller
	{
		## [F]ETCH ALL THE DATA AS PER ID
		public function fetchData($table, $column, $id)
		{
			$sql_code = "SELECT * FROM {$table} WHERE {$column} = {$id}";
			$query = $this->connection->prepare($sql_code);
			$query->execute();
			$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
			$totalRowSelected = $query->rowCount();
			
			if($totalRowSelected > 0)
				return $dataList;
			else
				return 0;
		}
		
		## [F]ETCH ALL THE DATA AS PER ID BASED ON LIMIT
		public function paginateData($table, $column, $id, $start, $end)
		{
			$sql_code1 = "SELECT * FROM {$table} WHERE {$column} = {$id} LIMIT {$start}, {$end}";
			$query = $this->connection->prepare($sql_code1);
			$query->execute();
			$pageList = $query->fetchAll(PDO::FETCH_ASSOC);
			$totalPageSelected = $query->rowCount();
			
			if($totalPageSelected > 0)
				return $pageList;
			else
				return 0;
		}		
		
		## [F]ETCH ALL THE DATA AS PER KEYWORD FOR SEARCH AUTOCOMPLETE
		public function searchAuto($table, $column,$keyword)
		{
			$sql_code1 = "SELECT DISTINCT {$column} FROM {$table} WHERE {$column} LIKE '%{$keyword}%' OR {$column} LIKE '%{$keyword}%' ORDER BY {$column} ASC";
			$query = $this->connection->prepare($sql_code1);
			$query->execute();
			$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
			$totalRowSelected = $query->rowCount();
			
			if($totalRowSelected > 0)
				return $dataList;
			else
				return 0;
		}
	}
?>
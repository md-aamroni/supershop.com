<?php
## ===*=== [S]ESSION FOR CUSTOMER LOGOUT ===*=== ##
if(@$_REQUEST['exit'] == "yes")
{
	session_start() ;
	session_destroy() ;
	header("Location: index.php");
}
## ===*=== [S]ESSION FOR CUSTOMER LOGOUT ===*=== ##
?>
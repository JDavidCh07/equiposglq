<?php
	session_start();
	$aut = isset($_SESSION["aut"]) ? $_SESSION["aut"]:NULL;
	if(session_status()!=2 or $aut!="ht92Ic37=glQiCo@Q2!?"){
		if(session_status()!=2 or $aut!=""){
			session_destroy();
			header("Location: index.php");
			exit();
		}
	}
?>
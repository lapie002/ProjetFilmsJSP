<?php

	require_once("../../config.php");
	
	if(isset($_GET['id']))
	{
	
		$query = query("DELETE FROM administrateur WHERE idadmin = " . escape_string($_GET['id']) . " ");
		confirm($query);
		
		set_message("Admin deleted successfully.");
		
		redirect("../../../public/admin/index.php?admins");
		
	}
	else
	{
		redirect("../../../public/admin/index.php?admins");
	}

?>
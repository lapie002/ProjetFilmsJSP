<?php
	require_once("../../config.php");
	
	if(isset($_GET['id']))
	{
	
		$query = query("DELETE FROM FILM WHERE IDFILM = " . escape_string($_GET['id']) . " ");
		confirm($query);
		
		set_message("The Film selected was successfully deleted.");
		
		redirect("../../../public/admin/index.php?films");
		
	}
	else
	{
		redirect("../../../public/admin/index.php?films");
	}

?>
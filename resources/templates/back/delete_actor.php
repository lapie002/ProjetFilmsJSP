<?php

	require_once("../../config.php");
	
	if(isset($_GET['id']))
	{
	
		$query = query("DELETE FROM ACTEUR WHERE IDACTEUR = " . escape_string($_GET['id']) . " ");
		confirm($query);
		
		set_message("Actor deleted successfully.");
		
		redirect("../../../public/admin/index.php?actors");
		
	}
	else
	{
		redirect("../../../public/admin/index.php?actors");
	}

?>
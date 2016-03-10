<?php

	require_once("../../config.php");
	
	if(isset($_GET['id']))
	{
	
		$query = query("DELETE FROM REALISATEUR WHERE IDREALISATEUR = " . escape_string($_GET['id']) . " ");
		confirm($query);
		
		set_message("Director deleted successfully.");
		
		redirect("../../../public/admin/index.php?directors");
		
	}
	else
	{
		redirect("../../../public/admin/index.php?directors");
	}

?>
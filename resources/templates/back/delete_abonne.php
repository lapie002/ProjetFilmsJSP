<?php

	require_once("../../config.php");
	
	if(isset($_GET['id']))
	{
		$query = query("DELETE FROM ABONNE WHERE IDABONNE = " . escape_string($_GET['id']) . " ");
		confirm($query);
		
		set_message("Member deleted successfully.");
		
		redirect("../../../public/admin/index.php?abonnes");
		
	}
	else
	{
		redirect("../../../public/admin/index.php?abonnes");
	}

?>
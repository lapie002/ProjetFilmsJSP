<?php

	require_once("../../config.php");
	
	if(isset($_GET['id']))
	{
	
		$query = query("DELETE FROM GENRE WHERE IDGENRE = " . escape_string($_GET['id']) . " ");
		confirm($query);
		
		set_message("Genre deleted successfully.");
		
		redirect("../../../public/admin/index.php?genres");
		
	}
	else
	{
		redirect("../../../public/admin/index.php?genres");
	}

?>
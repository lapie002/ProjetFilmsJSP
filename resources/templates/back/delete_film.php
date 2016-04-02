<?php
	require_once("../../config.php");
	
	if(isset($_GET['id']))
	{
        
       /* a mettre en plae a condition de gerer la function display_orders() */
       $query_louer = query("DELETE FROM LOUER WHERE IDFILM = " . escape_string($_GET['id']) . " ");
       confirm($query_louer);
    
        $query_jouer = query("DELETE FROM JOUER WHERE IDFILM = " . escape_string($_GET['id']) . " ");
		confirm($query_jouer);
		
	
		$query = query("DELETE FROM FILM WHERE IDFILM = " . escape_string($_GET['id']) . " ");
		confirm($query);
        
        /*
        $query_jouer = query("DELETE FROM JOUER J WHERE J.IDFILM = " . escape_string($_GET['id']) . " ");
		confirm($query_jouer);
		*/
        
		set_message("The Film selected was successfully deleted.");
		
		redirect("../../../public/admin/index.php?films");
		
	}
	else
	{
		redirect("../../../public/admin/index.php?films");
	}

?>
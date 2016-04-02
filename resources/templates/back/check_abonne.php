<?php

	require_once("../../config.php");
	
	if(isset($_GET['id']))
	{
	
        $query = query("SELECT ABONNECHECK FROM ABONNE WHERE IDABONNE = " . escape_string($_GET['id']) . " ");
        $send_query = $query;
        confirm($send_query);
        
        $string = "unchecked";
        
        /* J ai utilise strcmp car un == ne fonctionne pas pour comparer query et unchecked */
        if(strcmp($query, $string) == 0)
        {
            $update = query("UPDATE ABONNE SET ABONNECHECK = 'checked' WHERE IDABONNE = " . escape_string($_GET['id']) . " ");
            $send_update_query = $update;
            confirm($send_update_query);
            set_message("The member's permission has been updated!");
		    redirect("../../../public/admin/index.php?abonnes");
        }
        else
        {
		    redirect("../../../public/admin/index.php?abonnes");
        }
		
	}
	else
	{
		redirect("../../../public/admin/index.php?abonnes");
	}

?>
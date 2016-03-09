<!-- Configuration-->
<?php require_once("../../resources/config.php"); ?>


<?php include(TEMPLATE_BACK . DS . "/header.php"); ?>
 
<?php 

if(!isset($_SESSION['nomadmin'])) {


redirect("../../index.php");

}


 ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading ONLY dispalying in admin_content.php -->

                <!-- /.row -->
				
				<?php
				
					/* DIFFERENCE BETWEEN A SUPER GLOBAL $_SERVER THAT SHOWS THE PATH AND __DIR__ which takes the entire path starting from var
					
					echo $_SERVER['REQUEST_URI']; 
	
					echo __DIR__;
					
					*/
				
					if($_SERVER['REQUEST_URI'] == "/ecom/public/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php")
					{
							include(TEMPLATE_BACK . DS . "/admin_content.php");
					}
						
					if(isset($_GET['orders']))
					{
							include(TEMPLATE_BACK . DS . "/orders.php");
					}
					if(isset($_GET['films']))
					{
							include(TEMPLATE_BACK . DS . "/films.php");
					}
					if(isset($_GET['add_product']))
					{
							include(TEMPLATE_BACK . DS . "/add_product.php");
					}
					if(isset($_GET['edit_product']))
					{
							include(TEMPLATE_BACK . DS . "/edit_product.php");
					}
					if(isset($_GET['genres']))
					{
							include(TEMPLATE_BACK . DS . "/genres.php");
					}
					if(isset($_GET['admins']))
					{
							include(TEMPLATE_BACK . DS . "/admins.php");
					}
					if(isset($_GET['add_admin']))
					{
							include(TEMPLATE_BACK . DS . "/add_admin.php");
					}
					if(isset($_GET['edit_user']))
					{
							include(TEMPLATE_BACK . DS . "/edit_user.php");
					}
					if(isset($_GET['reports']))
					{
							include(TEMPLATE_BACK . DS . "/reports.php");
					}

					
				?>
				
				


<?php include(TEMPLATE_BACK . DS . "/footer.php"); ?>

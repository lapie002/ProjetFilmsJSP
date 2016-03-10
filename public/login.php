<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

    <!-- Page Content -->
    <div class="container">

      <header>
	  
            <h1 class="text-center">Connexion</h1>
			<h3 class="text-center bg-warning"><?php display_message(); ?></h3>
			
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="post" enctype="multipart/form-data">
			
				<?php login_user(); ?>
				
                <div class="form-group"><label for="">
                    nom<input type="text" name="nomadmin" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    mot de passe<input type="password" name="motdepasse" class="form-control"></label>
                </div>

                <div class="form-group">
				  <button type="reset" class="btn btn-default">Réinitialiser</button>
				  <!-- <button type="submit" name="submit" class="btn btn-primary">Submit</button> -->
                  <input type="submit" name="submit" class="btn btn-primary"> 
                </div>
            </form>
			
        </div>  

    </header>


        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
		<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

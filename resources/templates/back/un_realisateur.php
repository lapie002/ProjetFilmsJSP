<?php 
    
    if(isset($_GET['id']))
    {
        $result = query("SELECT * FROM REALISATEUR WHERE IDREALISATEUR = ". escape_string($_GET['id']) ." ");
	    confirm($result);
	
        while($row = fetch_array($result))
        {

            $id_realisateur     = escape_string($row['IDREALISATEUR']);
            $films              = show_films_by_realisateur_id($row['IDREALISATEUR']);
            $nom_realisateur    = escape_string($row['NOMREALISATEUR']);
            $prenom_realisateur = escape_string($row['PRENOMREALISATEUR']);
            $realisateur_image  = display_image($row['IMAGEREALISATEUR']);
        }	   
    }
    
?>


<div class="col-md-12">
<div class="row">

        <div class="col-md-2">
        </div>
        <div class="col-md-6">
            <div class="thumbnail">
                <div class="caption-full">
                    <h4 class="text-center"><a href="#"><?php echo $prenom_realisateur ?> <?php echo $nom_realisateur ?></a></h4>
                    <hr>
                    
                    <img class="img-responsive center-block" width="175" height="150" src="../../resources/<?php echo $realisateur_image ?>" alt="">
                    <br>
                    <p class="text-center">Films :  <?php foreach($films as $value){echo $value;} ?></p>
                    <div class="form-group text-center">
                        <a href="http://localhost/projetfilmsjsp/public/admin/index.php?directors" class="btn btn-primary">Go BACK</a>
                    </div>
                   
                </div>
 
            </div>

        </div>


             </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


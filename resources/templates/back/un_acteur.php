<?php 
    
    if(isset($_GET['id']))
    {
        $result = query("SELECT * FROM ACTEUR WHERE IDACTEUR = ". escape_string($_GET['id']) ." ");
	    confirm($result);
	
        while($row = fetch_array($result))
        {

            $id_acteur            = escape_string($row['IDACTEUR']);
            $nom_acteur            = escape_string($row['NOMACTEUR']);
            $prenom_acteur            = escape_string($row['PRENOMACTEUR']);
            $acteur_image         = display_image($row['IMAGEACTEUR']);
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
                    <h4 class="text-center"><a href="#"><?php echo $prenom_acteur ?> <?php echo $nom_acteur ?></a></h4>
                    <hr>
                    
                    <img class="img-responsive center-block" width="175" height="150" src="../../resources/<?php echo $acteur_image ?>" alt="">
                    <br>
                    <div class="form-group text-center">
                        <a href="http://localhost/projetfilmsjsp/public/admin/index.php?actors" class="btn btn-primary">Go BACK</a>
                    </div>
                   
                </div>
 
            </div>

        </div>


             </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


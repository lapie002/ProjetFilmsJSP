<?php 
    
    if(isset($_GET['id']))
    {
        $result = query("SELECT * FROM FILM WHERE IDFILM = ". escape_string($_GET['id']) ." ");
	    confirm($result);
	
        while($row = fetch_array($result))
        {

            $id_film            = escape_string($row['IDFILM']);
            $realisateur        = show_film_realisateur_by_id($row['IDREALISATEUR']);
            $genre              = show_film_genre_title($row['IDGENRE']);
            $titre_film         = escape_string($row['TITREFILM']);
            $film_price         = escape_string($row['PRIXFILMLOCATION']);
            $film_quantity      = escape_string($row['NBEXPDISPFILM']);
            $film_description   = escape_string($row['RESUMELONGFILM']);
            $film_desc          = escape_string($row['RESUMECOURTFILM']);
            $film_image         = display_image($row['IMAGEFILM']);
        }	   
    }
    
?>


<div class="col-md-12">
<div class="row">

        <div class="col-md-4 col-md-offset-2">
            <img class="img-responsive" width="350" height="300" src="../../resources/<?php echo $film_image ?>" alt="">
        </div>
        <div class="col-md-5">
            <div class="thumbnail">
                <div class="caption-full">
                    <h4><a href="#"><?php echo $titre_film ?></a> </h4>
                    <hr>
                    <h4 class="">Pirce : <?php echo $film_price ?></h4>
                    
                    
                    <p>Quantity : <?php echo $film_quantity ?></p>
                    <p>director :  <?php echo $realisateur ?></p>
                    <p>genre :  <?php echo $genre ?></p>
                    <p>Synopsis :  <?php echo $film_desc ?></p>
                   
                </div>
 
            </div>

        </div>


             </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


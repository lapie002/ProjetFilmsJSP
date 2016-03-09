
<div class="col-md-12">
 <div class="row">

<h1 class="page-header">
   All Films
</h1>
<h4 class="text-center bg-success"><?php display_message();   ?></h4>
<table class="table table-hover">


    <thead>

      <tr>
           <th>IdFilm</th>
           <th>Titre du Film</th>
           <th>Genre</th>
           <th>Prix</th>
		   <th>Quantité en stock</th>
      </tr>
    </thead>
    <tbody>

    
	  
	  <?php get_films_in_admin(); ?>
	  
 
      


  </tbody>
</table>

             </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


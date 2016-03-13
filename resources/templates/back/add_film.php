<?php add_film(); ?>


<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   Add Film

</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

    <div class="form-group">
        <label for="product-title">Film Title </label>
            <input type="text" name="titrefilm" class="form-control">
    </div>

    <div class="form-group">
           <label for="product-title">Film Description</label>
      <textarea name="resumelongfilm" id="" cols="30" rows="1" class="form-control"></textarea>
	  
    </div>
	
	<div class="form-group">
           <label for="product-title">Film Short Description</label>
      <textarea name="resumecourtfilm" id="" cols="30" rows="1" class="form-control"></textarea>
	  
    </div>



    <div class="form-group row">

      <div class="col-xs-6">
        <label for="product-price">Film Price</label>
        <div class="form-group input-group">  
        <span class="input-group-addon"><i class="fa fa-eur"></i></span>
        <input type="number" name="prixfilmlocation" class="form-control" size="60">
        </div>
      </div>
	  
	  <div class="col-xs-6">
        <label for="product-quantity">Film Quantity</label>
        <input type="number" name="nbexpdispfilm" class="form-control" size="60">
      </div>
    </div>
    
    <div class="form-group row">
        <div class="col-xs-12">
            <!-- Film Actors a Modifier -->
            <div class="form-group">
                <label for="product-title">Actors</label>
                <select multiple name='idactors[]' id="" class="form-control">
                    <!-- <option value="">Select Actors</option> -->
                    <?php show_actors_add_film_page();  ?>
                </select>
            </div>
         </div>
    </div>
    

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     <!-- Film Genres-->
    <div class="form-group">
        <label for="product-title">Film Genre</label>
        <select name="idgenre" id="idgenre" class="form-control">
            <option value="">Select Genre</option>
			<?php show_genres_add_film_page();  ?>
        </select>
	</div>

    <!-- Film Realisateurs-->
    <div class="form-group">
      <label for="product-title">Film Director</label>
         <select name="idrealisateur" id="idrealisateur" class="form-control">
            <option value="">Select Director</option>
             <?php show_director_add_film_page();  ?>
         </select>
    </div>
    
    
    
    <!-- Product Image -->
	<hr>
    <div class="form-group">
        <label for="product-title">Film Image</label>
        <input type="file" name="file">
    </div>
    
    
    <div class="form-group">
            <!-- <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft"> -->
            <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
    </div>
    
    
</aside><!--SIDEBAR-->

    
</form>


                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->



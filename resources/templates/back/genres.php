<?php add_genre(); ?>
<h1 class="page-header">
  Genre Categories
</h1>


<div class="col-md-4">
    
	<h4 class="bg-success" align="center"><?php display_message(); ?></h4>
	
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Genre</label>
            <input name="nomgenre" type="text" class="form-control">
        </div>

        <div class="form-group">
            
            <input name="add_genre" type="submit" class="btn btn-primary" value="Add Genre">
        </div>      


    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>id</th>
            <th>Genre</th>
        </tr>
            </thead>


    <tbody>
		<?php show_genres_in_admin(); ?>
    </tbody>

        </table>

</div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


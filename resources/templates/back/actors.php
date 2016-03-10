<?php add_actor(); ?>
<h1 class="page-header">
  ALL Directors
</h1>


<div class="col-md-4">
    
	<h4 class="bg-success" align="center"><?php display_message(); ?></h4>
	
    <form action="" method="post">
        <div class="form-group">
            <label for="realisateur-nom">Director's last name</label>
            <input name="NOMREALISATEUR" type="text" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="realisateur-prenom">Director's first name</label>
            <input name="PRENOMREALISATEUR" type="text" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="realisateur-image">Director's Image</label>
            <input type="file" name="file">
        </div>

        <div class="form-group">
            <input name="add_director" type="submit" class="btn btn-primary" value="Add Director">
        </div>      
    </form>


</div>


<div class="col-md-8">

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>last name</th>
                <th>first name</th>
                <th>Director's picture</th>
            </tr>
        </thead>


        <tbody>
            <?php show_actors_in_admin(); ?>
        </tbody>

    </table>

</div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


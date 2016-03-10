<?php add_actor(); ?>
<h1 class="page-header">
  ALL Directors
</h1>


<div class="col-md-4">
    
	<h4 class="bg-success" align="center"><?php display_message(); ?></h4>
	
    <form action="" method="post">
        <div class="form-group">
            <label for="realisateur-nom">Actor last name</label>
            <input name="NOMACTEUR" type="text" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="realisateur-prenom">Actor first name</label>
            <input name="PRENOMACTEUR" type="text" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="realisateur-image">Actor's Image</label>
            <input type="file" name="IMAGEACTEUR">
        </div>

        <div class="form-group">
            <input name="add_actor" type="submit" class="btn btn-primary" value="Add Actor">
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
                <th>Actor's picture</th>
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


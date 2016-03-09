<?php add_admin(); ?>
  <h1 class="page-header">
      Add Administrator
      <small>Page</small>
  </h1>

<div class="col-md-6 admin_image_box">
    
<span id="user_admin" class='fa fa-user fa-4x'></span>

</div>


<form action="" method="post" enctype="multipart/form-data">


  <div class="col-md-6">

     <div class="form-group">
      <label for="imageProfil">Profile Image</label>
      <input type="file" name="file">
         
     </div>


     <div class="form-group">
      <label for="nomadmin">Admin name</label>
      <input type="text" name="nomadmin" class="form-control" >
         
     </div>


      <div class="form-group">
          <label for="email">Email</label>
      <input type="text" name="email" class="form-control"   >
         
     </div>


      <div class="form-group">
          <label for="motdepasse">Password</label>
      <input type="password" name="motdepasse" class="form-control"  >
         
     </div>

      <div class="form-group">

      <!-- <a id="user-id" class="btn btn-danger" href="">Delete</a>  -->

      <input type="submit" name="add_admin" class="btn btn-primary pull-right" value="Add Admin" >
         
     </div>


      

  </div>




</form>
<?php
/****** directory for the images *******/
$upload_directory = "uploads";


/******************************** helper function **************************/

function redirect($location)
{
	header("LOCATION: $location");
}

function query($sql)
{
	global $connection;
	
	return mysqli_query($connection,$sql);
}

function confirm($result)
{
	global $connection;
	
	if(!$result)
	{
		die("QUERY FAILED" . mysqli_error($connection));
	}
}

function escape_string($string)
{
	global $connection;
	
	return mysqli_real_escape_string($connection,$string);
}

function fetch_array($result)
{
	return mysqli_fetch_array($result);
}

function set_message($msg)
{
	if(!empty($msg))
	{
		$_SESSION['message'] = $msg; 
	}
	else
	{
		$msg = "";
	}
}

function display_message()
{
	if(isset($_SESSION['message']))
	{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function last_id()
{
	global $connection;

	return mysqli_insert_id($connection);
} 

/*******************************************************************************/

 // function login
 
 function login_user()
 {
	if(isset($_POST['submit']))
	{
		$nomadmin = escape_string($_POST['nomadmin']);
		$motdepasse = escape_string($_POST['motdepasse']);
		
		$query = query("SELECT * FROM administrateur where nomAdmin = '{$nomadmin}' AND  motdepasse='{$motdepasse}' ");
		confirm($query);
		
		if(mysqli_num_rows($query) == 0)
		{
			set_message("Il y a eu un problème avec votre connexion. Entrez votre login et votre mot de passe à nouveau !");
			redirect("login.php");
		}
		else
		{
			$_SESSION['nomadmin'] = $nomadmin;
			redirect("admin");
		}
		
	}
 }

 /******************************** BACK END FUNCTION **************************/
 
//function to display nomgenre in film in the admin panel 
 function show_film_genre_title($genre_id)
 {
	$query = query("SELECT * FROM GENRE WHERE IDGENRE = '{$genre_id}' ");
	confirm($query);
	
	while($genre_row  = fetch_array($query))
	{
		return $genre_row['NOMGENRE'];
	}	
 }
 
 /******************************* Admin films.php *****************/
 //function for the image directory 
 function display_image($picture)
 {
	global $upload_directory;
	return $upload_directory . DS . $picture;
 }
 

 function get_films_in_admin()
 {
	$result = query("SELECT * FROM FILM");
	confirm($result);
	
	while($row = fetch_array($result))
	{
		$genre = show_film_genre_title($row['IDGENRE']);
		$film_image = display_image($row['IMAGEFILM']);
		
		$film_in_admin_page = <<<DELIMETER
		  <tr>
		    <td>{$row['IDFILM']}</td>
            <td>{$row['TITREFILM']} <br>
              <a href="index.php?edit_film&id={$row['IDFILM']}"><img height="62" width="62" src="../../resources/{$film_image}" alt=""></a>
            </td>
            <td> {$genre} </td>
            <td>{$row['PRIXFILMLOCATION']}</td>
			<td>{$row['NBEXPDISPFILM']}</td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_film.php?id={$row['IDFILM']}"><span class="glyphicon glyphicon-remove"></span></a></td>
		 </tr>
DELIMETER;
		echo $film_in_admin_page;
		
	}	
 }
 
  /*******************************Add Films in Admin *****************/
 
 function add_film()
 {
 
	if(isset($_POST['publish']))
	{
	
		$film_realisateur     = escape_string($_POST['IDREALISATEUR']);
		$film_genre_id        = escape_string($_POST['IDGENRE']);
        $film_title           = escape_string($_POST['TITREFILM']);
		$film_price           = escape_string($_POST['PRIXFILMLOCATION']);
		$film_quantity        = escape_string($_POST['NBEXPDISPFILM']);
		$film_description_lg  = escape_string($_POST['RESUMELONGFILM']);
		$film_description_lg  = escape_string($_POST['RESUMECOURTFILM']);
		
		
		$film_image        = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
		
		move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $film_image);
		
		$query = query("INSERT INTO FILM (IDREALISATEUR, IDGENRE, TITREFILM, PRIXFILMLOCATION, NBEXPDISPFILM, RESUMELONGFILM, RESUMECOURTFILM, IMAGEFILM) VALUES('{$film_realisateur}', '{$film_genre_id}','{$film_title}','{$film_price}','{$film_quantity}','{$film_description_lg}','{$film_description_lg},'{$film_image}')");
        
        
        
		$last_id = last_id();
		confirm($query);
		set_message("New Film with id: {$last_id} was successfully added!");
		redirect("index.php?films");
	}
 
 
 }


 
function show_genres_add_film_page()
 {
	$query = query("SELECT * FROM GENRE");
	confirm($query);
	
	while($row = fetch_array($query))
	{
		$genres_options = <<<DELIMETER
		
		<option value="{$row['IDGENRE']}">{$row['NOMGENRE']}</option>
		
DELIMETER;
echo $genres_options;
		
	}
 
 }
 
 
 
/*******************************Edit Film in Admin *****************/
 

 
 /********************** Genres in Admin **************************/
 
 function show_genres_in_admin()
 {
	$query = "SELECT * FROM GENRE";
	$genre_query = query($query);
	confirm($genre_query);
	
	while($row = fetch_array($genre_query))
	{
		$genre_id = $row['IDGENRE'];
		$nom_genre = $row['NOMGENRE'];
		
		$genre = <<<DELIMETER
		
		<tr>
            <td>{$genre_id}</td>
            <td>{$nom_genre}</td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_genre.php?id={$row['IDGENRE']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;
		
	echo $genre;
	}
 }
 
 function add_genre()
 {
	if(isset($_POST['add_genre']))
	{
		$nom_genre = escape_string($_POST['nomgenre']);
		
		if(empty($nom_genre) || $nom_genre == " ")
		{
			echo "<p class='bg-danger' align='center'>Le champ Genre ne peut pas être vide.</p>";
		}
		else
		{
			$insert_genre = query("INSERT INTO genre(NOMGENRE) Values('{$nom_genre}')");
			confirm($insert_genre);

			set_message("Genre created.");
		}
	}
 }
 
 
 
 /***************** Admin in Admin section **********************/
 
  function display_admins()
 {
	$query = "SELECT * FROM ADMINISTRATEUR";
	$admins_query = query($query);
	confirm($admins_query);
	
	while($row = fetch_array($admins_query))
	{
		$admin_id = $row['IDADMIN'];
		$adminName = $row['NOMADMIN'];
		$email = $row['EMAIL'];
		$motdepasse = $row['MOTDEPASSE'];
		$profile_image = display_image($row['IMAGEPROFIL']);
		
		$admins = <<<DELIMETER
		
		<tr>
            <td>{$admin_id}</td>
            <td>{$adminName}</td>
			<td><img height="62" width="62" src="../../resources/{$profile_image}" alt=""></td>
			<td>{$email}</td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_admin.php?id={$row['IDADMIN']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;
		
	echo $admins;
	}
 }
 
 
 function add_admin()
 {
	if(isset($_POST['add_admin']))
	{
		$nomadmin = escape_string($_POST['nomadmin']);
		$email = escape_string($_POST['email']);
		$motdepasse = escape_string($_POST['motdepasse']);
		
		$profile_image        = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
		
		move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $profile_image);
		
		$query = query("INSERT INTO administrateur(nomadmin,email,motdepasse,imageprofil) VALUES('{$nomadmin}','{$email}','{$motdepasse}','{$profile_image}')");
		confirm($query);
		
		set_message("Profile created.");
		
		redirect("index.php?admins");
	}
 }
 
 /************************ show reports in Admin **********************************/
 
 function get_reports()
 {
	$result = query("SELECT * FROM reports");
	confirm($result);
	
	while($row = fetch_array($result))
	{
		
		
		$report = <<<DELIMETER
		<tr>
			<td>{$row['report_id']}</td>
			<td>{$row['product_id']}</td>
			<td>{$row['order_id']}</td>
			<td>{$row['product_price']}</td>
			<td>{$row['product_title']}</td>
			<td>{$row['product_quantity']}</td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_report.php?id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
		
DELIMETER;
		echo $report;
	}
 }


/*******************************Add Directors in Admin *****************/
 
 function add_director()
 {
 
	if(isset($_POST['add_director']))
	{
		$nom_realisateur     = escape_string($_POST['NOMREALISATEUR']);
		$prenom_realisateur  = escape_string($_POST['PRENOMREALISATEUR']);
   
		$director_image       = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
		
        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $director_image);
		
        $query = query("INSERT INTO REALISATEUR (NOMREALISATEUR, PRENOMREALISATEUR, IMAGEREALISATEUR) VALUES('{$nom_realisateur}', '{$prenom_realisateur}','{$director_image}')");
        
		$last_id = last_id();
		confirm($query);
		set_message("New Director with id: {$last_id} was successfully added!");
		redirect("index.php?directors");
	}
 }


 /********************** Directors in Admin **************************/
 
 function show_directors_in_admin()
 {
	$query = "SELECT * FROM REALISATEUR";
	$director_query = query($query);
	confirm($director_query);
	
	while($row = fetch_array($director_query))
	{
		$id_realisateur      = $row['IDREALISATEUR'];
		$nom_realisateur     = $row['NOMREALISATEUR'];
        $prenom_realisateur  = $row['PRENOMREALISATEUR'];
        $image_realisateur   = display_image($row['IMAGEREALISATEUR']);
		
		$director_in_admin_page = <<<DELIMETER
		
		<tr>
            <td>{$id_realisateur}</td>
            <td>{$nom_realisateur}</td>
            <td>{$prenom_realisateur}</td>
            <td><img height="62" width="62" src="../../resources/{$image_realisateur}" alt=""></td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_director.php?id={$row['IDREALISATEUR']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;
		
	echo $director_in_admin_page;
	}
 }





















































/*******************************Add Directors in Admin *****************/
 
 function add_actor()
 {
 
	if(isset($_POST['add_actor']))
	{
		$nom_actor     = escape_string($_POST['NOMACTEUR']);
		$prenom_actor  = escape_string($_POST['PRENOMACTEUR']);
   
		$actor_image          = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
		
        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $actor_image);
		
        $query = query("INSERT INTO ACTEUR (NOMACTEUR, PRENOMACTEUR, IMAGEACTEUR) VALUES('{$nom_actor}', '{$prenom_actor}','{$actor_image}')");
        
		$last_id = last_id();
		confirm($query);
		set_message("New Actor with id: {$last_id} was successfully added!");
		redirect("index.php?actors");
	}
 }


 /********************** Directors in Admin **************************/
 
 function show_directors_in_admin()
 {
	$query = "SELECT * FROM ACTEUR";
	$actor_query = query($query);
	confirm($actor_query);
	
	while($row = fetch_array($actor_query))
	{
		$id_actor      = $row['IDACTEUR'];
		$nom_actor     = $row['NOMACTEUR'];
        $prenom_actor  = $row['PRENOMACTEUR'];
        $image_actor   = display_image($row['IMAGEACTEUR']);
		
		$actor_in_admin_page = <<<DELIMETER
		
		<tr>
            <td>{$id_actor}</td>
            <td>{$nom_actor}</td>
            <td>{$prenom_prenom_actor}</td>
            <td><img height="62" width="62" src="../../resources/{$image_actor}" alt=""></td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_actor.php?id={$row['IMAGEACTEUR']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;
		
	echo $actor_in_admin_page;
	}
 }































 
 
 
?>
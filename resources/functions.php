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
    
     error_log("connection : ");
    error_log(print_r($connection, TRUE));
     error_log("sql ");
    error_log(print_r($sql, TRUE));
	
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
              <a href="index.php?un_film&id={$row['IDFILM']}"><img height="62" width="62" src="../../resources/{$film_image}" alt=""></a>
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

		$film_realisateur     = escape_string($_POST['idrealisateur']);
		$film_genre_id        = escape_string($_POST['idgenre']);
        $film_title           = escape_string($_POST['titrefilm']);
		$film_price           = escape_string($_POST['prixfilmlocation']);
		$film_quantity        = escape_string($_POST['nbexpdispfilm']);
		$film_description_lg  = escape_string($_POST['resumelongfilm']);
		$film_description_sm  = escape_string($_POST['resumecourtfilm']);
        
        $film_actors_id       = $_POST['idactors'];
        
        /*var_dump($film_realisateur);*/
	
		$film_image           = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
		
		move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $film_image);
		
		$query = query("INSERT INTO FILM (IDREALISATEUR, IDGENRE, TITREFILM, PRIXFILMLOCATION, NBEXPDISPFILM, RESUMELONGFILM, RESUMECOURTFILM, IMAGEFILM) VALUES('{$film_realisateur}','{$film_genre_id}','{$film_title}','{$film_price}','{$film_quantity}','{$film_description_lg}','{$film_description_sm}','{$film_image}')");
        
        
		$last_id = last_id();
		confirm($query);
        
        foreach($film_actors_id as $valeur)
        {
            $query_actors = query("INSERT INTO JOUER (IDFILM, IDACTEUR) VALUES('{$last_id}','{$valeur}')");
            confirm($query_actors);   
        }
        
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


 
function show_director_add_film_page()
 {
	$query = query("SELECT * FROM REALISATEUR");
	confirm($query);
	
	while($row = fetch_array($query))
	{
		$directors_options = <<<DELIMETER
		
		<option value="{$row['IDREALISATEUR']}">{$row['PRENOMREALISATEUR']}  {$row['NOMREALISATEUR']}</option>
		
DELIMETER;
echo $directors_options;
		
	}
 
 }


function show_actors_add_film_page()
 {
	$query = query("SELECT * FROM ACTEUR");
	confirm($query);
	
	while($row = fetch_array($query))
	{
		$actors_options = <<<DELIMETER
        
		<option value="{$row['IDACTEUR']}">{$row['PRENOMACTEUR']}  {$row['NOMACTEUR']}</option>
		
DELIMETER;
echo $actors_options;
		
	}
 
 }


/*function insert_actorsByFilm($idFilm,$idActor)
 {
		$query = query("INSERT INTO JOUER (IDFILM, IDACTEUR) VALUES('{$idFilm}','{$idActor}')");
        confirm($query);
 }*/

 
 
 
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
   
			
		$director_image        = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
       // echo $director_image;
       // echo "blqbqlq";
       // echo $image_temp_location;
        
        
		
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
            <td><a  href="index.php?un_realisateur&id={$id_realisateur}"><img height="62" width="62" src="../../resources/{$image_realisateur}" alt=""></a></td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_director.php?id={$row['IDREALISATEUR']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;
		
	echo $director_in_admin_page;
	}
 }


/*******************************Add Actors in Admin *****************/
 
 function add_actor()
 {
 
	if(isset($_POST['add_actor']))
	{
		$nom_actor     = escape_string($_POST['nomacteur']);
		$prenom_actor  = escape_string($_POST['prenomacteur']);
   
		$actor_image          = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
        
        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $actor_image);
		
        $query = query("INSERT INTO ACTEUR (nomacteur, prenomacteur, imageacteur) VALUES('{$nom_actor}', '{$prenom_actor}','{$actor_image}')");
        confirm($query);
        
		$last_id = last_id();
		set_message("New Actor with id: {$last_id} was successfully added!");
		redirect("index.php?actors");
	}
 }


 /********************** Actors in Admin **************************/
 
 function show_actors_in_admin()
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
            <td>{$prenom_actor}</td>
            <td><a href="index.php?un_acteur&id={$id_actor}"><img height="62" width="62" src="../../resources/{$image_actor}" alt=""></a></td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_actor.php?id={$row['IDACTEUR']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;
		
	echo $actor_in_admin_page;
	}
 }



/***************************************** display Members *************************************************************/


function display_members()
{
    $query = "SELECT * FROM ABONNE";
	$abonne_query = query($query);
	confirm($abonne_query);
    
    while($row = fetch_array($abonne_query))
	{
		$abonne_id = $row['IDABONNE'];
		$abonneName = $row['NOMABONNE'];
        $abonneFirstname = $row['PRENOMABONNE'];
		$abonneEmail = $row['ABONNEEMAIL'];
		$abonneCheck = $row['ABONNECHECK'];
		
        
        if($abonneCheck == 'checked')
        {
            $disabled_ajout_membre = 'disabled';
            $abled_stop_membre = 'enable';
        }
        else
        {
            $disabled_ajout_membre = 'enable';
            $abled_stop_membre = 'disabled';
        }
        
		
		$abonnes = <<<DELIMETER
		
		<tr>
            <td>{$abonne_id}</td>
            <td>{$abonneName}</td>
			<td>{$abonneFirstname}</td>
			<td>{$abonneEmail}</td>
            <td><input type="checkbox" name="my-checkbox" value="check" {$abonneCheck}></a></td>
            
            <td><a class="btn btn-info {$disabled_ajout_membre}" href="../../resources/templates/back/check_abonne.php?id={$row['IDABONNE']}"><span class="glyphicon glyphicon-ok"></span></a></td>
            
            <td><a class="btn btn-warning {$abled_stop_membre}" href="../../resources/templates/back/stop_abonne.php?id={$row['IDABONNE']}"><span class="glyphicon glyphicon-ban-circle"></span></a></td>
            
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_abonne.php?id={$row['IDABONNE']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;
		
	echo $abonnes;
	}
    
}



/***************************************** display Orders by Abonne ***********************************************/


function display_orders()
{
    $cart = array();
    
    $query = "SELECT * FROM ABONNE";
	$abonne_query = query($query);
	confirm($abonne_query);
    
    while($row = fetch_array($abonne_query))
	{
		$abonne_id = $row['IDABONNE'];
		$abonneName = $row['NOMABONNE'];
        $abonneFirstname = $row['PRENOMABONNE'];
        
        $query_film = "SELECT * FROM FILM F, LOUER L WHERE F.IDFILM = L.IDFILM AND L.IDABONNE =" . $abonne_id ;
	    $film_by_abonne_query = query($query_film);
	    confirm($film_by_abonne_query);
        
        while($row = fetch_array($film_by_abonne_query))
        {
            array_push($cart, $row['TITREFILM']);
        }
        
        $myFilms = array(" "," "," ");
        
        foreach($cart as $key => $value)
        {
            $myFilms[$key] = $value;
        } 
        
        
		$film_by_abonnes = <<<DELIMETER
		
		<tr>
            <td>{$abonne_id}</td>
            <td>{$abonneName}</td>
			<td>{$abonneFirstname}</td>
            
            <td>{$myFilms[0]}</td>
            <td>{$myFilms[1]}</td>
            <td>{$myFilms[2]}</td>
            
			<!-- <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['IDABONNE']}"><span class="glyphicon glyphicon-remove"></span></a></td> -->
        </tr>
DELIMETER;
        
        /* on vide le tableau et on le redeclare pour pouvoir l utiliser*/
        unset($cart);
        unset($myFilms);
        
        $cart = array();
		$myFilms = array(" "," "," ");
        
	echo $film_by_abonnes; 
	}
    
}

/************************** Finalement inutile *****************************/


function get_film_by_abonne($id)
{
    $query = "SELECT * FROM FILM F, LOUER L WHERE F.IDFILM = L.IDFILM AND L.IDABONNE = '{$id}' ";
	$film_by_abonne_query = query($query);
	confirm($film_by_abonne_query);
    
    while($row = fetch_array($film_by_abonne_query))
	{
		$titre_film = $row['TITREFILM'];
		
        $film_by_id = <<<DELIMETER
        
        <td>{$titre_film}</td>
        
DELIMETER;
        
        echo $film_by_id;
    }
}

/******************************** pour un_film.php ************************/

 function show_film_realisateur_by_id($realisateur_id)
 {
	$query = query("SELECT * FROM REALISATEUR WHERE IDREALISATEUR = '{$realisateur_id}' ");
	confirm($query);
	
	while($real_row  = fetch_array($query))
	{
		return $real_row['PRENOMREALISATEUR'] . " " . $real_row['NOMREALISATEUR'];
	}	
 }
 

function show_actors_by_film_id($id_film)
{
        $query_actors = query("SELECT * FROM ACTEUR A, JOUER J WHERE A.IDACTEUR = J.IDACTEUR AND J.IDFILM = '{$id_film}' ");
	    confirm($query_actors);
    
        $actors = array();
        
        while($row = fetch_array($query_actors))
        {
            $actor_name = $row['PRENOMACTEUR'] . " " . $row['NOMACTEUR'] . ", ";
            
            array_push($actors, $actor_name);
        }
    
    
        /* foreach($actors as $value){return $value;} */
        
        return $actors; 
    
        /* unset($actors);
        $actors = array(); */
}



 function get_film_by_id($id_film)
 {
	$result = query("SELECT * FROM FILM WHERE IDFILM = '{$id_film}' ");
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
        $film_image = display_image($row['IMAGEFILM']);
        
        
		$film_page = <<<DELIMETER
		  
        <div class="col-md-6">
            <img class="img-responsive" width="350" height="300" src="../resources/{$film_image}" alt="">
        </div>
        <div class="col-md-5">
            <div class="thumbnail">
                <div class="caption-full">
                    <h4><a href="#">{$titre_film}</a> </h4>
                    <hr>
                    <h4 class="">Pirce : {$film_price}</h4>
                    
                    <p>{$film_desc}</p></br>
                    <p>Quantity : {$film_quantity}</p></br>
                    <p>director : {$film_quantity}</p></br>
                    <p>genre : {$genre}</p></br>
    </div>
 
</div>

</div>
               
DELIMETER;
		echo $film_page;
	}	
 }

/***************************Les films pour les quels un acteurs  a jouer ***************************/

function show_films_by_actor_id($id_actor)
{
        $query_films = query("SELECT * FROM FILM F, JOUER J WHERE F.IDFILM = J.IDFILM AND J.IDACTEUR = '{$id_actor}' ");
	    confirm($query_films);
    
        $films = array();
        
        while($row = fetch_array($query_films))
        {
            $film_title = $row['TITREFILM'] . ", ";
            
            array_push($films, $film_title);
        }
    
    
        /* foreach($actors as $value){return $value;} */
        
        return $films; 
    
        /* unset($actors);
        $actors = array(); */
}


/***************************Les films qu un realisateur a tourner  ***************************/

function show_films_by_realisateur_id($id_realisateur)
{
        $query_films = query("SELECT * FROM FILM F, REALISATEUR R WHERE F.IDREALISATEUR = R.IDREALISATEUR AND R.IDREALISATEUR = '{$id_realisateur}' ");
	    confirm($query_films);
    
        $films = array();
        
        while($row = fetch_array($query_films))
        {
            $film_title = $row['TITREFILM'] . ", ";
            
            array_push($films, $film_title);
        }
    
        return $films; 
    

}





 
 
 
?>
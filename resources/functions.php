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
			set_message("Il y a eu un probleme avec votre connexion. Entrez votre login et votre mot de passe à nouveau !");
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
 
 //function to display orders in the admin panel 
 function display_orders()
 {
	 $query = query("SELECT * FROM orders");
	 confirm($query);
	 
	 while($row = fetch_array($query))
	 {
		$orders = <<<DELIMETER
		
		<tr>
            <td>{$row['order_id']}</td>
            <td>{$row['order_amount']}</td>
            <td>{$row['order_transaction']}</td>
            <td>{$row['order_status']}</td>
			<td>{$row['order_currency']}</td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
		
DELIMETER;

		echo $orders;
	 }
 
 }
 
 function show_product_category_title($product_category_id)
 {
	$query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
	confirm($query);
	
	while($category_row  = fetch_array($query))
	{
		return $category_row['cat_title'];
	}	
 }
 
 /******************************* Admin products.php *****************/
 //function for the image directory 
 function display_image($picture)
 {
	global $upload_directory;
	return $upload_directory . DS . $picture;
 }
 

 function get_products_in_admin()
 {
	$result = query("SELECT * FROM products");
	confirm($result);
	
	while($row = fetch_array($result))
	{
		$category = show_product_category_title($row['product_category_id']);
		$product_image = display_image($row['product_image']);
		
		$product_in_admin_page = <<<DELIMETER
		  <tr>
		    <td>{$row['product_id']}</td>
            <td>{$row['product_title']} <br>
              <a href="index.php?edit_product&id={$row['product_id']}"><img height="62" width="62" src="../../resources/{$product_image}" alt=""></a>
            </td>
            <td> {$category} </td>
            <td>{$row['product_price']}</td>
			<td>{$row['product_quantity']}</td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
		 </tr>
DELIMETER;
		echo $product_in_admin_page;
		
	}	
 }
 
  /*******************************Add products in Admin *****************/
 
 function add_product()
 {
 
	if(isset($_POST['publish']))
	{
	
		$product_title        = escape_string($_POST['product_title']);
		$product_category_id  = escape_string($_POST['product_category_id']);
		$product_price        = escape_string($_POST['product_price']);
		$product_quantity     = escape_string($_POST['product_quantity']);
		$product_description  = escape_string($_POST['product_description']);
		$short_desc           = escape_string($_POST['short_desc']);
		
		
		$product_image        = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
		
		move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
		
		$query = query("INSERT INTO products (product_title, product_category_id, product_price, product_quantity, product_description, short_desc , product_image) VALUES('{$product_title}', '{$product_category_id}','{$product_price}','{$product_quantity}','{$product_description}','{$short_desc}','{$product_image}')");
		$last_id = last_id();
		confirm($query);
		set_message("New Product with id: {$last_id} was successfully added!");
		redirect("index.php?products");
	}
 
 
 }


 
function show_categories_add_product_page()
 {
	$query = query("SELECT * FROM categories");
	confirm($query);
	
	while($row = fetch_array($query))
	{
		$categories_options = <<<DELIMETER
		
		<option value="{$row['cat_id']}">{$row['cat_title']}</option>
		
DELIMETER;
echo $categories_options;
		
	}
 
 }
 
 
 
/*******************************Edit product in Admin *****************/
 
function update_product()
 {
	
	if(isset($_POST['update']))
	{
		
		
		$product_title        = escape_string($_POST['product_title']);
		$product_category_id  = escape_string($_POST['product_category_id']);
		$product_price        = escape_string($_POST['product_price']);
		$product_quantity     = escape_string($_POST['product_quantity']);
		$product_description  = escape_string($_POST['product_description']);
		$short_desc           = escape_string($_POST['short_desc']);
		
		$product_image        = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
		
	if(empty($product_image))
	{
		$get_pic = query("SELECT product_image FROM products WHERE product_id= " . escape_string($_GET['id']) . " ");
		confirm($get_pic);
		
		while($row = fetch_array($get_pic))
		{
			$product_image = $row['product_image'];
		}
	}
		
		
		move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $product_image);
		
		$query = "UPDATE products SET ";
		$query .= "product_title            = '{$product_title}'        , ";
		$query .= "product_category_id      = '{$product_category_id}'  , ";
		$query .= "product_price            = '{$product_price}'        , ";
		$query .= "product_description      = '{$product_description}'  , ";
		$query .= "short_desc               = '{$short_desc}'           , ";
		$query .= "product_quantity         = '{$product_quantity}'     , ";
		$query .= "product_image            = '{$product_image}'          ";
		$query .= "WHERE product_id=" . escape_string($_GET['id']);
		
		$send_update_query = query($query);
		confirm($send_update_query);
		set_message("The product has been updated!");
		redirect("index.php?products");
	}
 
 
 }
 
 
 /********************** Categories in Admin **************************/
 
 function show_categories_in_admin()
 {
	$query = "SELECT * FROM categories";
	$category_query = query($query);
	confirm($category_query);
	
	while($row = fetch_array($category_query))
	{
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];
		
		$category = <<<DELIMETER
		
		<tr>
            <td>{$cat_id}</td>
            <td>{$cat_title}</td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;
		
	echo $category;
	}
 }
 
 function add_category()
 {
	if(isset($_POST['add_category']))
	{
		$cat_title = escape_string($_POST['cat_title']);
		
		if(empty($cat_title) || $cat_title == " ")
		{
			echo "<p class='bg-danger' align='center'>this field cannot be empty.</p>";
		}
		else
		{
			$insert_cat = query("INSERT INTO categories(cat_title) Values('{$cat_title}')");
			confirm($insert_cat);

			set_message("Category created.");
		}
	}
 }
 
 
 
 /***************** Users in Admin section **********************/
 
  function display_users()
 {
	$query = "SELECT * FROM administrateurs";
	$users_query = query($query);
	confirm($users_query);
	
	while($row = fetch_array($users_query))
	{
		$user_id = $row['idAdmin'];
		$username = $row['nomAdmin'];
		$email = $row['email'];
		$password = $row['motdepasse'];
		$profile_image = display_image($row['imageProfil']);
		
		$users = <<<DELIMETER
		
		<tr>
            <td>{$user_id}</td>
            <td>{$username}</td>
			<td><img height="62" width="62" src="../../resources/{$profile_image}" alt=""></td>
			<td>{$email}</td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_user.php?id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;
		
	echo $users;
	}
 }
 
 
 function add_user()
 {
	if(isset($_POST['add_user']))
	{
		$username = escape_string($_POST['username']);
		$email = escape_string($_POST['email']);
		$password = escape_string($_POST['password']);
		
		$profile_image        = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
		
		move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $profile_image);
		
		$query = query("INSERT INTO users(username,email,password,profile_image) VALUES('{$username}','{$email}','{$password}','{$profile_image}')");
		confirm($query);
		
		set_message("Profile created.");
		
		redirect("index.php?users");
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

 
 
 
?>
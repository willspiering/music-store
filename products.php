<?php
session_start();

$page_title="Products That Will Make Your Parents Pray For Your Soul!";
include 'layout_head.php';

// this prevents the undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : "1";
$album = isset($_GET['album']) ? $_GET['album'] : "";
$band = isset($_GET['band']) ? $_GET['band'] : "";
$format = isset($_GET['format']) ? $_GET['format'] : "";
$price = isset($_GET['price']) ? $_GET['price'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "1";

// This is the notification to tell you that item was added to cart
if($action=='added'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$album}</strong> was added to your cart!";
    echo "</div>";
}

// notification that tells you that the item is already in the cart
if($action=='exists'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$album}</strong> already exists in your cart!";
    echo "</div>";
}

$query = "SELECT id, album, band, format, price FROM products ORDER BY album";
$stmt = $con->prepare( $query );
$stmt->execute();

$num = $stmt->rowCount();

if($num>0){
    //starts the table
    echo "<table class='table table-hover table-responsive table-bordered'>";
    
        // the table heading
        echo "<tr>";
            echo "<th class='textAlighnLeft'>Album</th>";
            echo "<th>Band</th>";
            echo "<th>Format</th>";
            echo "<th>Price</th>";
            echo "<th style='width:5em;'>Quantity</th>";
            echo "<th>Action</th>";
        echo "</tr>";
    
        if(!isset($_SESSION['cart'])){
			$_SESSION['cart']=array();
		}
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        
        // creates the table row for each record
        echo "<tr>";
            echo "<td>";
                echo "<div class='product-id' style='display:none;'>{$id}</div>";
                echo "<div class='product-name'>{$album}</div>";
            echo "</td>";
            echo "<td>{$band}</td>";
            echo "<td>{$format}</td>";
            echo "<td>&#36;{$price}</td>";
            if(array_key_exists($id, $_SESSION['cart'])){
					$quantity=$_SESSION['cart'][$id]['quantity'];
					
					echo "<td>";
							 echo "<input type='text' name='quantity' value='{$quantity}' disabled class='form-control' />";
					echo "</td>";
            echo "<td>";
						echo "<button class='btn btn-success' disabled>";
							echo "<span class='glyphicon glyphicon-shopping-cart'></span> Added!";
						echo "</button>";
					echo "</td>";				
				}else{
					echo "<td>";
							 echo "<input type='text' name='quantity' value='1' class='form-control' />";
					echo "</td>";
					echo "<td>";
						echo "<button class='btn btn-primary add-to-cart'>";
							echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
						echo "</button>";
					echo "</td>";
				}
            echo "</tr>";
        }
		
    echo "</table>";
}

// tell the user if there are no products in the database
else{
    echo "No products found.";
}

include 'layout_foot.php';
?>
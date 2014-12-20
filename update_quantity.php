<?php
session_start();

// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$album = isset($_GET['album']) ? $_GET['album'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";

//remove item from the array
unset($_SESSION['cart'][$id]);

//add item with updated quantity
$_SESSION['cart'][$id]=array(
    'album'=>$album,
    'quantity'=>$quantity
);

// redirect to product list and let the user know that it was added to cart
header('Location: cart.php?action=quantity_updated&id=' . $id . '&album=' . $album);
?>
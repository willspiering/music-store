<?php
session_start();

//get the id of the product
$id = isset($_GET['id']) ? $_GET['id'] : "";
$album = isset($_GET['album']) ? $_GET['album'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";

// Check if cart session array was created
// if not, create the cart session array

if(!isset($_SESSION['cart_items'])){
    $_SESSION['cart_items'] = array();   
}

// check to see if item is in the array
if(array_key_exists($id, $_SESSION['cart_items'])){
    // redirect to the product list and let the user know it has been added to the cart
    header('Location: products.php?action=exists&id' . $id .'&album=' . $album);
}

// else, add the item to the array
else{
    $_SESSION['cart_items'][$id]=$album;

    // redirect to the product list and tell it has been added to the cart
    header('Location: products.php?action=added&id' . $id . '&album=' . $album);
}
?>
<?php
session_start();

// get the product idate
$id = isset($_GET['id']) ? $_GET['id'] : "";
$album = isset($_GET['album']) ? $_GET['album'] : "";

//remove the item from the array
unset($_SESSION['cart'][$id]);

// redirect the user to the product list and let them know it was removed
header('Location: cart.php?action=removed&id=' . $id . '&album=' . $album);
?>
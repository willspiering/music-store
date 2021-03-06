<?php
session_start();

$page_title="Your Evil Satchel of Tunes";
include 'layout_head.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";
$album = isset($_GET['album']) ? $_GET['album'] : "";

if($action=='removed'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$album}</strong> was removed from your cart!";
    echo "</div>";
}

else if($action=='quantity_updated'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$album}</strong> quantity was updated!";
    echo "</div>";
}

if(count($_SESSION['cart_items'])>0){
    
    // get the product ids
    $ids = "";
    foreach($_SESSION['cart_items'] as $id=>$value){
        $ids = $ids . $id . ",";
    }
    // remove the last comma
    $ids = rtrim($ids, ',');
    
    // Start the table
    echo "<table class='table table-hover table-responsive table-bordered'>";
    
        // table heading
        echo "<tr>";
            echo "<th class='textAlignLeft'>Album</th>";
            echo "<th>Band</th>";
            echo "<th>Format</th>";
            echo "<th>Price</th>";
            echo "<th>Action</th>";
        echo "</tr>";
    
    $query = "SELECT id, album, band, format, price FROM products WHERE id IN ({$ids}) ORDER BY band";
    
    $stmt = $con->prepare( $query );
    $stmt->execute();
    
    $total_price=0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        
        echo "<tr>";
            echo "<td>{$album}</td>";
            echo "<td>{$band}</td>";
            echo "<td>{$format}</td>";
            echo "<td>&#36;{$price}</td>";
            echo "<td>";
                echo "<a href='remove_from_cart.php?id={$id}&album={$album}' class='btn btn-danger'>";
                    echo "<span class='glyphicon glyphicon-remove'></span> Remove from cart";
                echo "</a>";
            echo "</td>";
        echo "</tr>";
        
        $total_price+=$price;
    }
    
    echo "<tr>";
        echo "<td><b>Total</b></td>";
        echo "<td>&#36;{$total_price}</td>";
        echo "<td>";
            echo "<a href='#' class='btn btn-success'>";
                echo "<span class='glyphicon glyphicon-shopping-cart'></span> Checkout";
            echo "</a>";
        echo "</td>";
    echo "</tr>";
    
    echo "</table>";  
}
else{
    echo "<div class='alert alert-danger'>";
        echo "<strong>Fill Up Your Cart!</strong> It's Empty!";
    echo "</div>";
}

include 'layout_foot.php';
?>
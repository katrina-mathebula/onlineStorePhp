<?php

$conn = new mysqli('localhost','katrina','1234','store');

if($conn -> connect_error)
{
    echo "something went wrong" .mysql_connect_error();
}
    
if(isset($_POST['product_name']) && isset($_POST['price']) && isset($_POST['image']))
{
    $pr_n = $_POST['product_name'];
    $p_c = $_POST['price'];
    $img = $_POST['image'];
    
    $cartObject = new AddToCart();
    $cartObject -> addCart($conn, $pr_n, $p_c, $img);
}

class AddToCart
{
    
    function addCart($conn, $product, $price, $image)
    {
        $query = " INSERT INTO cart (name, price, image) VALUES('".$product."', '".$price."', '".$image."')";
        $result = $conn -> query($query);
        if($result)
        {
            echo json_encode([true, "Item has been successfuly added to cart"]);
        }else
        {
            echo json_encode([false, "Sorry! Technical error please try again later"]);
        }
    }
}
?>
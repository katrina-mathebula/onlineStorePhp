<?php
session_start();
include 'inc/database.php';


$query = "SELECT * FROM PRODUCTS";
$query_cart = "SELECT name, price, image FROM cart";

$result = mysqli_query($conn,$query);

$products = mysqli_fetch_all($result,MYSQLI_ASSOC);
//var_dump($products);

//foreach($products as $product){
//    echo "this is the name of the item : " .$product['name']."<br>";
//}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- bootstrap css -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- main css -->
  <link rel="stylesheet" href="css/style.css">

  <!-- font awesome -->
  <link rel="stylesheet" href="css/all.css">
  <title>Kays online store</title>
 
</head>

<body>
    

    
    <header id="header">
    <nav class="navbar navbar-expand-lg px-4">
        <!-- 
    https://www.iconfinder.com/icons/5296677/bamboo_branch_forest_leaf_nature_plant_tree_icon
    Creative Commons (Attribution 3.0 Unported);
    https://www.iconfinder.com/korawan_m
         -->
        <a href="#" class="navbar-brand">
        <img src="img/logo4.png" alt="main icon">
        </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myNavbar">
            <span class="toggler-icon">
            <i class="fas fa-bars"></i>
            </span>
            </button>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="navbar-nav text-capitalize mx-auto">
                <li class="nav-item active">
                <a href="index.php" class="nav-link"> home</a>
                </li>
                <li class="nav-item active">
                <a href="about.html" class="nav-link"> about</a>
                </li>
                <li class="nav-item active">
                <a href="gallery.php" class="nav-link"> gallery</a>
                </li>
                <li class="nav-item active">
                <a href="index.php" class="nav-link"> order</a>
                </li>
                <li class="nav-item active">
                <a href="sign-in-form/index.html" class="nav-link"> sign in</a>
                </li>
            </ul>
            
            <div class="nav-info-items d-none d-lg-flex">
                <!-- phone number -->
                <div class="nav-info align-items-center d-flex justify-content-between mx-lg-5">
                    <span class="info-icon mx-lg-3">
                    <i class="fas fa-phone"></i>
                    </span>
                    <p class="mb-0">+ 27 (84) 836 1281 </p>
                </div>
                <!--  end of phone number   -->
<!-- cart -->
                <div id="cart-info" class="nav-info align-items-center cart-info d-flex justify-content-between mx-lg-5">
                <span class="cart-info_icon mr-lg-3">
                    <i class="fas fa-shopping-cart"></i>
                    </span>
                    <p class="mb-0 text-capitalize">
                    <span id="item-count"><?php if(isset($_SESSION['count']))
                                                {
                                                    echo $_SESSION['count']; 
                                                }else{
                                                    echo "0";
                                                }?></span><!-- *********************** -->
                        items - R
                        <span class="item-total">
                            <?php if(isset($_SESSION['total']))
                                                {
                                                    echo $_SESSION['total']; 
                                                }else{
                                                    echo "0";
                                                }?></span><!-- *********************** -->
                    </p>
                </div>
            </div>
        </div>
        </nav>
                        
    <!-- end of nav -->
    <!-- banner -->
        <div class="container-fluid">
        
            
    <!-- cart -->
            <div class="cart" id="cart">
                
                
                
<!-- cart item -->
            <?php
                $result_cart = $conn -> query($query_cart);
                if($result_cart)
                {
                    if($result_cart -> num_rows != 0)
                    {
                        $count = 0;
                        while($rows = $result_cart -> fetch_assoc())
                        {
                            $count += 1; 
                            $_SESSION['count'] = $count;
                            $c_pr = $rows['name'];
                            $c_p = $rows['price'];
                            $total = 0;
                            $total += $c_p; 
                            $_SESSION['total'] = $total;
                            $c_i = $rows['image'];
              ?>              
                            <div class="cart-item d-flex justify-content-between text-capitalize my-3">
                            <img src="<?php echo $c_i; ?>" class="img-fluid rounded-circle" id="item-img" alt=""  width="60px" height="45px">
                            <div class="item-text">
                            <p id="cart-item-title" class="font-weight-bold mb-0"><?php echo $c_pr; ?></p>
                            <span>R</span>
                            <span id="cart-item-price" class="cart-item-price mb-0"><?php echo $c_p; ?></span>
                            </div>
                            <a href="#" id="cart-item-remove" class="cart-item-remove">
                            <i class="fas fa-trash"></i>
                            </a>
                            </div>
                <?php
                        }
                    }else{
                        echo "Cart is empty!";
                    }
                }else
                {
                    echo "query rest for cart faile";
                }
                
            ?>
            
<!-- end of cart item -->

                
                
                
<!-- total -->
                <div class="cart-total-container d-flex justify-content-around text-capitalize mt-5">
                <h5>total</h5>
                <h5>R <strong id="cart-total" class="font-weight-bold">200</strong></h5>    
                </div>
<!-- end of total -->
<!-- cart buttons -->
                <div class="cart-buttons-container mt-3 d-flex justify-content-between">
                <a href="#" id="clear-cart" class="btn btn-black text-uppercase">clear cart</a>
                <a href="#" id="clear-cart" class="btn btn-pink text-uppercase">checkout</a>    
                </div>
                
                </div>
            
            </div>
             
    
        </header>
    
  <br>
    <br>
    
<!-- store section -->
    <section id="store" class="store py-5">
    <div class="container">
<!-- section title -->
        <div class="row">
        <div class="col-10 mx-auto col-sm-6 text-center">
        <h1 class="text-capitalize">our <strong class="banner-title">store</strong></h1>
        </div>
        </div>

<!-- store items -->
        <div class="row store-items" id="store-items">
            
  <?php foreach($products as $product):?>          
<!-- single items -->
        <div class="col-10 col-sm-6 col-lg-4 mx-auto my-3 store-item sweets" data-item="sweets">
            <div class="card ">
            <div class="img-container">
                <img src="<?php echo $product['img']?>" class="card-img-top store-img" alt="">
                <div class="store-icons d-flex justify-content-around align-items-center">
                <?php
                    $pr =  $product['name'];
                    $p_c =  $product['price'];
                    $img =  $product['img']; 
                    
                ?>
                <a href="#" class='store-item-icon' data-id="<?php echo $product['id']?>"><i class="fas fa-shopping-cart " onclick=" getProductName('<?php echo $pr; ?>', '<?php echo $p_c; ?>', '<?php echo $img; ?>');"></i></a>
                </div>
                </div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between text-capitalize">
                        
                    <h5 id="store-item-name"><?php echo $product['name']?></h5>
                        <h5 class="store-item-value">R <stong id="store-item-price" class="font-weight-bold"><?php echo $product['price']?></stong></h5>
                    </div>
                    </div>
                    </div>
                    </div>

        
   
        
<!-- end of store items -->
    <?php endforeach;?>
    
        </div>
        </div>
    </section>
<!--  end of store section  -->   
 
    
   <!-- jquery -->
   <script type="text/javascript" src="js/store.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- script js -->
  <script src="js/app.js"></script>
    </body>
    
</html>
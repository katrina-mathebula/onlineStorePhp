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
  <style>
  </style>
</head>

<body>
  
    
    <!-- Scroll To Top Button -->
<button id="back-to-top-btn"><i class="fas fa-angle-double-up"></i></button>
    

    
    <header id="header">
    <nav class="navbar navbar-expand-lg px-4" id="nav">
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
                <a href="#header" class="nav-link"> home</a>
                </li>
                <li class="nav-item active">
                <a href="about.html" class="nav-link"> about</a>
                </li>
                <li class="nav-item active">
                <a href="gallery.php" class="nav-link"> gallery</a>
                </li>
                <li class="nav-item active">
                <a href="#order" class="nav-link"> order</a>
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
        <div class="row max-height justify-content-center align-items-center">
            <div class="col-10 mx-auto banner text-center">
            
               <h1>
                <strong class="banner-title">Instinctive</strong><br>
                   <h3 class="py-0" id="banner">Natural Cosmetics</h3>
                </h1>     
                
                <a href="#order" class="btn banner-link text-uppercase my-2">explore</a>
            </div>
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
            </div>
             
    
        </header>
    
    <!-- about -->
    <section class="about py-5" id="abt">
    <div class="container">
        <div class="row">
        <div class="col-10 mx-auto col-md-6 my-5 text-center">
            <h1 class="text-capitalize ">Designed for Good </h1>
            <p class="my-4 text-muted w-90 ">
            As an ethical cosmetic brand, we consider every detail – from natural ingredients to locally sourced, recyclable or compostable packaging. Our virtues extend beyond the bottle, as our handcrafted products intend to allow gentler, more sensitive skin types to naturally react without discomfort.


            </p>
            <a href="about.html" class="btn btn-black text-uppercase">Learn more</a>
            </div>
       
        </div>
        </div>
    </section>
    

    
<!-- services -->
    <section id="services" class="services py-5">
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto col-md-6 my-5">
        </div>
        </div>
        </div>
    </section>
    
<!-- order -->
    <section id="order" class="order py-5 my-5">
    <div class="container">
        <!-- section title -->
        <div class="row">
        <div class="col-10 mx-auto col-sm-6 text-center">
        <h1 class="text-capitalize">upcoming <strong class="banner-title">collection</strong></h1>
        </div>
        </div>
        
        <div class="row">
            
            
<!-- single product -->
            <div class=" mx-auto col-md-2 my-4 text-capitalize text-center">
            <h3 class="py-3">Soap</h3>
                <div class="text-muted">
                <p class="my-1">Homemade soap</p>
                <p class="my-1">natural ingredients 200g</p><br>
                <img src="img/soaps1.jpg" class="img-fluid" alt="">
                    
                </div>
            </div>
<!-- end of single product -->
<!-- single product -->
            <div class=" mx-auto col-md-2 my-4 text-capitalize text-center">
            <h3 class="py-3">Body Butter</h3>
                <div class="text-muted">
                <p class="my-1">variety of different body butter</p>
                <p class="my-1">natural ingredients 250ml</p><br>
                <img src="img/bodybutter3.jpg" class="img-fluid" alt="">
                    
                </div>
            </div>
<!-- end of single product -->
<!-- single product -->
            <div class=" mx-auto col-md-2 my-4 text-capitalize text-center">
            <h3 class="py-3">Room spray</h3>
                <div class="text-muted">
                <p class="my-1">room mist</p>
                <p class="my-1">natural ingredients 250ml</p><br>
                <img src="img/roomspray1.jpg" class="img-fluid" alt="">
                    
                </div>
            </div>
<!-- end of single product -->
<!-- single product -->
            <div class=" mx-auto col-md-2 my-4 text-capitalize text-center">
            <h3 class="py-3">Lotion</h3>
                <div class="text-muted">
                <p class="my-1">homemade lotion</p>
                <p class="my-1">natural ingredients 250ml</p><br>
                <img src="img/lotion1.jpg" class="img-fluid" alt="">
                    
                </div>
            </div>
<!-- end of single product -->            
            
        </div>
        </div>
    </section>
    
<!--  footer  -->
    <footer>
    <div class="container-fluid ">
        <div class="row">
        <div class="col-md-6 footer-title py-4 ">
        <h1 class="text-capitalize text-center">
            <strong class="banner-title">instinctive</strong>
            </h1>
            <div class="footer-icons mt-3 d-flex justify-content-around flex-wrap">
            <a href="#" class="footer-icon">
                <i class="fab fa-facebook"></i>
                </a>
            <a href="#" class="footer-icon">
                <i class="fab fa-twitter"></i>
                </a>
            <a href="#" class="footer-icon">
                <i class="fab fa-instagram"></i>
                </a>
            <a href="#" class="footer-icon">
                <i class="fab fa-google-plus"></i>
                </a>
        </div>
        </div>
        <div class="col-md-6 footer-contact text-capitalize py-4">
        <h3 class="mb-4 text-center ">contact</h3>
            <p class="d-flex flex-wrap">
            <span class="mr-4 footer-icon">
                <i class="fas fa-map"></i>
                </span>
                <span>
                214 Riverdale industrial park <br> 18 Dawnhill Road, maxmead pinetown 3620
                </span>
            </p>
            <p class="d-flex flex-wrap">
            <span class="mr-4 footer-icon">
                <i class="fas fa-phone"></i>
                </span>
                <span>
                084 836 1281
                </span>
            </p>
            <p class="d-flex flex-wrap">
            <span class="mr-4 footer-icon">
                <i class="fas fa-envelope"></i>
                </span>
                <span>
                celiamurray16@gmail.com
                </span>
            </p>
        </div>
        </div>
        </div>
    </footer>
    

  <!-- jquery -->
   <script type="text/javascript" src="js/store.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- script js -->
  <script src="js/app.js"></script>
  
</body>
    

</html>
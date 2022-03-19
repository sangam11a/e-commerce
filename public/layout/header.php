<?php 
require_once "../includes/init.php"; 
$category = new Category;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- try -->
    <link href="layout/css/ui.css" rel="stylesheet" type="text/css" />




    <title>Home Appliance</title>
</head>
<body>
    <div class="container-out">
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid pe-lg-2 p-0"> <a class="navbar-brand fw-bold fs-3" href="index.php"><img src="../img/logo.jpeg" alt="Brand Logo" width="50px" >Home Appliances</a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold active" aria-current="page" href="index.php">HOME</a> </li>
                    <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" href="cart.php">CART</a> </li>
                    <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" href="orders.php">ORDERS</a> </li>
                    <!-- <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" href="#">CONTACT</a> </li> -->
                    <?php 
                        if(!cLogged()){
                    ?>
                    <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" href="login.php">LOGIN</a> </li>
                    <?php
                        }else{
                            ?>
                            <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold text-danger" href="logout.php" onClick="return confirm('Confirm Logout')">LOGOUT</a> </li>
                        <?php
                        }
                    ?>
                </ul>
                <?php 
                if(cLogged()){
                    ?>
                        <ul class="navbar-nav icons ms-auto mb-2 mb-lg-0">
                            <li class=" nav-item pe-3"> <a href="wish.php" class="fas fa-heart"> <span class="num rounded-circle">
                                <?php 
                                    $WISH = new Wish();
                                    if(is_array($WISH->getAll($_SESSION['customer_id']))){
                                        echo count($WISH->getAll($_SESSION['customer_id']));
                                    }else{
                                        echo 0;
                                    }
                                ?>
                            </span> </a> </li>
                            <li class=" nav-item pe-3"> 
                                <a href="cart.php" class="fas fa-shopping-bag"> 
                                    <span class="num rounded-circle">
                                <?php
                                    $cart = new Cart(); 
                                        if(is_array($cart->getAll($_SESSION['customer_id']))){
                                            echo count($cart->getAll($_SESSION['customer_id']));
                                        }else{
                                            echo 0;
                                        }
                                    ?>
                                </span> 
                                </a> 
                            </li>
                            <li class=" nav-item"> <span class="">items: Rs.</span> <span class="fw-bold">
                                <?php
                                    if($cart->total($_SESSION['customer_id']) > 0){
                                        echo $cart->total($_SESSION['customer_id']);
                                    }else{
                                        echo "0";
                                    }
                                ?>
                            </span> </li>
                        </ul>
                    <?php
                }else{
                    ?>
                        <ul class="navbar-nav icons ms-auto mb-2 mb-lg-0">
                            <li class=" nav-item pe-3"> <a href="wish.php" class="fas fa-heart"> <span class="num rounded-circle">0</span> </a> </li>
                            <li class=" nav-item pe-3"> <a href="cart.php" class="fas fa-shopping-bag"> <span class="num rounded-circle">0</span> </a> </li>
                        </ul>
                    <?php
                }
                ?>
                
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col-lg-3 mb-lg-0 mb-2">
            <p> <a  class="btn btn-primary w-100 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#collapseExample"  role="button" aria-expanded="true" aria-controls="collapseExample"> <span class="fas fa-bars"><span class="ps-3">All Categories</span></span> <span class="fas fa-chevron-down"></span> </a> </p>
            <div class="<?php if(isset($banda)){echo "collapse";}else{echo "collapse show";} ?>  border" id="collapseExample">
                <ul class="list-unstyled">
                    <?php 
                    if($category->getAll() > 0):
                        foreach ($category->getAll() as $cat):
                    ?>
                        <li><a class="dropdown-item" href="category.php?id=<?=$cat['ct_id']?>"><?=$cat['ct_name']?></a></li>
                    <?php    
                        endforeach;
                    else:
                        echo "<p style='color:red;'>No categories</p>";
                    endif;
                    ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="d-lg-flex">
                <div class="d-lg-flex align-items-center">
                    <form action="search.php" method="post">
                    <div class="d-flex align-items-center w-100 h-100 ps-lg-0 ps-sm-3">
                       
                       <input class="form-control p-2" type="text" name='item_searched' placeholder="what do you need?" required>
                       <button type="submit" name="search" class="btn btn-primary d-flex align-items-center justify-content-center">SEARCH</button>
                   
               </div>
                    </form>
                    
                </div>
                <?php 
                            if(cLogged()){
                                $customer = new Customer();
                                ?>
                <div class="d-flex align-items-center ms-lg-auto mt-lg-0 mt-3 pe-2"> <span class=" me-2 fas fa-user bg-light rounded-circle"></span>
                    <div class="d-flex flex-column ps-2">
                        
                                <p class="fw-bold"><?=$customer->selected($_SESSION['customer'])['name']?></p>
                                <?php
                            }else{
                                ?>
                                <div class="d-flex align-items-center ms-lg-auto mt-lg-0 mt-3 pe-2"> <a href="login.php"><span class=" me-2 fas fa-user-slash bg-light rounded-circle"></span></a>
                    <div class="d-flex flex-column ps-2">
                                <?php
                            }
                        ?>

                    </div>
                </div>
            </div>
            <hr style="width:100%;text-align:left;margin-left:0">

            
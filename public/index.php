<?php 
require_once "../helpers/functions.php";
// customerLogin();
session_start();
if(isset($_SESSION['order_placed'])){
    unset($_SESSION['order_placed']);
}
require_once "layout/header.php";
$products = new Product();
$SALES = new Sales;

?>
<link rel="stylesheet" href="layout/css/productlist.css">
<?php
$banner = $SALES->mostSales(); 
if($banner > 0):
?>
            <div style="position: relative;" class="d-lg-flex flex-lg-row d-flex flex-column-reverse bg-light mt-2 ">
                <div class="p-5" id="2">
                    <p class="p-green"><?=$banner['pr_brand']?></p>
                    <P class="fs-4 fw-bold"><?=$banner['pr_name']?></P>
                    <p class="fs-4 fw-bold">Rs.<?=$banner['pr_price']?></p>
                    <p class="text-muted mb-4">Free Delivery Available</p>
                        <form action="buynow.php" method="post">
                                <input type="hidden" name="product" value="<?=$banner['pr_id']?>" required>
                                <button type="submit" name="buynow" class="btn btn-primary w-100">BUY NOW</button> 
                        </form>
                </div>
                <marquee behavior="alternate" direction="right"><div id="1" class="front"><img src="../admin/uploads/<?=$banner['pr_img']?>" class="w-75 h-100" alt="banner img"></div></marquee>
                <marquee style="position:absolute; top: 2px;left:10px;color:green" behavior="alternate" width="200px;" direction=""><h3>Best Sales <i class="fas fa-shopping-bag"></i></h3></marquee>
            </div>
            <?php 
            endif; ?>
        </div>
        <div class="row g-1 mt-4 mb-2">
            <?php 
            if($products->getProduct() > 0):
                foreach($products->getProduct() as $product):
            ?>
                <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1">    
                    <div class="card p-2 ml-5 border">
                        <div class="p-info px-3 py-3">
                            <div>
                                <h5 class="mb-0"><?=$product['pr_name']?></h5> <span><?=$product['ct_name']?></span>
                            </div>
                            <div class="p-price d-flex flex-row"> <span>Rs</span>
                                <h1><?=$product['pr_price']?></h1>
                            </div>
                            <form action="wish.php" method="post">
                                <input type="hidden" name="product" value="<?=$product['pr_id']?>">
                                <div class="heart">
                                <button type="submit" name="wish">
                                    <i class="fas fa-heart"></i> 
                                </button>
                                </div>
                            </form>
                        </div>
                        <div class="text-center p-image"> <img src="../admin/uploads/<?=$product['pr_img']?>"> </div>
                        <div class="p-about">
                            <p><?=$product['pr_desc']?></p>
                        </div>
                        <div class="buttons d-flex flex-row gap-3 px-3"> 
                            <a href="view.php?id=<?=$product['pr_id']?>" class="text-white"><button class="btn btn-danger w-100">View</button></a> 
                            <form action="buynow.php" method="post">
                                <input type="hidden" name="product" value="<?=$product['pr_id']?>" required>
                                <button type="submit" name="buynow" class="btn btn-outline-danger w-100"><i class="fas fa-shopping-cart"></i></button> 
                            </form>
                    </div>
                    </div>
                </div>
                
            <?php    
                endforeach;
            else:
                echo "
                    <div class='alert alert-info alert-dismissible fade show' role='alert'>
                        <strong>Alert!</strong> No product available. 
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            endif;
            ?>
        </div>

<?php require_once "layout/footer.php" ?>
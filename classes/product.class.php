<?php  
require_once "../classes/dbh.class.php";

class Product extends Dbh {
    public function getProduct() {
        $sql = "SELECT * FROM `products` INNER JOIN categories WHERE cat_id = categories.ct_id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function selected($id) {
        $sql = "SELECT * FROM `products` INNER JOIN categories WHERE cat_id = categories.ct_id AND pr_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();
        return $result;
    }

    public function addProduct($name, $desc, $image, $price, $qty, $category, $brand) {
        $sql = "INSERT INTO products (pr_name, pr_desc, pr_img, pr_price, pr_qty, cat_id, pr_brand, stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$name, $desc, $image, $price, $qty, $category, $brand, $qty]);
    }

    public function editProduct($id) {
        $sql = "SELECT * FROM `products` inner join categories on cat_id = categories.ct_id WHERE pr_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();
        return $result;
    }

    public function updateProduct($name, $desc, $newFileName, $price, $category, $brand, $id) {
        $sql = "UPDATE products set pr_name = ?, pr_desc = ?, pr_img = ?, pr_price = ?, cat_id = ?, pr_brand = ? WHERE pr_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $desc, $newFileName, $price, $category, $brand, $id]);
    }

    public function updateProductQty($product, $changeqty){
        $sql = "UPDATE products set pr_qty = ? WHERE pr_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$product, $changeqty]);
    }

    public function delProduct($id) {
        $sql = "DELETE FROM products WHERE pr_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    public function addQuantity($quantity, $stock, $id){
        $sql = "UPDATE products set pr_qty = ? , stock = ? WHERE pr_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$quantity, $stock, $id]);
    }

    public function getLast(){
        $sql = "SELECT * FROM products inner join categories on cat_id = categories.ct_id ORDER BY pr_id DESC LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // public function getRating($id) {
    //     $sql = "SELECT * FROM `products` INNER JOIN rating WHERE pr_id = rating.product_id AND pr_id = ?";
    //     $stmt = $this->connect()->prepare($sql);
    //     $stmt->execute([$id]);
    //     while($result = $stmt->fetchAll()) {
    //         return $result;
    //     }
    // }

    public function getRating($id) {
        $sql = "SELECT * FROM rating WHERE product_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        while($result = $stmt->fetchAll()) {
           return $result;
        }
    }

    public function notRated($customer, $product){
        $sql = "SELECT * FROM rating WHERE customer_id = ? AND product_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$customer, $product]);

        if($stmt->fetch() > 0){
            return false;
        }else{
            return true;
        }
        
    }


    public function getComments($id) {
        $sql = "SELECT * FROM `rating` inner JOIN customers WHERE customer_id = customers.cus_id AND product_id = $id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        while($result = $stmt->fetchAll()) {
           return $result;
        }
    }

    public function delComment($customer, $product) {
        $sql = "DELETE FROM rating WHERE customer_id = ? AND product_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$customer,  $product]);
    }


    public function addComment($customer, $ratepoint, $comment, $productid) {
        $sql = "INSERT INTO rating (customer_id, rate_points, feedback, product_id) VALUES (?, ?, ?, ?)";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$customer, $ratepoint, $comment, $productid]);
    }
    
    public function getStar($id){
        if(is_array($this->getRating($id))){
            $total = count($this->getRating($id));            
            $rated = 0;
            foreach($this->getRating($id) as $prod){
                // echo "<br>".$prod['rate_points'];
                $rated = $rated + $prod['rate_points'];
            }
            // echo "<br>";
            // echo $rated;
            // echo "<br>";
            $rating = $rated/$total;
    
            $percent = ($rated/($total*5))*100;
            $rating_fix = number_format($rating, 1, '.', '');
            return ['percent'=>$percent, "rating"=>$rating_fix, "total"=>$total];
        }
        else{
            return ['percent'=>$percent=0, 'rating'=>$rating_fix=0]; 
        }
        
    }

    public function searchItem($name){
        $sql = "SELECT * FROM products INNER JOIN categories WHERE (products.pr_name LIKE '%$name%' OR products.pr_desc LIKE '%$name%' OR categories.ct_name LIKE '%$name%') AND products.cat_id = categories.ct_id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        while($result = $stmt->fetchAll()) {
            return $result;
        }    
    }

    public function relatedProduct($name){
        $sql = "SELECT * FROM `products`
                INNER JOIN sales INNER JOIN categories 
                WHERE (cat_id = 16 or pr_brand = 'usha') 
                AND ( products.pr_id=sales.product_id AND products.cat_id = categories.ct_id )
                 ORDER BY sales.sales_qty DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        while($result = $stmt->fetchAll()) {
            return $result;
        }    
    }

}
<?php
class ProductModel extends DB{
    public function getProductList(){
        $sql = parent::$connection->prepare('SELECT * FROM product');
        return parent::select($sql);
    }
    
    public function addProduct($productName, $categoryId,  $productImage)
    {
        $sql = parent::$connection->prepare('INSERT INTO `product` (`product_name`, `category_id`, `product_img`) VALUES (?, ?, ?)');
        $sql->bind_param('sss', $productName, $categoryId, $productImage);
        return $sql->execute();
    }
}
?>
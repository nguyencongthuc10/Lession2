<?php
class ProductModel extends DB{
    public function getProductList(){
        $sql = parent::$connection->prepare('SELECT * FROM product');
        return parent::select($sql);
    }

}
?>
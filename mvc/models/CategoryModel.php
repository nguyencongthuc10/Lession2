<?php
class CategoryModel extends DB{
    
    // get all categories
    public function getCategoryList(){

        $sql = parent::$connection->prepare('SELECT * FROM category');
        return parent::select($sql);
    }

}
?>
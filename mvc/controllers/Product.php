<?php

class Product extends Controller{
    
        public function functionShare(){
            $allCategories = $this->model('CategoryModel');
            $allProducts = $this->model('ProductModel');
        }
    
    
    // show products and categories
    function showProduct(){
        
        $allCategories = $this->model('CategoryModel');
        $allProducts = $this->model('ProductModel');
        $this->view("managerProduct", [
            "Categories"=>$allCategories->getCategoryList(),
            "products"=>$allProducts->getProductList()

        ]);
    }
    // add new product
    public function newProduct(){
        $productName = $_POST['productName'];
        $categoryId = $_POST['categoryId'];
        if(isset($_POST['productName'])){
            $target_dir = "public/images/";
        // $target_file specifies the path of the file to be uploaded
        $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
        // $uploadOk=1 is not used yet (will be used later)
        $uploadOk = 1;
        // $imageFileType holds the file extension of the file (in lower case)
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["productImage"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["productImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        //Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["productImage"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }
       
       
        }else{
            functionShare();
            $this->view("managerProduct", [
                "Categories"=>$allCategories->getCategoryList(),
                "products"=>$allProducts->getProductList()

            ]);
        }
        // $target_dir = "uploads/" - specifies the directory where the file is going to be placed
       
        
    }
}
?>
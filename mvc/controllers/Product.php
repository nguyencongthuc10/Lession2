<?php

class Product extends Controller{
    
    
    
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
        
        if(isset($_POST['productName'])){
        $productName = $_POST['productName'];
        $categoryId = $_POST['categoryId'];
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
            $message = "File is not an image.";
            echo "<script type='text/javascript'>alert('$message');</script>";
            $uploadOk = 0;
            $this->showProduct();
            return;
        }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        $message = "Sorry, file already exists.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        $uploadOk = 0;
        $this->showProduct();
        return;
        }

        // Check file size
        if ($_FILES["productImage"]["size"] > 500000) {
        $message = "Sorry, your file is too large.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        $uploadOk = 0;
        $this->showProduct();
        return;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        $uploadOk = 0;
        $this->showProduct();
        return;
        }

        //Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $message = "Sorry, there was an error uploading your file.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        // if everything is ok, try to upload file
        } else {
            $insertProduct = $this->model('ProductModel');          
             $insertProduct->addProduct($productName, $categoryId, $_FILES["productImage"]["name"]);
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
            $message = "Successfully ADD.";
            echo "<script type='text/javascript'>alert('$message');</script>"; 
            
            $this->showProduct();
           
        } else {
            $message = "Sorry, there was an error uploading your file.";
            echo "<script type='text/javascript'>alert('$message');</script>";
            $this->showProduct();
        }
        }
       
       
        }else{
            $this->showProduct();
        }
        
       
        
    }
}
?>
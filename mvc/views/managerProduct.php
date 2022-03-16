<?php
require_once './config/database.php';
require_once './config/config.php';

$_SESSION['token'] = md5(uniqid(mt_rand(), true));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="/<?php echo BASE_URL; ?>/public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <title>Quản lý sản phẩm</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header__left">
                <img class="img-responsive" id="logo" src="/<?php echo BASE_URL; ?>/public/images/logo.png" alt="logo">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Categories</a>
                </li>

                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        
                        <div class="show__product">
                            <table class="table table-bordered">
  
                                    <?php 
                                    // check data['product'] exist
                                        if(isset($data['products']) && isset($data['Categories'])){
                                    ?>
                                    <div class="search_product">
                                        <form>
                                            <i class="fa fa-search" aria-hidden="true"></i>

                                            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                                        </form>
                                    </div>
                                    <div class="add_resultSearch">
                                        <ul>
                                            <li></li>
                                            <!-- <li><span>Search found</span> 15 <span>results</span></li> -->
                                            <li><i class="fa fa-plus-circle" aria-hidden="true" data-toggle="modal" data-target="#addProduct"></i>
                                            </li>
                                        </ul>
                                    </div>
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Operations</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php 
                                         foreach ($data['products'] as $pro) {
                                    ?>
                                       <tr>
                                        <th scope="row">1</th>
                                        <td><?php echo $pro['product_name']?></td>
                                        <?php 
                                            foreach ($data['Categories'] as $cate) {
                                                if($pro['category_id'] == $cate['id']){
                                                    echo "<td>".$cate['category_name']."</td>";
                                                }
                                            }
                                        ?>
                                        <td>
                                            <div class="imgShowProdcut"><img src="/<?php echo BASE_URL; ?>/public/images/<?php echo $pro['product_img'] ?>" alt="a"></div>
                                        </td>
                                        <td>
                                            <div class="operations">
                                                <span data-toggle="tooltip" data-html="true" data-placement="bottom" title="Edit">
                                                    <a href="#" data-id="<?php echo $pro['id'] ?>" id="editProductJs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                </span>
                                                <span data-toggle="tooltip" data-html="true" data-placement="bottom" title="Add">
                                                    <a href="#" data-toggle="modal" data-target="#addProduct"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                </span>
                                                <span data-toggle="tooltip" data-html="true" data-placement="bottom" title="Copy">
                                                    <a href="#"><i class="fa fa-clone" aria-hidden="true"></i></a>
                                                </span>
                                                <span data-toggle="tooltip" data-html="true" data-placement="bottom" title="View">
                                                    <a href="#" data-toggle="modal" data-target="#viewProduct" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        }else{
                                    ?>
                                    <tr>Không có dữ liệu</tr>
                                    <?php

                                        }
                                    ?>

                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination__nav">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>



                            <!-- Modal -->
                            <div class="modalCRUD">
                                <!-- Modal Add new Product -->
                                <div class="modal fade" id="addProduct" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Add new product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/<?php echo BASE_URL; ?>/Product/newProduct"method="post" enctype="multipart/form-data" id="addProductForm">
                                                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
                                                    <div class="form-group">
                                                        <label for="productName">Product name</label>
                                                        <input type="text" class="form-control" id="productName" name="productName"
                                                            placeholder="Enter product name">
                                                            <span class="form-message"></span>
                                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="optionCategory">Category</label>
                                                        <select class="form-control" id="optionCategory" name="categoryId">
                                                            <?php  
                                                                foreach ($data['Categories'] as $cateOption) {      
                                                            ?>
                                                                <option value="<?php echo $cateOption['id']?>"><?php echo $cateOption['category_name']; ?></option>
                                                            
                                                            <?php } ?>
                                                        </select>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Product image</label>
                                                        <input type="file" class="form-control-file" name="productImage" required >
                                                        <span class="form-message"></span>
                                            </div>
                                                                        
                                            <button type=" submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal Add new product -->

                                <!-- Modal  Edit Product -->
                                <div class="modal fade" id="editProduct" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="productName">Product name</label>
                                                        <input type="text" class="form-control" " aria-describedby=" emailHelp"
                                                            placeholder="Enter email">
                                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="optionCategory">Category</label>
                                                        <select class="form-control" id="optionCategory">
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Product image</label>
                                                        <input type="file" class="form-control-file" ">
                                            </div>
                                                                        
                                            <button type=" submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal edit new product -->
                                <!-- Modal view Product -->
                                <div class="modal fade" id="viewProduct" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Detail Product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="productName">Product name</label>
                                                        <input type="text" class="form-control" " aria-describedby=" emailHelp"
                                                            placeholder="Enter email">
                                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="optionCategory">Category</label>
                                                        <select class="form-control" id="optionCategory">
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Product image</label>
                                                        <input type="file" class="form-control-file" ">
                                            </div>
                                                                        
                                            <button type=" submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal view product -->
                            
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

              
                        <div class="show__product" style="margin-top:50px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category Name</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- shown all categories -->
                                    <!-- //check $data['categories'] is not empty -->
                                   <?php 
                                
                                        if(isset($data['Categories'])){
                                    ?>  
                                        <?php 
                                            foreach ($data['Categories'] as $category) {
                                        ?>  <tr>
                                                <th scope="row"><?php echo $category['id'] ?></th>
                                                <td><?php echo $category['category_name'] ?></td>
                                                </tr>
                                        <?php
                                            }
                                        ?>
                                    <?php
                                        }else{
                                            echo "No category";
                                        }
                                   ?>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination__nav">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>



                           

                        </div>
                    </div>

                        
                </div>
            </div>
                 
        </div>
       
        <div class="footer">
            <span>Copyright &copy; 2020 - All rights reserved.</span>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="/<?php echo BASE_URL; ?>/public/js/validation.js"></script>
<script src="/<?php echo BASE_URL; ?>/public/js/script.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#editProductJs').click(function(){
        var id = $(this).data('id');
        // $('#editProduct').modal('show');
        alert(id);
    });
    // show edit product ajax
    function showEditProductAjax($id) {
            $.ajax({
                method: 'post',
                url: '{{ url('/Product/editProduct/') }}',
                timeout: 3000,
                data: {

                    id: $id,
                },
                success: function(data) {

                    $('#searchAjax').html(data);
                }
            });
        }
</script>
</html>

<!-- data-toggle="modal" data-target="#editProduct" -->
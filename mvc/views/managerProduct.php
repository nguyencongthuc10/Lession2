<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <title>Quản lý sản phẩm</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header__left">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cateogries</a>
                    </li>

                </ul>
            </div>
            <div class="header__right">
                <img class="img-responsive" src="./public/images/logo.png" alt="logo">
            </div>
        </div>
        <div class="search_product">
            <form>
                <i class="fa fa-search" aria-hidden="true"></i>

                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </form>
        </div>
        <div class="add_resultSearch">
            <ul>
                <li><span>Search found</span> 15 <span>results</span></li>
                <li><i class="fa fa-plus-circle" aria-hidden="true"></i></li>
            </ul>
        </div>
        <div class="show__product">
            <table class="table table-bordered">
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
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                    
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
        <div class="footer">
            <span>Copyright &copy; 2020 - All rights reserved.</span>
        </div>
    </div>
</body>

</html>
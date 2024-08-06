<?php
    session_start();
    if(isset($_SESSION["managerUsername"])){   
    }
    else{
        header("location:index.php");
    }
    //connection code
    require_once("dbconnection.php");

    //insert code
    if(isset($_POST['editproduct'])){
        $statement = $connect->prepare("UPDATE producttable SET productName = '".$_POST['productName']."', productType = '".$_POST['productType']."', productPrice = '".$_POST['productPrice']."', productQuantity = '".$_POST['productQuantity']."', productTotal = '".$_POST['productTotal']."' WHERE productID = ".$_GET["productID"]);
        $statement->execute();
        echo "<script>alert('Updated the table succesfully.');</script>";
        echo "<script>window.location.href='productTable.php'</script>";
    }

    //select/read code
    $statement = $connect->prepare("SELECT * FROM producttable WHERE productID=".$_GET["productID"]);
    $statement->execute();
    $statement->fetchALL();
    $connect = null;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Meta -->
        <meta charset="utf-8">
        <meta name="author" content="Jeremiah Limpin">
        <meta name="keywords" content="Product Table, Sales Management System, HTML, CSS, PHP PDO">
        <meta name="description" content="This is the product table.">
        <!-- For Mobile Devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- For CSS -->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <!-- Favicon -->
        <link rel="icon" href="../img/dhvsu.png" type="image/png" sizes="16x16">
        <title>Product Table - Jeyml Mini Mart</title>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="dashboard.php"><img src="../img/logo.png" height="50px" width="155px"></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" method="post" action="productSearch.php">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search ID" name="productID" aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" name="search" value="➤"></input>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.php">401 Page</a>
                                            <a class="nav-link" href="404.php">404 Page</a>
                                            <a class="nav-link" href="500.php">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Tables</div>
                            <a class="nav-link" href="transactionTable.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Transaction Table
                            </a>
                            <a class="nav-link" href="cashierTable.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Cashier Table
                            </a>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Product Table
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION["managerUsername"]; ?> (Manager)
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                 <main>
                    <div class="card-header"><h3 class="mt-4">Edit Product ID: <?php echo $_GET["productID"]; ?></h3></div>
                    <div class="card-body">
                        <form  name="transaction_form" method="post" autocomplete="off">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="productName">Name</label>
                                        <input class="form-control py-4" type="text" name="productName" placeholder="Product Name" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="productType">Type</label>
                                        <input class="form-control py-4" type="text" name="productType" placeholder="Product Type" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="productPrice">Price</label>
                                        <input class="form-control py-4" type="text" name="productPrice" placeholder="Product Price" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="productQuantity">Quantity</label>
                                        <input class="form-control py-4" type="text" name="productQuantity" placeholder="Product Quantity" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="submit" name="totalprice" class="btn btn-primary btn-block" value="Total Price"/>
                                    </div>
                            </div>
                        </form>

                        </form>
                        <form  name="transaction_form" method="post" autocomplete="off">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php 
                                        if(isset($_POST['totalprice']))  
                                        {  

                                        $productPrice = $_POST['productPrice'];  
                                        $productQuantity = $_POST['productQuantity'];  
                                        $productTotal =  $productPrice*$productQuantity;   
                                           
                                        echo "<label class='small mb-1' for='productTotal'>Product Total</label>";
                                        echo "<input class='form-control py-4' type='text' name='productTotal' value='$productTotal' required/>";
                                        }  
                                    ?>
                                </div>
                            </div>
                        </form>
                        <form name="transaction_form" method="post" autocomplete="off">
                           <?php
                                if(isset($_POST['totalprice']))  
                                {
                                $productName = $_POST['productName'];
                                $productType = $_POST['productType'];
                                $productPrice = $_POST['productPrice'];
                                $productQuantity = $_POST['productQuantity'];
                                $productTotal = $productPrice*$productQuantity;
                                } 
                            ?> 
                            <input type="hidden" name="productName" value="<?php echo"$productName" ?>" ><br>   
                            <input type="hidden" name="productType" value="<?php echo"$productType" ?>"><br>   
                            <input type="hidden" name="productPrice" value="<?php echo"$productPrice" ?>"><br>   
                            <input type="hidden" name="productQuantity" value="<?php echo"$productQuantity" ?>" ><br>
                            <input type="hidden" name="productTotal" value="<?php echo"$productTotal" ?>">
                            
                            <div class="form-group mt-4 mb-0">
                                <input type="submit" name="editproduct" class="btn btn-primary btn-block" value="Update Product"/>
                            </div>
                        </form>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Jeyml Mini Mart 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>

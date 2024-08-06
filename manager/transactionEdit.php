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
    if(isset($_POST['edittransaction'])){
        $statement = $connect->prepare("UPDATE transactiontable SET transactionDate = '".$_POST['transactionDate']."', managerID = '".$_POST['managerID']."', cashierID = '".$_POST['cashierID']."', productID = '".$_POST['productID']."', customerCash = '".$_POST['customerCash']."' WHERE transactionID = ".$_GET["transactionID"]);
        $statement->execute();
        echo "<script>alert('Updated the table succesfully.');</script>";
        echo "<script>window.location.href='transactionTable.php'</script>";
    }

    //select/read code
    $statement = $connect->prepare("SELECT * FROM transactiontable WHERE transactionID=".$_GET["transactionID"]);
    $statement->execute();
    $statement->fetchALL();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Meta -->
        <meta charset="utf-8">
        <meta name="author" content="Jeremiah Limpin">
        <meta name="keywords" content="Transaction Table, Sales Management System, HTML, CSS, PHP PDO">
        <meta name="description" content="This is the transaction table.">
        <!-- For Mobile Devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- For CSS -->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <!-- Favicon -->
        <link rel="icon" href="../img/dhvsu.png" type="image/png" sizes="16x16">
        <title>Transaction Table - Jeyml Mini Mart</title>
        <script>
            function managerSelect2() 
            {
                var d=document.getElementById("managerSelect1");
                var displaytext=d.options[d.selectedIndex].text;
                document.getElementById("managertxt").value=displaytext;
            }
            function cashierSelect2() 
            {
                var d=document.getElementById("cashierSelect1");
                var displaytext=d.options[d.selectedIndex].text;
                document.getElementById("cashiertxt").value=displaytext;
            }
            function productSelect2() 
            {
                var d=document.getElementById("productSelect1");
                var displaytext=d.options[d.selectedIndex].text;
                document.getElementById("producttxt").value=displaytext;
            }
        </script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="dashboard.php"><img src="../img/logo.png" height="50px" width="155px"></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" method="post" action="transactionSearch.php">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search ID" name="transactionID" aria-label="Search" aria-describedby="basic-addon2" />
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
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Transaction Table
                            </a>
                            <a class="nav-link" href="cashierTable.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Cashier Table
                            </a>
                            <a class="nav-link" href="productTable.php">
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
                    <div class="container-fluid">
                        <h1 class="mt-4">Transaction Table</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Transaction Table</li>
                        </ol>
                    <div class="card-header"><h3 class="mt-4">Edit Transaction ID: <?php echo $_GET["transactionID"]; ?></h3></div>
                    <div class="card-body">
                        <form  name="transaction_form" method="post" autocomplete="off">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="transactionDate">Transaction Date</label>
                                        <input class="form-control py-4" type="date" name="transactionDate" placeholder="Transaction Date" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="managerID">Manager ID</label>
                                        <?php 
                                            $pdoQuery = "SELECT managerID FROM managertable";

                                            $pdoResult = $connect->query($pdoQuery);

                                            $dropdown="<select id='managerSelect1' onchange='managerSelect2();'>";
                                            foreach ($pdoResult as $row) {
                                                $dropdown .="\r\n<option value='{$row['managerID']}'>{$row['managerID']}</option>";
                                            }
                                            $dropdown .="\r\n</select>";
                                            echo $dropdown;
                                            echo '</select>';
                                            echo "<input class='form-control py-4' type='text' name='managerID' id='managertxt' placeholder='Manager ID' required/>";
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="cashierID">Cashier ID</label>
                                        <?php 
                                            $pdoQuery = "SELECT cashierID FROM cashiertable";

                                            $pdoResult = $connect->query($pdoQuery);

                                            $dropdown="<select id='cashierSelect1' onchange='cashierSelect2();'>";
                                            foreach ($pdoResult as $row) {
                                                $dropdown .="\r\n<option value='{$row['cashierID']}'>{$row['cashierID']}</option>";
                                            }
                                            $dropdown .="\r\n</select>";
                                            echo $dropdown;
                                            echo '</select>';
                                            echo "<input class='form-control py-4' type='text' name='cashierID' id='cashiertxt' placeholder='Cashier ID' required/>";
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="productID">Product ID</label>
                                        <?php 
                                            $pdoQuery = "SELECT productID FROM producttable";

                                            $pdoResult = $connect->query($pdoQuery);

                                            $dropdown="<select id='productSelect1' onchange='productSelect2();'>";
                                            foreach ($pdoResult as $row) {
                                                $dropdown .="\r\n<option value='{$row['productID']}'>{$row['productID']}</option>";
                                            }
                                            $dropdown .="\r\n</select>";
                                            echo $dropdown;
                                            echo '</select>';
                                            echo "<input class='form-control py-4' type='text' name='productID' id='producttxt' placeholder='Product ID' required/>";
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="customerCash">Customer Cash</label>
                                        <input class="form-control py-4" type="text" name="customerCash" placeholder="₱" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4 mb-0">
                                <input type="submit" name="edittransaction" class="btn btn-primary btn-block" value="Edit Transaction"/>
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

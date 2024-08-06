<?php 
    require_once("dbconnection.php");
    if(isset($_POST['create'])){
        //entering user credentials into the database
        $statement = $connect->prepare('insert into cashiertable(cashierEmail,cashierUsername,cashierPassword) values(:cashierEmail,:cashierUsername,:cashierPassword)');
        
        $statement->bindValue('cashierEmail',$_POST['cashierEmail']);
        $statement->bindValue('cashierUsername',$_POST['cashierUsername']);
        $statement->bindValue('cashierPassword',$_POST['cashierPassword']);
        $statement->execute();
        echo "<script>alert('Registered succesfully. Please login.');</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Meta -->
        <meta charset="utf-8">
        <meta name="author" content="Jeremiah Limpin">
        <meta name="keywords" content="Register, Sales Management System, HTML, CSS, PHP PDO">
        <meta name="description" content="This is the register page.">
        <!-- For Mobile Devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- For CSS -->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <!-- Favicon -->
        <link rel="icon" href="../img/dhvsu.png" type="image/png" sizes="16x16">
        <title>Register - Jeyml Mini Mart</title>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <img src="../img/avatar.png" alt="Icon" class="avatar">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                        <div class="card-body">
                                            <form  name="register" method="post" autocomplete="off">
                                                <div class="form-group">
                                                    <label class="small mb-1" >Cashier Email</label>
                                                    <input class="form-control py-4" id="inputCashierEmail" type="email" aria-describedby="emailHelp" name="cashierEmail" placeholder="Enter Cashier Email" required/>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="inputUsername">Username</label>
                                                            <input class="form-control py-4" id="cashierUsername" type="text" name="cashierUsername" placeholder="Enter Username" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="inputPassword">Password</label>
                                                            <input class="form-control py-4" id="cashierPassword" type="text" name="cashierPassword" placeholder="Enter Password" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-4 mb-0">
                                                    <input type="submit" name="create" class="btn btn-primary btn-block" value="Create Account"/>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="small">
                                                <a href="index.php">Have an account? Go to login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Jeyml Mini Martt 2020</div>
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
    </body>
</html>
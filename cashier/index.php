<?php 
    session_start();
    if(!isset($_SESSION["cashierUsername"])){  
    }
    else{
        header("location:dashboard.php");
    }
    //connection code
    require_once("dbconnection.php");

    if(isset($_POST["login"])){
        if(empty($_POST["cashierUsername"])||empty($_POST["cashierPassword"])){
            $message = '<label>All fields are required</label>';
        }
        else{
            $query = "SELECT * FROM cashiertable WHERE cashierUsername = :cashierUsername AND cashierPassword = :cashierPassword";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    'cashierUsername' => $_POST["cashierUsername"],
                    'cashierPassword' => $_POST["cashierPassword"]
                )
            );
            $count = $statement->rowCount();
            if($count>0){
                $_SESSION["cashierUsername"] = $_POST["cashierUsername"];
                header("location:dashboard.php");
            }
            else{
                // Message for incorrect input data
                echo "<script>alert('Username or Password does not match. Please try again');</script>";
                echo "<script>window.location.href='index.php'</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Meta Data-->
        <meta charset="utf-8">
        <meta name="author" content="Jeremiah Limpin">
        <meta name="keywords" content="Login, Sales Management System, HTML, CSS, PHP PDO">
        <meta name="description" content="This is the index page, or login page. The meta description is an html attribute that provides a brief summary of a webpage. Metadata will not be displayed on the page, but is machine parsable. Google recommends about 155 characters for use in the search results.">
        <!-- For Mobile Devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- For CSS -->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <!-- Favicon -->
        <link rel="icon" href="../img/dhvsu.png" type="image/png" sizes="16x16">
        <title>Cashier Login - Jeyml Mini Mart</title>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <img src="../img/avatar.png" alt="Icon" class="avatar">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Cashier Login</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Username</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" name="cashierUsername" placeholder="Enter username" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" name="cashierPassword" placeholder="Enter password" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" value="1" name="rememberme" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.php">Forgot Password?</a>
                                                <input type="submit" name="login" class="btn btn-primary" value="Login"/>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
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
    </body>
</html>

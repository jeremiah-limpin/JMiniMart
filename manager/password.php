<?php 
    
    //connection code
    require_once("dbconnection.php");

    if(isset($_POST["resetpass"])){
        if(empty($_POST["managerEmail"])){
            $message = '<label>All fields are required</label>';
        }
        else{
            $query = "SELECT * FROM managertable WHERE managerEmail = :managerEmail";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    'managerEmail' => $_POST["managerEmail"]
                )
            );
            $count = $statement->rowCount();
            if($count>0){
                $_SESSION["managerEmail"] = $_POST["managerEmail"];
                echo "<script>alert('Please click the link that has just been sent to your email to verify your account and continue to reset your password.');</script>";
                echo "<script>window.location.href='index.php'</script>";
            }
            else{
                // Message for incorrect input data
                echo "<script>alert('Email does not exist. Please try again');</script>";
                echo "<script>window.location.href='password.php'</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Meta -->
        <meta charset="utf-8">
        <meta name="author" content="Jeremiah Limpin">
        <meta name="keywords" content="Forgot Password, Sales Management System, HTML, CSS, PHP PDO">
        <meta name="description" content="This is the forgot password page.">
        <!-- For Mobile Devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- For CSS -->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <!-- Favicon -->
        <link rel="icon" href="../img/dhvsu.png" type="image/png" sizes="16x16">
        <title>Forgot Password - Jeyml Mini Mart</title>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Enter email address" name="managerEmail" required />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="index.php">Return to login</a>
                                                <div class="form-group mt-4 mb-0">
                                                    <input type="submit" name="resetpass" class="btn btn-primary btn-block" value="Reset Password"/>
                                                </div>
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

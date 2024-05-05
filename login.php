<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- add css -->
    <link rel="stylesheet" href="styles/style.css">
    <title>Share Project</title>
    
</head>
<body>
    <div class="container ">
        <div class="row">
            <div class="col-md-4 text-center d-flex justify-content-center align-items-center">
                <h3>SHARE URL's</h3>
            </div>
            <div class="col-md-8 login-container ">
                <div class="login-form w-75">
                    <h2 class="text-center">Login Form</h2>
                    <div class="row">
                        <?php 
                            if(isset($_GET['error'])){
                                if($_GET['error'] == '1'){
                                    echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    Invalid Username or Password!
                                    </div>';
                                }
                            } else if(isset($_GET['success']) && $_GET['success'] == '1'){
                                echo '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                Registration Successful!
                                </div>';
                            } else if(isset($_GET['success']) && $_GET['success'] == '2'){
                                echo '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                Account Deleted Successfully!
                                </div>';
                            }
                        ?>
                    </div>
                    <form action="database/login.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <button type="submit" name="submit" class="w-100 btn btn-primary">Login</button>
                    </form>
                    <div class="mt-3 d-flex justify-content-end">
                        <p>Not a member? <a href="register.php">Register Now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

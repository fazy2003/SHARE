<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
include 'database/connection.php';
$sql = "SELECT * FROM users WHERE id = " . $_SESSION['id'];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'headers/header.php'; ?>
</head>

<body>
    <?php include 'headers/navbar.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Welcome <?php echo $_SESSION['username']; ?></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Your Profile</h2>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <?php
                    if (isset($_GET['success'])) {
                        echo '<div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Profile updated successfully
                    </div>';
                    }
                    if (isset($_GET['error'])) {
                        echo '<div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Profile update failed
                    </div>';
                    } else if (isset($_GET['error']) && $_GET['error'] == 2) {
                        echo '<div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Passwords do not match
                    </div>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6 offset-md-3">
                <form action="database/update_profile.php" method="post">
                    <input type="text" class="form-control" name="user_id" id="user_id" value="<?php echo $row['id']; ?>" hidden>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $row['first_name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $row['last_name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" disabled>
                    </div>
                    <!-- phone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $row['phone']; ?>">
                    </div>
                    <!-- student id -->
                    <div class="mb-3">
                        <label for="student_id" class="form-label
                        ">Student ID</label>
                        <input type="text" class="form-control" name="student_id" id="student_id" value="<?php echo $row['student_id']; ?>">
                    </div>
                    <!-- password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="<?php echo $row['password']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="<?php echo $row['password']; ?>">
                    </div>

                    <button type="submit" name="submit" class="w-100 btn btn-primary">Update</button>
                </form>
                <!-- delete my account -->
                <div class="mt-3 d-flex justify-content-end">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Delete My Account
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete your account?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="database/delete_profile.php" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
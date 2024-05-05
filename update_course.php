<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

ob_start();
session_start();
if(!isset($_SESSION['id'])){
    header("Location: login.php");
}
include 'database/connection.php';
if(isset($_GET['id'])){
    $course_id = $_GET['id'];
    $sql = "SELECT * FROM courses WHERE id = $course_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'headers/header.php'; ?>
</head>
<body>
    <?php include 'headers/navbar.php'; ?>
    
    <!-- form  -->
    <div class="container mt-4">
        <div class="row">
            <!-- link field -->
            <div class="col-12 col-md-12">
                <form action="database/update_course.php" method="post">
                    <div class="mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input type="text" class="form-control" name="link" id="link" value="<?php echo $row['link'] ?>">
                    </div>
                    <!-- name field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Topic</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['name'] ?>">
                    </div>
                    <!-- hidden field -->
                    <input type="number" class="form-control" name="id" id="id" 
                    value="<?php echo $row['id']; ?>" hidden>
                    <button type="submit" name="submit" class="w-100 btn btn-primary">Update</button>
                </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'headers/header.php'; ?>
</head>

<body>
    <?php include 'headers/navbar.php'; ?>
    <!-- button to upload a course -->

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-12">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Upload Course
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="database/upload_course.php" method="post">
                                    <div class="mb-3">
                                        <label for="link" class="form-label">Link</label>
                                        <input type="text" class="form-control" name="link" id="link">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Topic</label>
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                    <input type="number" class="form-control" name="uploaded_by" id="uploaded_by" 
                                    value="<?php echo $_SESSION['id']; ?>" hidden>
                                    <button type="submit" name="submit" class="w-100 btn btn-primary">Upload</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="row">
            <?php 
                if(isset($_GET['error'])){
                    if($_GET['error'] == '1'){
                        echo '<div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Something went wrong!
                        </div>';
                    }
                } else if(isset($_GET['success']) && $_GET['success'] == '1'){
                    echo '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    Course Uploaded!
                    </div>';
                } else if(isset($_GET['success']) && $_GET['success'] == '2'){
                    echo '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    Course Deleted!
                    </div>';
                } else if(isset($_GET['success']) && $_GET['success'] == '3'){
                    echo '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    Course Updated!
                    </div>';
                }
            ?>
        </div>
    </div>
    <div class="container mt-1">
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Link</th>
                    <th>Topic</th>
                    <th>Uploaded By</th>
                    <th>Uploaded On</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include 'database/connection.php';
                $sql = "SELECT * FROM courses JOIN users ON courses.uploaded_by = users.id ORDER BY courses.id DESC";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td><a href='" . $row['link'] . "'>" . $row['link'] . "</a></td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['first_name'] . ' ' . $row['last_name'] . "</td>";
                    echo "<td>" . $row['uploaded_on'] . "</td>";
                    if($row['uploaded_by'] == $_SESSION['id']){
                        echo "<td><a href='database/delete_course.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>";
                        echo "<td><a href='update_course.php?id=" . $row['id'] . "' class='btn btn-primary'>Update</a></td>";
                    }else{
                        echo "<td></td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>
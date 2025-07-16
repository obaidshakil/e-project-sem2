<?php
include ('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['deleteid'])){
    $deleteid = $_GET['deleteid'];
    $sql = "DELETE FROM users WHERE user_id = '$deleteid'";
    if($isdeleted = mysqli_query($conn, $sql)){
        echo "<script>alert('Data Deleted Successfully');</script>";
        header('location:viewuser.php');
        exit();
    } else {
        echo "<script>alert('Data Not Deleted');</script>";
    }
}
?>
<body>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                <h2 class="text-center mb-0">View User</h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>id</th>
                                                <th>UserName</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Role</th>
                                                <th>Created At</th>
                                                <th>Gender</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $srno = 1;
                                            $sql = "SELECT * FROM users";
                                            $result = mysqli_query($conn, $sql);
                                            while($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $srno++; ?></td>
                                                    <td><?php echo $row['user_id']; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['password']; ?></td>
                                                    <td><?php echo $row['role']; ?></td>
                                                    <td><?php echo $row['created_at']; ?></td>
                                                    <td><?php echo $row['gender']; ?></td>
                                                    <td>
                                                        <a href="edituserform.php?editid=<?php echo $row['user_id']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to edit this Data?')">Edit</a>
                                                        <a href="viewuser.php?deleteid=<?php echo $row['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Data?')">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div> 
                            </div> 
                        </div> 
                    </div>
                </div> 
            </div>
        </div>
    </div>
</body>
<?php
include('inc.footer.php');
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>


</html>
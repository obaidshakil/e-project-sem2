<?php
include('inc.header.php');
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
    $sql = "DELETE FROM categories WHERE category_id = '$deleteid'";
    if($isdeleted = mysqli_query($conn, $sql)){
        echo "<script>alert('Data Deleted Successfully');</script>";
        header('location:categoryview.php');
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
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h2 class="text-center ">View Category</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>id</th>
                                            <th>Artist</th>
                                            <th>Album</th>
                                            <th>Genre</th>
                                            <th>Language</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $srno = 1;
                                        $sql = "SELECT * FROM categories";
                                        $result = mysqli_query($conn, $sql);
                                        while($row=mysqli_fetch_assoc($result)){ ?>
                                            <tr>
                                                <td><?php echo $srno++; ?></td>
                                                <td><?php echo $row['category_id']; ?></td>
                                                <td><?php echo $row['artist']; ?></td>
                                                <td><?php echo $row['album']; ?></td>
                                                <td><?php echo $row['genre']; ?></td>
                                                <td><?php echo $row['language']; ?></td>
                                                <td class="text-right">
                                                    <a href="categoryedit.php?editid=<?php echo $row['category_id']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to edit this Data?')">Edit</a>
                                                    <a href="categoryview.php?deleteid=<?php echo $row['category_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Data?')">Delete</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php
include('inc.footer.php');
?>
</html>

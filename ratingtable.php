  <?php
include ('header.php');
?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['deleteid'])){
    $deleteid = $_GET['deleteid'];
    $sql = "DELETE FROM ratings WHERE rating_id = '$deleteid'";
    if($isdeleted = mysqli_query($conn, $sql)){
        echo "<script>alert('Data Deleted Successfully');</script>";
        header('location:ratingtable.php');
        exit();
    } else {
        echo "<script>alert('Data Not Deleted');</script>";
    }
}
?>
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h2 class="text-center text-white ">View Ratings</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th>Rating_id</th>
                                            <th>User_Id</th>
                                            <th>Content Type</th>
                                            <th>Ratings</th>
                                            <th>Review</th>
                                            <th>Created_At</th>
                                            <th>Content_Id</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $srno = 1;
                                        $sql = "SELECT * FROM  ratings";
                                        $result = mysqli_query($conn, $sql);
                                        while($row=mysqli_fetch_assoc($result)){ ?>
                                            <tr>
                                                <td ><?php echo $srno++; ?></td>
                                                <td><?php echo $row['rating_id']; ?></td>
                                                <td><?php echo $row['user_id']; ?></td>
                                                <td><?php echo $row['content_type']; ?></td>
                                                <td><?php echo $row['rating']; ?></td>
                                                <td><?php echo $row['review']; ?></td>
                                                <td><?php echo $row['created_at']; ?></td>
                                                <td><?php echo $row['content_id']; ?></td>
                                                 <td class="text-right">
                                                    <a href="editrating.php?editid=<?php echo $row['rating_id']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to edit this Data?')">Edit</a>
                                                    <a href="ratingtable.php?deleteid=<?php echo $row['rating_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Data?')">Delete</a>
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
<?php
include 'inc.footer.php';
?>
  <?php
include 'inc.header.php';
?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['deleteid'])){
    $deleteid = $_GET['deleteid'];
    $sql = "DELETE FROM music WHERE music_id = '$deleteid'";
    if($isdeleted = mysqli_query($conn, $sql)){
        echo "<script>alert('Data Deleted Successfully');</script>";
        header('location:musictable.php');
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
                            <h2 class="text-center text-white ">View Category</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th>Music ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Music</th>
                                            <th>Thumbnail</th>
                                            <th>category_id</th>
                                            <th>Status</th>
                                            <th>Created_at</th>
                                            <th>Year</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $srno = 1;
                                        $sql = "SELECT * FROM  music";
                                        $result = mysqli_query($conn, $sql);
                                        while($row=mysqli_fetch_assoc($result)){ ?>
                                            <tr>
                                                <td ><?php echo $srno++; ?></td>
                                                <td><?php echo $row['music_id']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td>
                                                    <audio src="<?php echo $row['file_path']; ?>" controls></audio>
                                                </td>
                                                <td>
                                                    <img src="<?php echo $row['image_path']; ?>" alt="" width="50px" height="50px">
                                                </td>
                                                <td><?php echo $row['category_id']; ?></td>
                                                <td><?php echo $row['is_new']; ?></td>
                                                <td><?php echo $row['created_at']; ?></td>
                                                <td><?php echo $row['year']; ?></td>
                                                <td class="text-right">
                                                    <a href="editmusic.php?editid=<?php echo $row['music_id']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to edit this Data?')">Edit</a>
                                                    <a href="musictable.php?deleteid=<?php echo $row['music_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Data?')">Delete</a>
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
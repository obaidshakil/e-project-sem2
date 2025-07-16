


<?php 
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Add Rating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
$ratingerror = $reviewerror = "";
$rating = $review = $user = $content_type = $music = $musictitle ="";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_btn'])) {
    if (empty($_POST['user'])){ 
        $usererror = ('User is Required');
    } else{
        $user = safe_input($_POST['user']);
    }
    if (empty($_POST['music'])){ 
        $musicerror = ('Music is Required');
    } else{
        $music = safe_input($_POST['music']);
    }
    if (empty($_POST['content_type'])){ 
        $content_typeerror = ('Content Type is Required');
    } else{
        $content_type = safe_input($_POST['content_type']);
    }
    if (empty($_POST['rating'])){ 
        $ratingerror = ('Rating is Required');
    } else{
        $rating = safe_input($_POST['rating']);
        if (!is_numeric($_POST['rating']) || $_POST['rating'] < 1 || $_POST['rating'] > 5) {
            $ratingerror = "Rating must be a number between 1 and 5";
        }
    }
    if (empty($_POST['review'])){ 
        $reviewerror = ('Review is Required');
    } else{
        $review = safe_input($_POST['review']);
    }
    if (empty($ratingerror) && empty($reviewerror) && empty($usererror) && empty($musicerror) && empty($content_typeerror)) {
        $sql = "INSERT INTO ratings (user_id, content_id, content_type, rating, review) VALUES ('$user', '$music', '$content_type', '$rating', '$review')";
        if($isinserted = mysqli_query($conn, $sql)) {
            header('Location: ratingtable.php');
            exit();
        } else {
            echo "<script>alert('Data Not Inserted');</script>";
        }
    }
}
    
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $sql = "SELECT * FROM music";
    $result_music = mysqli_query($conn, $sql);
    $sql = "SELECT * FROM videos";
    $results = mysqli_query($conn, $sql);
?>
<body class="bg-light">

    <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-success text-white text-center">
                            <h1>Give ratings</h1>
                        </div>
                        <div class="card-body card-block">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-horizontal">

    
    <div class="row form-group mb-3">
        <div class="col-md-3">
            <label for="user" class="form-control-label">Select User</label>
        </div>
        <div class="col-md-9">
            <select name="user" id="user" class="form-control">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['user_id']; ?>">
                        <?php echo $row['username']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    
    <div class="row form-group mb-3">
        <div class="col-md-3">
            <label for="music" class="form-control-label">Content Id</label>
        </div>
        <div class="col-md-9">
            <select name="music" id="music" class="form-control">
                <?php while($row = mysqli_fetch_assoc($result_music)) { ?>
                    <option value="<?php echo $row['music_id']?>"><?php echo $row['title']?></option>
                <?php } ?>
                <?php while($row = mysqli_fetch_assoc($results)) { ?>
                    <option value="<?php echo $row['video_id']?>"><?php echo $row['title']?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    
    <div class="row form-group mb-3">
        <div class="col-md-3">
            <label for="content_type" class="form-control-label">Content Type</label>
        </div>
        <div class="col-md-9">
            <select name="content_type" id="content_type" class="form-control">
                <option value="music">Music</option>
                <option value="video">Video</option>
            </select>
        </div>
    </div>

    
    <div class="row form-group mb-3">
        <div class="col-md-3">
            <label for="rating" class="form-control-label">Rating</label>
        </div>
        <div class="col-md-9">
            <input type="number" id="rating" name="rating" min="1" max="5" placeholder="Enter your Rating" class="form-control">
            <span class="text-danger">*<?php echo $ratingerror; ?></span>
        </div>
    </div>


    <div class="row form-group mb-3">
        <div class="col-md-3">
            <label for="review" class="form-control-label">Review</label>
        </div>
        <div class="col-md-9">
            <textarea id="review" name="review" placeholder="Enter your Review" class="form-control"></textarea>
            <span class="text-danger">*<?php echo $reviewerror; ?></span>
        </div>
    </div>

    
    <div class="row form-group">
        <div class="col-md-12 text-end">
            <button type="submit" name="save_btn" class="btn btn-success px-4" onclick="return confirm('Are you sure you want to submit?');">
                Submit
            </button>
        </div>
    </div>

</form>

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

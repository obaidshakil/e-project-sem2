<?php
include ('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
$titleerror = $descriptionerror = $categoryerror = $statuserror = $yearerror = "";
$title = $description = $category_id = $status = $year = "";
if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['editid'])){
    $editid = $_GET['editid'];
    $sql = "SELECT * FROM videos WHERE video_id = '$editid'";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_num_rows($result) > 0){
        $row =mysqli_fetch_assoc($result);
        $title = $row['title'];
        $description = $row ['description'];
        $category_id = $row['category_id'];
        $status = $row['is_new'];
        $year = $row['year'];
    }
    else {
        echo "<script>alert('No Record Found');</script>";
    }
}


$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql); 


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_btn'])){
    $editid = safe_input($_POST['editid']);
    if(empty($_POST['title'])) {
        $titleerror = 'Title is required';
    } else {
        $title = safe_input($_POST['title']);
    }
    if(empty($_POST['description'])) {
        $descriptionerror = 'Description is required';
    } else {
        $description = safe_input($_POST['description']);
    }
    if(empty($_POST['category'])) {
        $categoryerror = 'Category is required';
    } else {
        $category_id = safe_input($_POST['category']);
    }
    if(empty($_POST['status'])) {
        $statuserror = 'Status is required';
    } else {
        $status = safe_input($_POST['status']);
    }
    if(empty($_POST['year'])) {
        $yearerror = 'Year is required';
    } else {
        $year = safe_input($_POST['year']);
    }
        $img= "insert/img/".uniqid().".png";
        if (move_uploaded_file($_FILES["imgfile"]["tmp_name"],$img)) {
            echo  "<script>
                    alert('icon uploaded successfully');
                </script>";
        } else {
            echo "<script>
                alert('icon not uploaded successfully');
            </script>";
        }
         $videoFile = "insert/videos/" . uniqid() . ".mp4";
if (move_uploaded_file($_FILES["video"]["tmp_name"], $videoFile)) {
    echo "<script>
            alert('video uploaded successfully');
          </script>";
} else {
    echo "<script>
            alert('video not uploaded successfully');
          </script>";
}
       
if(empty($titleerror) && empty($descriptionerror) && empty($categoryerror) && empty($statuserror) && empty($yearerror)) {
        $sql = "UPDATE videos SET title='$title', description='$description', category_id='$category_id', is_new='$status', year='$year', image_path='$img', file_path='$videoFile' WHERE video_id='$editid'";

        if($isinserted = mysqli_query($conn, $sql)){
            header('Location: videotable.php');
            exit();
        } else {
            echo "error: " . mysqli_error($conn);
        }
    }
}
?>
 <body class="bg-light">

    <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12 "> 
                    <div class="card">
                        <div class="card-header bg-success text-white text-center">
                            <h2> Edit Video</h2>
                        </div>
                        <div class="card-body card-block">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <input type="hidden" id="editid" name = "editid" value ="<?php echo $editid; ?>">

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="title" class=" form-control-label">Title</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="title" name="title" placeholder="Enter song title" class="form-control" value="<?php echo $title; ?>">
                                        <span class="text-danger">*<?php echo $titleerror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="description" class=" form-control-label">Description</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea id="description" name="description" placeholder="Enter song description" class="form-control"><?php echo $description; ?></textarea>
                                        <span class="text-danger">*<?php echo $descriptionerror; ?></span>
                                    </div>
                                </div>
                                 <div class="row form-group">
                                 <div class="col col-md-3">
                                 <label for="imgfile" class="form-control-label">Thumbnail</label>
                                 </div>
                                  <div class="col-12 col-md-9">
                                   <input type="file" id="imgfile" name="imgfile" class="form-control-file">
                                    <img  id="imgid" width="100" alt="" class="mt-2">
                                 </div>
                                 </div>
                                
                               <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="audiofile" class="form-control-label text-dark">Video</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="audiofile" name="video" class="form-control-file" accept="video/*">
                                        <video controls id="videoPreview" class="mt-2" style="display: none;"></video>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="category" class=" form-control-label">Category</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select id="category" name="category" class="form-control">
                                            <option value="">Select Category</option>
                                            <?php
                                            while($row = mysqli_fetch_assoc($result)){ ?>
                                                <option value="<?php echo $row['category_id']; ?>" <?php if ($row['category_id'] == $category_id) echo 'selected'; ?>><?php echo $row['artist']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger">*<?php echo $categoryerror; ?></span>
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="status" class=" form-control-label">Status</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select id="status" name="status" class="form-control">
                                            <option value="new" <?php if ($status == 'new') echo 'selected'; ?>>New</option>
                                            <option value="old" <?php if ($status == 'old') echo 'selected'; ?>>Old</option>
                                        </select>
                                        <span class="text-danger">*<?php echo $statuserror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="year" class=" form-control-label">Year</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="year" name="year" placeholder="Enter song year" class="form-control" value="<?php echo $year; ?>">
                                        <span class="text-danger">*<?php echo $yearerror; ?></span>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="save_btn" class="btn btn-success px-4" onclick="return confirm('Are you sure you want to submit?');">Submit</button>
                                </div>

                            </form>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div>  
    </div> 
</div> 
<script type="text/javascript">
    document.getElementById('imgfile').onchange = function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                document.getElementById('imgid').src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        }

        // Not supported
        else {
            // fallback -- perhaps submit the input to an iframe and temporarily store
            // them on the server until the user's session ends.
        }
    }
    document.getElementById('audiofile').onchange = evt => {
    const [file] = evt.target.files
    if (file) {
        const preview = document.getElementById('audioPreview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
}
</script>

    
</body>
<?php
include 'inc.footer.php';
?>
</html>
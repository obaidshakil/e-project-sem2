<?php
include 'inc.header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql); 

$titleerror = $descriptionerror = $categoryerror = $statuserror = $yearerror = "";
$title = $description = $category_id = $status = $year = "";
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_btn'])){
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
    if(empty($_POST['category_id'])) {
        $categoryerror = 'Category is required';
    } else {
        $category_id = safe_input($_POST['category_id']);
    }
    if(empty($_POST['Status'])) {
        $statuserror = 'Status is required';
    } else {
        $status = safe_input($_POST['Status']);
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
        
        $audiofile= "insert/audio/".uniqid().".mp3";
        if (move_uploaded_file($_FILES["audiofile"]["tmp_name"],$audiofile)) {
            echo  "<script>
                    alert('audio uploaded successfully');
                </script>";
        } else {
            echo "<script>
                alert('audio not uploaded successfully');
            </script>";
        }
if(empty($titleerror) && empty($descriptionerror) && empty($categoryerror) && empty($statuserror) && empty($yearerror)) {
        $sql = "INSERT INTO music (title, description, category_id, is_new, year, image_path, file_path) VALUES ('$title', '$description', '$category_id', '$status', '$year', '$img', '$audiofile')";
        
        if($isinserted = mysqli_query($conn, $sql)){
            header('Location: musictable.php');
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
                            <h2>Add Music</h2>
                        </div>
                        <div class="card-body card-block">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="title" class=" form-control-label text-dark">Title</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="title" name="title" placeholder="Enter song title" class="form-control">
                                        <span class="text-danger">*<?php echo $titleerror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="description" class=" form-control-label text-dark">Description</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea id="description" name="description" placeholder="Enter song description" class="form-control"></textarea>
                                        <span class="text-danger">*<?php echo $descriptionerror; ?></span>
                                    </div>
                                </div>

                                
                                <div class="row form-group">
                                 <div class="col col-md-3">
                                 <label for="imgfile" class="form-control-label text-dark">Thumbnail</label>
                                 </div>
                                  <div class="col-12 col-md-9">
                                   <input type="file" id="imgfile" name="imgfile" class="form-control-file">
                                    <img  id="imgid" width="100" alt="" class="mt-2">
                                 </div>
                                 </div>
                                
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="audiofile" class="form-control-label text-dark">Music File</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="audiofile" name="audiofile" class="form-control-file" accept="audio/*">
                                        <audio controls id="audioPreview" class="mt-2" style="display:none;"></audio>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="category_id" class=" form-control-label text-dark">Category</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="category_id" id="category_id" class="form-control">
                                            <?php while ($row = mysqli_fetch_assoc($result)){ ?>
                                                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['artist']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger">*<?php echo $categoryerror; ?></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="Status" class=" form-control-label text-dark">Status</label>
                                    </div>
                                 <div class="col-12 col-md-9">
                                        <select name="Status" id="status" class="form-control">
                                            <option value="new">New</option>
                                            <option value="old">Old</option>
                                        </select>
                                        <span class="text-danger">*<?php echo $statuserror; ?></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="year" class=" form-control-label text-dark">Year</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="year" name="year" placeholder="Enter release year" class="form-control">
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
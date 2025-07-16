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
$artisterror = $albumerror = $genreerror = $languageerror = "";
$artist = $album = $genre = $language = "";
if(isset($_GET['editid'])){
    $editid = $_GET['editid'];
    $sql = "SELECT * FROM categories WHERE category_id = '$editid'";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        $artist = $row['artist'];
        $album = $row['album'];
        $genre = $row['genre'];
        $language = $row['language'];
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_btn'])){
    $editid = $_POST['editid'];
    if(empty($_POST['artist'])) {
        $artisterror = 'Artist is required';
    } else {
        $artist = safe_input($_POST['artist']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['artist'])) {
            $artisterror = "Only letters and white space allowed";
        }
        
    }
    if(empty($_POST['album'])) {
        $albumerror = 'Album  name is required';
    } else {
        $album = safe_input($_POST['album']);
        
    }
    if(empty($_POST['genre'])) {
        $genreerror = 'Genre is required';
    } else {
        $genre = safe_input($_POST['genre']);
        
    }
    $genre = safe_input($_POST['genre']);
    $language = safe_input($_POST['language']);


       if(empty($artisterror) && empty($albumerror) && empty($genreerror) && empty($languageerror)) {
           $sql = "UPDATE categories SET artist='$artist', album='$album', genre='$genre', language='$language' WHERE category_id='$editid'";
           if($isinserted = mysqli_query($conn, $sql)){
               header('Location: categoryview.php');
               exit();
           } else {
               echo "<script>alert('Data Not Inserted');</script>";
           }
       }    
}
?>
<body>
    <body class="bg-light">

   <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-header bg-success text-white text-center">
                            <h2>Edit Category</h2>
                        </div>
                        <div class="card-body card-block">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-horizontal">
                                <input type="hidden" name="editid" value="<?php echo $editid; ?>">

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="artist" class="form-control-label">Artist</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="artist" name="artist" placeholder="Enter artist name" class="form-control" value="<?php echo $artist; ?>">
                                        <span class="text-danger">*<?php echo $artisterror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="album" class="form-control-label">Album</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="album" name="album" placeholder="Enter your Album" class="form-control" value="<?php echo $album; ?>">
                                        <span class="text-danger">*<?php echo $albumerror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="genre" class="form-control-label">Genre</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="genre" id="genre" class="form-control">
                                            <option value="pop"<?php if($genre == "pop") echo ' selected'; ?>>Pop</option>
                                            <option value="rock"<?php if($genre == "rock") echo ' selected'; ?>>Rock</option>
                                            <option value="jazz"<?php if($genre == "jazz") echo ' selected'; ?>>Jazz</option>
                                            <option value="classical"<?php if($genre == "classical") echo ' selected'; ?>>Classical</option>
                                            <option value="hip-hop"<?php if($genre == "hip-hop") echo ' selected'; ?>>Hip-Hop</option>
                                            <option value="soul"<?php if($genre == "soul") echo ' selected'; ?>>Soul</option>
                                            <option value="country"<?php if($genre == "country") echo ' selected'; ?>>Country</option>
                                            <option value="fusion"<?php if($genre == "fusion") echo ' selected'; ?>>Fusion</option>
                                            <option value="romantic"<?php if($genre == "romantic") echo ' selected'; ?>>Romantic</option>
                                        </select>
                                        <span class="text-danger">*<?php echo $genreerror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="language" class="form-control-label">Language</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="language" id="language" class="form-control">
                                            <option value="English"<?php if($language == "English") echo ' selected'; ?>>English</option>
                                            <option value="Regional"<?php if($language == "Regional") echo ' selected'; ?>>Regional</option>
                                        </select>
                                        <span class="text-danger">*<?php echo $languageerror; ?></span>
                                    </div>
                                </div>

                                <div class="card-footer text-end">
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
<?php
include('inc.footer.php');
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
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
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_btn'])){
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
           $sql = "INSERT INTO categories (artist, album, genre, language) VALUES ('$artist', '$album', '$genre', '$language')";
           if($isinserted = mysqli_query($conn, $sql)){
               header('Location: viewcategory.php');
               exit();
           } else {
               echo "<script>alert('Data Not Inserted');</script>";
           }
       }    
}
?>
    <body class="bg-light">

    <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8 mx-auto"> 
                    <div class="card">
                        <div class="card-header bg-success text-white text-center">
                            <h2>Create Category</h2>
                        </div>
                        <div class="card-body card-block">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-horizontal">

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="artist" class=" form-control-label">Artist</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="artist" name="artist" placeholder="Enter artist name" class="form-control">
                                        <span class="text-danger">*<?php echo $artisterror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="album" class=" form-control-label">Album</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="album" name="album" placeholder="Enter your Album" class="form-control">
                                        <span class="text-danger">*<?php echo $albumerror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="genre" class=" form-control-label">Genre</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="genre" id="genre" class="form-control">
                                            <option value="pop">Pop</option>
                                            <option value="rock">Rock</option>
                                            <option value="jazz">Jazz</option>
                                            <option value="classical">Classical</option>
                                            <option value="hip-hop">Hip-Hop</option>
                                            <option value="soul">Soul</option>
                                            <option value="country">Country</option>
                                            <option value="fusion">Fusion</option>
                                            <option value="romantic">Romantic</option>
                                        </select>
                                        <span class="text-danger">*<?php echo $genreerror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="language" class=" form-control-label">Language</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="language" id="language" class="form-control">
                                            <option value="English">English</option>
                                            <option value="Regional">Regional</option>
                                        </select>
                                        <span class="text-danger">*<?php echo $languageerror; ?></span>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php include('inc.footer.php'); ?>
</html>
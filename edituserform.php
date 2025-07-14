<?php 
include('inc.header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
$username = $email = $password = $role = $usernameerror = $emailerror = $passworderror = $roleerror = $gender = $gendererror = "";
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['editid'])){
    $editid = $_GET['editid'];
    $sql = "SELECT * FROM users WHERE user_id = '$editid'";
    $result = mysqli_query($conn, $sql);
    
    if($row = mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
        $role = $row['role'];
        $gender = $row['gender'];
    }

}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_btn'])) {
    $editid = $_POST['editid'];
    if (empty($_POST['username'])){
        $usernameerror=('UserName is Required');
    } else{
        $username = safe_input($_POST['username']);
         if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['username'])) {
            $usernameerror = "Only letters and white space allowed";
        }
    }
    
    if (empty($_POST['email'])){
        $emailerror=('Email is Required');
    } else{
        $email = safe_input($_POST['email']);
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailerror = "Invalid email format";
        }
    }
    if (empty($_POST['password'])){
        $passworderror=('Password is Required');
    } else{
        $password = safe_input($_POST['password']);
        if (strlen($_POST['password']) < 3) {
            $passworderror = "Password must be at least 3 characters long";
        }
    }
    if (empty($_POST['role'])){
        $roleerror=('Role is Required');
    } else{
        $role = safe_input($_POST['role']);
        
    }
    if (empty($_POST['gender'])){
        $gendererror=('Gender is Required');
    } else{
        $gender = safe_input($_POST['gender']);
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    if (empty($usernameerror) && empty($emailerror) && empty($passworderror) && empty($roleerror)) {
    
    $sql = "UPDATE users SET username='$username', email='$email', password='$password', role='$role',gender='$gender' WHERE user_id = '$editid'";
    if($isupdate = mysqli_query($conn, $sql)) {
        header('Location: viewuser.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
    }
?>
<body class="bg-light">

   <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h2 class="text-center mb-0">Edit User Account</h2>
                        </div>
                        <div class="card-body card-block">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-horizontal">
                                <input type="hidden" name="editid" value="<?php echo $editid; ?>">

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="name" class="form-control-label">Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="name" name="username" placeholder="Enter your name" class="form-control" value="<?php echo $username; ?>">
                                        <span class="text-danger">*<?php echo $usernameerror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="email" class="form-control-label">Email</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="email" id="email" name="email" placeholder="Enter your Email" class="form-control" value="<?php echo $email; ?>">
                                        <span class="text-danger">*<?php echo $emailerror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="password" class="form-control-label">Password</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="password" id="password" name="password" placeholder="Enter your Password" class="form-control">
                                        <span class="text-danger">*<?php echo $passworderror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="role" class="form-control-label">Role</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="role" id="role" class="form-control">
                                            <option value="user" <?php if($role=='user') echo 'selected'; ?>>User</option>
                                        </select>
                                        <span class="text-danger">*<?php echo $roleerror; ?></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class="form-control-label">Gender</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <div class="form-check-inline form-check">
                                            <label for="gender_male" class="form-check-label">
                                                <input type="radio" id="gender_male" name="gender" value="Male" class="form-check-input" <?php if($gender=='Male') echo 'checked'; ?>>Male
                                            </label>
                                            <label for="gender_female" class="form-check-label ms-3">
                                                <input type="radio" id="gender_female" name="gender" value="Female" class="form-check-input" <?php if($gender=='Female') echo 'checked'; ?>>Female
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <button type="submit" name="save_btn" class="btn btn-success px-4">Submit</button>
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

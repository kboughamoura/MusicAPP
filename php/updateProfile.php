<?php


include('connexion.php');


if (isset($_POST["submit"])) {
    $fullname = mysqli_real_escape_string($con, $_POST["fullname"]);
    $password = mysqli_real_escape_string($con, md5($_POST["password"]));
    $cpassword = mysqli_real_escape_string($con, md5($_POST["cpassword"]));

    if ($password === $cpassword) {
        $image_name = $_FILES["image"]["name"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $image_size = $_FILES["image"]["size"];
        $image_new_name = rand() . $image_name;

        if ($image_size > 5242880) {
            echo "<script>alert('Photo is very big. Maximum photo uploading size is 5MB.');</script>";
        } else {
            $sql = "UPDATE users SET fullname='$full_name', password='$password', image='$image_new_name' WHERE userid='{$_COOKIE["userid"]}'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "<script>alert('Profile Updated successfully.');</script>";
                move_uploaded_file($image_tmp_name, "uploads/" . $photo_new_name);
            } else {
                echo "<script>alert('Profile can not Updated.');</script>";
                echo  $con->error;
            }
        }
    } else {
        echo "<script>alert('Password not matched. Please try again.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../style_update_profile.css">
    <title>Profile Page - Pure Coding</title>
</head>
<body class="profile-page">
    <div class="wrapper">
        <h2>Profile</h2>
        <form action="" method="post" enctype="multipart/form-data">
        <?php 
            $c=(string)$_COOKIE['userid'];
            $sql = "SELECT * FROM users WHERE userid=?";
            $stm=$con->prepare($sql);
            $stm->bind_param("s",$c);           
            $stm->execute();        
            $result =$stm->get_result();
            while ($row = $result->fetch_assoc()) {
                
            ?>
            <div class="inputBox">
                <input type="text" id="full_name" name="fullname" placeholder="Full Name" value="<?php echo $row['fullname']; ?>" required>
            </div>
            <div class="inputBox">
                <input type="email" id="email" name="email" placeholder="Email Address" value="<?php echo $row['email']; ?>" disabled required>
            </div>
            <div class="inputBox">
                <input type="password" id="password" name="password" placeholder="Password" value="<?php echo $row['password']; ?>" required>
            </div>
            <div class="inputBox">
                <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" value="<?php  echo $row['password']; ?>" required>
            </div>
            <div class="inputBox">
                <label for="image">Image</label>
                <input type="file" accept="image/*" id="image" name="image" required>
            </div>
            <img src="uploads/" width="150px" height="auto" alt="">
            <?php
                }
            

            ?>
            <div>
                <button type="submit" name="submit" class="btn">Update Profile</button>
            </div>
        </form>
    </div>
</body>
</html>

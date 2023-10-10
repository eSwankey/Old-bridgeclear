<?php

include 'config.php';

if(isset($_POST["submit"])){

    $name = mysqli_real_escape_string($conn,$_POST["name"]);
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,md5($_POST["password"]));
    $confirm_password = mysqli_real_escape_string($conn,md5($_POST["confirm_password"]));

    $select = mysqli_query($conn,"SELECT * FROM `user_form` WHERE email = '$email' AND 
    password = '$password'") or die("Query failed");
    
    if(mysqli_num_rows($select) > 0){
        $message[] = "User already exists!";
    }else{
        mysqli_query($conn,"INSERT INTO `user_form` (name,email,password) VALUES('$name',
        '$email','$password')") or die("Query failed");
        $message[] = "User registered successfully!";
        header("location:login.php");
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>

<?php

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
    }
}
?>
<div class="box">
    <form action="" method="post">
        <h1>Register</h1>
        <div class="inputBox">
            <input type="text" name="name" required>
            <span>Username</span>
            <i></i>
        </div>
        <div class="inputBox">
            <input type="email" name="email" required>
            <span>Email</span>
            <i></i>
        </div>
        <div class="inputBox">
            <input type="password" name="password" required>
            <span>Enter Password</span>
            <i></i>
        </div>
        <div class="inputBox">
            <input type="password" name="confirm_password" required>
            <span>Confirm Password</span>
            <i></i>
        </div>
        <input type="submit" name="submit" value="register now" class="btn">
        <div class="links">
            <p>Already have an account? <a href="login.php">Login now</a></p>
        </div>
    </form>
</div>

</body>
</html>

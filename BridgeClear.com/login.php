<?php

include 'config.php';
session_start();

if(isset($_POST["submit"])){

    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,md5($_POST["password"]));

    $select = mysqli_query($conn,"SELECT * FROM `user_form` WHERE email = '$email' AND 
    password = '$password'") or die("Query failed");
    
    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        header("location: vehicle_info.php");
    }else{
        $message[] = "incorrect password or email!";

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
    <title>Login</title>
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
            <h1>Login</h1>
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
            <input type="submit" name="submit" value="login now" class="btn">
            <div class="links">
                <p>Don't have an account? <a href="register.php">Register now</a></p>
            </div>
        </form>
    </div>

</body>
</html>

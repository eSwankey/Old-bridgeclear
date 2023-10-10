<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BridgeClear</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://kit.fontawesome.com/cf74ac77e7.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="wrapper">
    <span class="icon-close">
        <i class="fa-solid fa-xmark"></i>
    </span>
    <div class="form-box login">
        <h2>Login</h2>
        <?php if ($is_invalid): ?>
            <em>Invalid login</em>
        <?php endif; ?>
        <form method="post">
            <div class="input-box">
                <span class="icon">
                    <i class="fa-solid fa-envelope"></i>
                </span>
                <input type="email" required name="email" id="email"
                        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                <label>Email</label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <i class="fa-solid fa-lock"></i>
                </span>
                <input type="password" required name="password" id="password">
                <label>Password</label>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Log in</button>
            <div class="login-signup">
                <span>Don't have an account?</span>
                <a href="signup.html" class="signup-link">Sign up</a>
            </div>
        </form>               
    </div>
</div>
</body>
</html>
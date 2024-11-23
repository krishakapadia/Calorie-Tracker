<?php
session_start();

include 'config.php';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $select = mysqli_query($connection, "SELECT * FROM `user` WHERE email='$email' AND password='$password'") or die('Query failed');

    if (mysqli_num_rows($select) == 1) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['username'];
        $_SESSION['email_id'] = $row['email'];
        $_SESSION['id'] = $row['user_id'];

        if (isset($_POST['remember'])) {
            setcookie('email', $email, time() + (86400 * 30), "/"); 
            setcookie('password', $password, time() + (86400 * 30), "/"); 
        } else {
    
            setcookie('email', '', time() - 3600, "/");
            setcookie('password', '', time() - 3600, "/");
        }

        header('Location: Hcalorie_tracker.php');
        exit();
    } else {
        $message = 'Incorrect email or password';
    }
}

$email_cookie = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';
$password_cookie = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="top.css">
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="header">
        <div class="header-div">
            <div class="header-logo">
                <img class="logo" src="calories.png" alt="Calorie Tracker Logo">
            </div>
            <div class="header-options">
                <a class="home" href="Home page.html">HOME</a>
                <a class="login" href="#">LOGIN</a>
                <a class="register" href="1REGISTER.php">REGISTER</a>
                <a class="contact-us" href="contactus.html">CONTACT US</a>
            </div>
            <div class="profile">
                <button id="profile-button">
                    <img class="profile-image" src="user.png" alt="User Profile">
                </button>
            </div>
        </div>
    </div>

    <div class="login-box-container">
        <div class="login-container">
            <div class="login-box">
                <p class="login-text">LOGIN</p>
                <form class="email-pass" method="post" action="#">
                    <?php
                    if (isset($message)) {
                        echo '<div class="message">' . $message . '</div>';
                    }
                    ?>
                    <input type="email" id="email" name="email" placeholder="Email" required value="<?php echo htmlspecialchars($email_cookie); ?>">
                    <input type="password" id="password" name="password" placeholder="Password" required value="<?php echo htmlspecialchars($password_cookie); ?>">
                    <div style="margin-bottom: 15px;">
                        <input type="checkbox" id="remember" name="remember" <?php echo isset($_POST['remember']) ? 'checked' : ''; ?>>
                        <label for="remember" style="font-size: small;">Remember Me</label>
                    </div>
                    <button type="submit" name="login" id="login-button">LOGIN</button>
                </form>
            </div>
        </div>
    </div>

    <div class="footer-container">
        <div class="footer-links">
        </div>
        <div class="copyright-credit">
            <p>&copy; 2024</p>
        </div>
    </div>
</body>
</html>

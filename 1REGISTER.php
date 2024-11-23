<?php
include 'config.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $age = mysqli_real_escape_string($connection, $_POST['age']);
    $height = mysqli_real_escape_string($connection, $_POST['height']);
    $weight = mysqli_real_escape_string($connection, $_POST['weight']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);

    if (empty($username) || empty($email) || empty($age) || empty($height) || empty($weight) || empty($password) || empty($confirm_password)) {
        $message[] = 'All fields are required';
    } 
    
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Invalid email format';
    } 
    
    elseif ($password !== $confirm_password) {
        $message[] = 'Passwords do not match';
    } 
    
    elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        $message[] = 'Password must contain at least 8 characters, including uppercase, lowercase, number, and special character';
    } 
    
    elseif (!is_numeric($age) || $age < 0 || $age > 120) {
        $message[] = 'Invalid age';
    } 
    elseif (!is_numeric($height) || $height <= 0 || $height > 250) {
        $message[] = 'Invalid height';
    } 
    elseif (!is_numeric($weight) || $weight <= 0 || $weight > 500) {
        $message[] = 'Invalid weight';
    } 
    else {
      
        $select = mysqli_query($connection, "SELECT * FROM `user` WHERE email='$email'") or die(mysqli_error($connection));

        if (mysqli_num_rows($select) > 0) {
            $message[] = 'User already exists';
        } else {
            $insert = mysqli_query($connection, "INSERT INTO `user` (`username`, `password`, `email`, `height`, `weight`, `gender`, `age`) VALUES ('$username', '$password', '$email', '$height', '$weight', '$gender', '$age')") or die(mysqli_error($connection));

            if ($insert) {
                $message[] = 'Registered successfully';
                header("Location: login.php");
                exit;
            } else {
                $message[] = 'Failed to register';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="top.css">
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="bottom.css">
    <link rel="stylesheet" href="register.css">
</head>
<body>
<div class="header">
    <div class="header-div">
        <div class="header-logo">
            <img class="logo" src="calories.png" alt="Calorie Tracker Logo">
        </div>
        
        <div class="header-options">
            <a class="home" href="Home page.html">HOME</a>
            <a class="login" href="login.php">LOGIN</a>
            <a class="contact-us" href="contactus.html">CONTACT US</a>
            <!-- <a class="calories" href="login.php">CALORIES</a> -->
        </div>

        <div class="profile">
            <button id="profile-button">
                <img class="profile-image" src="user.png" alt="User Profile">
            </button>
        </div>     
    </div>   
</div>  

<div class="register-box-container">
    <div class="register-container">
        <div class="box-container">
            <p class="register-text">REGISTER</p>

            <form class="email-pass" method="post" action="1REGISTER.php" enctype="multipart/form-data">

            <?php
                if (isset($message)) {
                    foreach ($message as $already) {
                        echo '<div class="message">' . $already . '</div>';
                    }
                }
            ?>

            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="email" id="email" name="email" placeholder="Email id" required oninvalid="this.setCustomValidity('enter valid email id')" oninput="this.setCustomValidity('')">
            <input type="number" id="height" name="height" placeholder="Height in cm" required>
            <input type="number" id="age" name="age" placeholder="Age" required>
            <input type="number" id="weight" name="weight" placeholder="Weight in kg" required>
            <select id="gender" name="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <p style="font-size: 0.9em; color: #666; margin-top: 5px;">
    Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, one number, and one special character.
</p>
            <input type="password" id="password" name="password" placeholder="Password" required minlength="8" oninvalid="this.setCustomValidity('min 8 characters')" oninput="this.setCustomValidity('')">

<input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required oninput="check()">

            <button type="submit" name="register" id="register-button">REGISTER</button>
            </form>
        </div>
    </div>
</div>

<div class="footer-container">
    <div class="footer-links">
        <!-- <a id="about-us" href="Home page.html">HOME</a>
        <a id="features" href="login.php">CALORIES</a> -->
        <!-- <a id="sdgs" href="login.php">LOG IN</a>
        <a id="contact-us" href="contactus.html">CONTACT US</a> --> 
    </div>
    <div class="copyright-credit">
        <p>&copy; 2024</p>
    </div>
</div>  

<script>
function check() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!password.match(passwordPattern)) {
        document.getElementById('password').setCustomValidity("Password must contain at least 8 characters, including uppercase, lowercase, number, and special character.");
    } else {
        document.getElementById('password').setCustomValidity("");
    }

  
    if (password !== confirmPassword) {
        document.getElementById('confirm-password').setCustomValidity("Passwords must match");
    } else {
        document.getElementById('confirm-password').setCustomValidity("");
    }
}


document.getElementById('age').addEventListener('input', function() {
    const age = parseInt(this.value);
    if (isNaN(age) || age <= 0 || age > 120) {
        this.setCustomValidity("Please enter a valid age between 1 and 120.");
    } else {
        this.setCustomValidity("");
    }
});

document.getElementById('height').addEventListener('input', function() {
    const height = parseInt(this.value);
    if (isNaN(height) || height <= 0 || height > 250) {
        this.setCustomValidity("Please enter a valid height in cm (1-250).");
    } else {
        this.setCustomValidity("");
    }
});

document.getElementById('weight').addEventListener('input', function() {
    const weight = parseInt(this.value);
    if (isNaN(weight) || weight <= 0 || weight > 500) {
        this.setCustomValidity("Please enter a valid weight in kg (1-500).");
    } else {
        this.setCustomValidity("");
    }
});
</script>


</body>
</html>

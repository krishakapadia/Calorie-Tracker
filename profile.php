<?php
    include 'config.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); 
        exit();
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
    <title>PROFILE</title>
    <link rel="stylesheet" href="top.css">
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="bottom.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="profile.css">
</head>
<body>
  
<div class="header">
    <div class="header-div">
      <div class="header-logo">
          <img class="logo" src="calories.png" alt="Logo">
      </div>
      
      <div class="header-options">
          <a class="home" href="Home page.html">HOME</a>
          <a class="contact-us" href="contactus.html">CONTACT US</a>
          <a class="calories" href="Hcalorie_tracker.php">CALORIES</a>
      </div>

      <div class="profile">
          <button type="button" id="profile-button" onclick="window.location.href='profile.php'">
              <img class="profile-image" src="user.png" alt="User Profile">
          </button>
      </div>     
    </div>   
</div>  

<div class="login-box-container">
    <div class="login-container">
        <div class="logout-box">
         
            <p class="login-text">PROFILE</p>

            <?php
              
                echo 
                "<div class='name1'>NAME:</div>
                <div class='namedisplay'>" 
                    . $_SESSION['user_id'] . 
                "</div>";

                echo 
                "<div class='email1'>EMAIL:</div>
                <div class='emaildisplay'>" 
                    . $_SESSION['email_id'] . 
                "</div>";
            ?>

            <form class="email-pass" action="#">
            </form>

        
            <button type="button" id="logout-button" onclick="window.location.href='logout.php'">
                LOGOUT
            </button>
        </div>
    </div>
</div>

<div class="footer-container">
    <div class="footer-links">
        <a id="about-us" href="Home page.html">HOME</a>
        <a id="features" href="Hcalorie_tracker.php">CALORIES</a>
        <a id="contact-us" href="contactus.html">CONTACT US</a>
    </div>
    <div class="copyright-credit">
        <p>&copy; 2024</p>
    </div>
</div>

</body>
</html>

<?php
    include 'config.php';
    session_start();
    $id=$_SESSION['id'];
    $info=mysqli_query($connection,"SELECT * FROM `track` WHERE user_id='$id'") or die('query failed');
    $totalcal=mysqli_query($connection,"SELECT SUM(calories) AS caloriessum FROM `track` WHERE user_id='$id'")or die('query failed');
    $row1=mysqli_fetch_assoc($totalcal);
    $_SESSION['totalcalories']=$row1['caloriessum'];

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAILS</title>
    <link rel="stylesheet" href="top.css">
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="bottom.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="details.css">

</head>
<body>
  
<div class="header">
    <div class="header-div">
      <div class="header-logo">
          <img class="logo" src="calories.png">
      </div>
      
      <div class="header-options">
          <a class="home" href="Home page.html">HOME</a>
          <!-- <a class="login" href="#">LOGIN</a> -->
          <!-- <a class="register" href="#">REGISTER</a> -->
          <a class="contact-us" href="contactus.html">CONTACT US</a>
          <a class="calories" href="Hcalorie_tracker.php">CALORIES</a>
      </div>
      <div class="profile">
          <button type="button" id="profile-button" onclick="window.location.href='profile.php'">
              <img class="profile-image"src="user.png">
          </button>
      </div>     
    </div>   
  </div>  



  <div class="login-box-container">
    <div class="login-container">
        <div class="logout-box">
            <p class="login-text"> CALORIE PROFILE</p>
            <?php
            echo 
            "<div class='name1'>NAME:</div>
            <div class='namedisplay'>" 
                
                .$_SESSION['user_id']. 
            "</div>";
            ?>

            <div class="forscroll">
                <?php
                if($info) {
                    while ($row2 = mysqli_fetch_assoc($info)) {
                        $column1Value = $row2['meal']; 
                        $column2Value = $row2['calories']; 
                        
                        echo "<div class='details_container'>
                                <div class='meal'>
                                    <p>MEAL:</p>
                                    <div class='mealdisplay'>" . $column1Value . "</div>
                                </div>
                                <div class='calorie'>
                                    <p>calorie:</p>
                                    <div class='caloriedisplay'>" . $column2Value . "</div>
                                </div>
                              </div>";
                    }  
                } else {
                   
                    echo "Query failed: " . mysqli_error($connection);
                }
                ?>
            </div>
            <form class="email-pass"  action="#">
                
              </form>          
        </div>

    </div>


  </div>

  <div class="footer-container">
    <div class=footer-links>
      <a id="about-us" href="Home page.html">HOME</a>
      <a id="features" href="Hcalorie_tracker.php">CALORIES</a>
      <!-- <a id="sdgs" href="#">REGISTER</a> -->
      <a id="contact-us" href="contactus.html">CONTACT US</a>
      
    </div>
    <div class="copyright-credit">
      <p>&copy; 2024</p>

    </div>
  

  </div>    
</body>
</html>      
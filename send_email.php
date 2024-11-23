<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $feedback = htmlspecialchars($_POST['feedback']);
    $name = htmlspecialchars($_POST['name']);  
    $email = htmlspecialchars($_POST['email']); 

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                 
        $mail->Username   = 'krishakapadia2204@gmail.com';      
        $mail->Password   = 'cbnqiicjuuwnjulb';                   
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      
        $mail->Port       = 587;                                  

        $mail->setFrom('krishakapadia2204@gmail.com', 'Calorie Tracker Feedback'); 
        $mail->addAddress('krisha.kapadia@somaiya.edu');        

        $mail->isHTML(false);                                    
        $mail->Subject = "NEW FEEDBACK";
        
        
        $mail->Body    = "Feedback received from:\n\nName: $name\nEmail: $email\n\nFeedback:\n$feedback\n";

        $mail->send();
        echo "Feedback sent successfully!";
    } catch (Exception $e) {
        echo "Failed to send feedback. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

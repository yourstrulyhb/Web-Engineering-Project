<?php

// Connect to database
include 'DBConnector.php';

$name = $email = $message = NULL;

if (isset($_POST['message']) and isset($_POST['email'])) {

   $message = $_POST['message'];
   $email = $_POST['email'];
   $name = $_POST['name'];

   if (!isset($_POST['name'])) {
      $name = "Anonymous";  
   }

   $feedbacksQuery = "INSERT INTO `feedbacks`(`email`, `name`, `message`, `sendDate`) VALUES ('$email','$name','$message', DEFAULT);";
   $feedbacksRes = $conn->query($feedbacksQuery);

}
?>

<div class="contact-form">
   <h2>Contact Me</h2>
   <form name="contactForm" action="#" method="post">
      <div>
         <input type="text" name="name" class="text-input" id="sender-name" placeholder="Name">
         <input type="email" name="email" class="text-input" id="sender-email" required placeholder="E-mail address">

         <button type="submit" class="btn" id="submit-contact-form">
            <i class="fas fa-envelope"></i>
            Send
         </button>
      </div>

      <textarea rows="7" name="message" class=" text-input" id="sender-message" required placeholder="Message"></textarea>
   </form>
</div>
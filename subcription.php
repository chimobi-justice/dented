<?php

   error_reporting(E_ALL ^ E_NOTICE);
   include('./config/db_connect.php');

   $email = '';
   $res = ['message' => ''];

   if (isset($_POST['sendNewsLetter'])) {
      if (empty($_POST['email'])) {
         $res['message'] = 'Email can\'t be blank';
      } else {
         $email = $_POST['email'];

         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $res['message'] = 'Please Enter A Valid Email Address';
         }
      } 

      if (!array_filter($res)) {
         $email = mysqli_real_escape_string($conn, $_POST['email']);

         $sql = "SELECT newsletter_emailaddress FROM newsletter WHERE newsletter_emailaddress = '$email'";
         $check_newsletter_email_result = mysqli_query($conn, $sql);
         $check_user_email_result = mysqli_num_rows($check_newsletter_email_result);

         if ($check_user_email_result > 0) {
            $res['message'] = 'Email Already Exit';
         } else {
            $sql = "INSERT INTO newsletter(newsletter_emailaddress) VALUE('$email')";
            $check_newsletter_email_result = mysqli_query($conn, $sql);

            if ($check_newsletter_email_result) {
               $res['message'] = 'Email sent, you\'ll receive our newsletter';
            }
         }
      }
   }
?>



<div>
   <?php if (!$res) :?>
      <p></p>
   <?php elseif ($res['message'] === 'Email sent, you\'ll receive our newsletter') :?>
      <p class="text-white text-center bg-success p-3 w-25 mx-auto response"><?php echo $res['message']; ?></p>
   <?php elseif ($res['message'] === 'Email Already Exit') :?>
      <p class="text-white text-center bg-danger p-3 w-25 mx-auto response"><?php echo $res['message']; ?></p>   
   <?php elseif ($res['message'] === 'Email can\'t be blank') :?>
      <p class="text-white text-center bg-danger p-3 w-25 mx-auto response"><?php echo $res['message']; ?></p>
   <?php elseif ($res['message'] === 'Please Enter A Valid Email Address') :?>
      <p class="text-white text-center bg-danger p-3 w-25 mx-auto response"><?php echo $res['message']; ?></p>
   <?php else :?> 
         <p><?php echo $res['message']; ?></p>
   <?php endif;?>      
</div>

<div class="container subcription-container-holder mb-5 mt-5">
   <div>
       <h1>Subcribe To Our Newsletter</h1>
       <p>New update, notification job alert for job seekers and employers</p>
       <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
           <input type="email" name="email" id="email" placeholder="type your email" value="<?php echo htmlspecialchars($email);?>">
            <button type="submit" name="sendNewsLetter">Send</button>
       </form>
   </div>
</div>
<div class="dots-subcription dots-subcription1">
   <pre>
    ..........
    .......... 
    ..........
    .......... 
   </pre>
</div>
<div class="dots-subcription dots-subcription2">
   <pre>
    ..........
    ..........
    ..........
    .......... 
   </pre>
</div>




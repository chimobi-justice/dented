<?php 

    error_reporting(E_ALL ^ E_NOTICE);

    $name = $email = $sub = $mssg = '';
    $trimName;
    $trimEmail;
    $trimSubject;
    $trimMessage;
    $errors = ['name' => '', 'email' => '', 'subject' => '', 'message' => ''];
    $res = ['message' => ''];

    if (isset($_POST['send'])) {
        
        if (empty($_POST['name'])) {
            $errors['name'] = 'Required*';
        } else {
            $name = $_POST['name'];
            $trimName = trim($name);

            if (!preg_match('/^[a-zA-Z\s]+$/', $trimName)) {
                $errors['fullname'] = 'Fullname must be letters and space only';
            }
        } 

        if (empty($_POST['email'])) {
            $errors['email'] = 'Required*';
        } else {
            $email = $_POST['email'];
            $trimEmail = trim($email);

            if (!filter_var($trimEmail, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email must be valid';
            }
        }
        if (empty($_POST['subject'])) {
            $errors['subject'] = 'Required*';
        } else {
            $sub = $_POST['subject'];
            $trimSubject = trim($sub);
        }
        if (empty($_POST['message'])) {
            $errors['message'] = 'Required*';
        } else {
            $mssg = $_POST['message'];
            $trimMssg = trim($mssg);
        }

        if ($trimName && $trimEmail && $trimSubject && $trimMssg) {
            $toEmail = "chimobi.justice@gmail.com";
                $subject = 'Submit Contact Form'. $trimName . $trimEmail;
                $body = "<h2>Filled contact form:</h2>
                         <h4>Name</h4><p>' {$trimName} '</p>
                         <h4>Email</h4><p>' {$trimEmail} '</p>
                         <h4>Message</h4><p>' {$trimMessage} '</p>";
            
                
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8". "\r\n";
                
                $headers .= "From: {$trimName} {$trimEmail}" .  "\r\n";
        
                if (mail($toEmail, $subject, $body, $headers)) {
                  $res['message'] = 'Your message has been sent, we\'ll get Back to you shortly!';
                } else {
                    $res['message'] = 'ERROR! your message wasn\'t Sent, Please try again';
                }
        }
    }


?>


<html>
    <head>     
        <title>Dented | Contact Us</title>
    </head>

    <?php include('template/header.php')?>

    <div>
        <?php if (!$res) : ?>
            <p></p>
        <?php elseif ($res['message'] === 'Your message has been sent, we\'ll get Back to you shortly!') :?>
            <p class="text-dark alert alert-success text-center err"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>
        <?php elseif ($res['message'] === 'ERROR! your message wasn\'t Sent, Please try again') :?>
            <p class="text-dark alert alert-danger text-center err"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>
        <?php else :?>
            <p></p>
        <?php endif;?>
    </div>

    <div class="container text-dark mt-5 mb-5">
        <div class="contact-header-text text-center pt-3">
            <h1>Contact Us</h1>
        </div>
            
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mb-5 mt-5 p-3 bg-white" id="contact-form">
            <div class="form-group input-flex">
                <div class="w-100 p-1">
                    <label for="name" class="control-label">Your Name</label>
                    <input type="text" name="name" class="form-control form-control-lg" id="name" placeholder="Your Name" value="<?php echo htmlspecialchars($trimName);?>">
                    <p id="responseName" class="text-danger"><?php echo $errors['name']; ?></p>
                </div>
                <div class="w-100 p-1">
                    <label for="email" class="control-label">Your E-mail</label>
                    <input type="email" name="email" class="form-control form-control-lg w-100" id="email" placeholder="Your E-mail" value="<?php echo htmlspecialchars($trimEmail); ?>">
                    <p id="responseEmail" class="text-danger"><?php echo $errors['email']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label for="subject" class="control-label">Subject</label>
                <input type="text" name="subject" class="form-control form-control-lg" id="subject" placeholder="Subject" value="<?php echo htmlspecialchars($trimSubject); ?>">
                <p id="responseSubject" class="text-danger"><?php echo $errors['subject']; ?></p>
            </div>
            <div class="form-group">
                <label for="message" class="control-label">Your Message</label>
                <textarea name="message" id="message" cols="20" rows="10" class="form-control w-100 mb-3 mt-2 p-3" placeholder="Your Message"><?php echo htmlspecialchars($trimMssg); ?></textarea>
                <p id="responseMessage" class="text-danger"><?php echo $errors['message']; ?></p>
            </div>    
            <button name="send" class="btn btn-md c-my-btn mt-2 mb-4">Send</button>
        </form>

        <div class="wrapper-text-summary">
            <p class="summary text-dark">Please use the form on this page to send your comment, feedback or report error.</p>
            <p class="contact-content text-dark">Your feedback is really important to us, so please feel free to drop us a line. If you are expecting a response, you will need to provide us your name and email* address, of course.</p>
        </div>
        <div class="text-dark wrapper-text">
            <p class="text-dark">You may use this contact form to:</p>
            <ul class="pl-5">
                <li>report any inaccuracies in the information presented on this website,</li>
                <li>advertise to promote your jobs or the services you provide, or</li>
                <li>provide suggestions to improve this website.</li>
            </ul>
            <p class="text-dark">Unfortunately we are not able to provide individual help, or support for a specific problem due to the volume of mail we receive every day. But rest assured that we read every single comment</p>
            <p class="text-dark"><i>We respect your privacy, so the information that you provide remains confidential. We will never share your email address or other personal information with anyone.</i></p>
        </div>

    </div>

    
    <?php include('template/footer.php')?>
    
    <script src="assets/js/contact.js"></script>

</html>
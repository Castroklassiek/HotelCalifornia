<?php include "../header.php" ?>
<?php
     //Message Vars
     $msg = '';
     $msgClass = '';

     // Check For Submit
  if(filter_has_var(INPUT_POST, 'submit')){
      // Form Data
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $message = htmlspecialchars($_POST['message']);
      
      // Check Required Fields
  if(!empty($email) && !empty($name) && !empty($message)){
      // Passed
      // Check Email
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
      //Failed 
      $msg = 'Please fill in a valid Email';
      $msgClass = 'alert-danger';      
      } else {
          // Passed
          // Recipient Email
          $toEmail = 'castroklassiek@gmail.com';
          $subject = 'Contact Request From '.$name;
          $body = '<h2>Contact Request</h2>
                   <h4>Name</h4><p>'.$name.'</p>
                   <h4>Email</h4><p>'.$email.'</p>
                   <h4>Message</h4><p>'.$message.'</p>';
          // Email Headers
          $headers = "MIME-Version: 1.0" ."\r\n";
          $headers .="Content-Type:text/html;charset=UTF8" ."\r\n";
          // Additional Headers
          $headers .= "From: ".$name. "<".$email.">". "\r\n";
          
          if(mail($toEmail, $subject, $body, $headers)){
          //Email Sent
          $msg = 'Your Email has been sent';
          $msgClass = 'alert-success';
          } else {
          //Failed
          $msg = 'Your Email was not sent';
          $msgClass = 'alert-danger';    
          }
          
              }
      } else {
      //Failed
      $msg = 'Please fill in all fields';
      $msgClass = 'alert-danger';
      }
  }



?>

<div class="container-fluid">
    <div class="text-center" id="th3">
        <h2>Contact Us</h2>
    </div>
    <hr class="my-4">
    <div class="map-responsive">
        <iframe width="600" height="450" id="gmap_canvas" src="https://maps.google.com/maps?q=506%20S%20Grand%20Ave&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="yes" marginheight="0" style="border:0" marginwidth="0" allowfullscreen></iframe>
    </div>
</div>
<br>
<div class="container-fluid">
    <div class="row padding">
        <div class="col-md-6">
            <h4>Book Now!</h4>
            <p>To avoid dissapointment book well ahead of time. We are booked up for several days. Occasionaly a room will become available due to cancellation. If you would like to be informed of openings please message us. You can also contact us directly by phone on:
                <br>
            </p>
            <h4>+1 213-624-1011</h4>
            <br>
            <a href="/pages/booking.php">
                <button type="button" class="btn btn-outline-dark btn-lg b1">BOOK NOW</button>
            </a>
        </div>

        <div class="col-md-6">
           
           <?php if($msg != ''): ?>
            <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
            <?php endif; ?>
           
            
            
            <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label class="control-label col-sm-6" for="name"><i class="fas fa-user"> Your Name:</i></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-6" for="email"><i class="fas fa-envelope"> Your Email:</i></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-6" for="message">Message:</label>
                    <div class="col-sm-10">
                        <textarea placeholder="Type your message here..." class="form-control"<?php echo isset($_POST['email']) ? $email : ''; ?> rows="5" id="message" name="message"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-outline-light">Send Mail</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<br>









<?php include "../footer.php" ?>
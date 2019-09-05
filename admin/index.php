<?php 
  // Include db config
  require '../db.php';

  // Init vars
  $email = $password = '';
  $email_err = $password_err = '';

  // Process form when post submit
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Sanitize POST
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // Put post vars in regular vars
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate email
    if(empty($email)){
      $email_err = '!';
    }

    // Validate password
    if(empty($password)){
      $password_err = '!';
    }

    // Make sure errors are empty
    if(empty($email_err) && empty($password_err)){
      // Prepare query
      $sql = 'SELECT email, password FROM admin WHERE email = :email';

      // Prepare statement
      if($stmt = $pdo->prepare($sql)){
        // Bind params
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Attempt execute
        if($stmt->execute()){
          // Check if email exists
          if($stmt->rowCount() === 1){
            if($row = $stmt->fetch()){
              $hashed_password = $row['password'];
              if(password_verify($password, $hashed_password)){
                // SUCCESSFUL LOGIN
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name'];
                header('location: ./Page/Welcome.html');
              } else {
                // Display wrong password message
                $password_err = 'The password you entered is not valid';
              }
            }
          } else {
            $email_err = 'No account found for that email';
          }
        } else {
           
          die('Something went wrong');
        }
      }
      // Close statement
      unset($stmt);
    }

    // Close connection
    unset($pdo);
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./image/favicon.ico" type="image/gif" sizes="16x16">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Cambo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Staatliches" rel="stylesheet">
    <link rel="icon" href="../../../../favicon.ico">
    <link href="style.css" type="text/css" rel="stylesheet">
    <title>Admin Login HotelCalifornia</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>

<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
                    <span><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-square"></i></a></span>
                    <span><a href="https://nl.linkedin.com/in/bas-otto-22028117b" target="_blank"><i class="fab fa-linkedin"></i></a></span>
                    <span><a href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter-square"></i></a></span>
				</div>
			</div>
			<div class="card-body">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><?php echo $email_err; ?><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="e-mail">
					</div>
					
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><?php echo $password_err; ?><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="password">
					</div>
					
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
					
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="./signUp/signUp.php">Sign Up</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
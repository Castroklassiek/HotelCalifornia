<?php 
  // Include db config
  require '../../db.php';
  // Init vars
  $name = $telefoonnummer = $adres = $email = $password = $confirm_password = '';
  $name_err = $telefoonnummer_err = $adres_err = $email_err = $password_err = $confirm_password_err = '';

  // Process form when post submit
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Sanitize POST
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // Put post vars in regular vars
    $name = trim($_POST['name']);
    $telefoonnummer = trim($_POST['telefoonnummer']);
    $adres =  trim($_POST['adres']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate email
    if(empty($email)){
      $email_err = 'Please enter email';
    } else {
      // Prepare a select statement
      $sql = 'SELECT id FROM admin WHERE email = :email';

      if($stmt = $pdo->prepare($sql)){
        // Bind variables
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Attempt to execute
        if($stmt->execute()){
          // Check if email exists
          if($stmt->rowCount() === 1){
            $email_err = 'Email is already taken';
          }
        } else {
          die('Something went wrong');
        }
      }

      unset($stmt);
    }

    // Validate name
    if(empty($name)){
      $name_err = 'Please enter name';
    }
  if(empty($telefoonnummer)){
      $telefoonnummer_err = 'Please enter telephone number';
    }
    if(empty($adres)){
      $adres_err = 'Please enter adres';
    }
    // Validate password
    if(empty($password)){
      $password_err = 'Please enter password';
    } elseif(strlen($password) < 4){
      $password_err = 'Password must be at least 6 characters ';
    }

    // Validate Confirm password
    if(empty($confirm_password)){
      $confirm_password_err = 'Please confirm password';
    } else {
      if($password !== $confirm_password){
        $confirm_password_err = 'Passwords do not match';
      }
    }
  
    // Make sure errors are empty
    if(empty($name_err) && empty($email_err) && empty($telefoonnummer_err) && empty($adres_err) && empty($password_err) && empty($confirm_password_err)){
      // Hash password
      $password = password_hash($password, PASSWORD_DEFAULT);

      // Prepare insert query
      $sql = 'INSERT INTO admin (name, telefoonnummer, adres, email, password) VALUES (:name, :telefoonnummer, :adres, :email, :password)';


      if($stmt = $pdo->prepare($sql)){
        // Bind params
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':telefoonnummer', $telefoonnummer, PDO::PARAM_STR);
        $stmt->bindParam(':adres', $adres, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        // Attempt to execute
        if($stmt->execute()){
          // Redirect to login
          header('location: ../index.php');
        } else {
            $stmt->debugDumpParams();
          die('Something went wrong');
        }
      }
      unset($stmt);
    }

    // Close connection
    unset($pdo);
  }
?>

<!DOCTYPE html>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="../style.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<title>Admin Registration HotelCalifornia</title>

   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body class="rgstr">
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card2">
			<div class="card-header">
				<h3>Sign Up</h3>
			</div>

			<div class="card-body">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">				
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><?php echo $name_err; ?><i class="fas fa-signature"></i></span>
						</div>
						<input type="text" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" name="name" placeholder="first and lastname">
					</div>
					
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><?php echo $email_err; ?><i class="fas fa-envelope"></i></span>
						</div>
						<input type="text" name="email" placeholder="e-mail" class="form-control<?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
					</div>	
									
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><?php echo $password_err; ?><i class="fas fa-key"></i></span>
						</div>
						<input type="password" placeholder="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>"> 
					</div>					
					
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"><?php echo $confirm_password_err; ?></i></span>
						</div>
						<input type="password" name="confirm_password" placeholder="repeat password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
					</div>
					
						<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><?php echo $adres_err; ?><i class="fas fa-home"></i></span>
						</div>
						<input type="text" class="form-control <?php echo (!empty($adres_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $adres; ?>" name="adres" placeholder="adres">
						
					</div>
					
						<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><?php echo $telefoonnummer_err; ?><i class="fas fa-phone"></i></span>
						</div>
						<input type="text" class="form-control <?php echo (!empty($telefoonnummer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telefoonnummer; ?>" name="telefoonnummer" placeholder="telephone number">
						
					</div>	
						
					<div class="form-group">
						<input type="submit" name="submit" value="Register" class="btn float-right register_btn">
					</div>
					
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Already have an account?<a href="../index.php">Sign in</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
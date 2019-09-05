<?php
//////////////////////////////////////register///////////////////////////////////
  // Include db config
  require 'db.php';

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
      $sql = 'SELECT id FROM users WHERE email = :email';

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
      $telefoonnummer_err = 'Please enter phonenumber';
    }
    if(empty($adres)){
      $adres_err = 'Please enter adres';
    }
    // Validate password
    if(empty($password)){
      $password_err = 'Please enter password';
    } elseif(strlen($password) < 6){
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
      $sql = 'INSERT INTO users (name, telefoonnummer, adres, email, password) VALUES (:name, :telefoonnummer, :adres, :email, :password)';


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
          header('location: Sindex2.php');
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
 

<?php

 require 'db.php';

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
      $email_err = 'Please enter email';
    }

    // Validate password
    if(empty($password)){
      $password_err = 'Please enter password';
    }

    // Make sure errors are empty
    if(empty($email_err) && empty($password_err)){
      // Prepare query
      $sql = 'SELECT email, password FROM users WHERE email = :email';

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
                header('location: /');
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
    <link href="http://hotelcalifornia.local/style.css" rel="stylesheet" type="text/css">
    <title>Hotel California</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script   src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script   src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
</head>

<nav class="navbar navbar-expand-xl navbar-light bg-light sticky-top">
    <a class="navbar-brand mx-auto" href="/">
        <img src="http://hotelcalifornia.local/image/logo.png" width="250" height="102" class="d-inline-block align-top" alt="">
    </a>
</nav>

<nav class="navbar navbar-expand-xl navbar-light bg-light">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarResponsive">

        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/"><i class="fas fa-home"><span> home</span></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/thehotel.php"><i class="fas fa-hotel"><span> the hotel</span></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/rooms.php"><i class="fas fa-bed"><span> rooms</span></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/thearea.php"><i class="fas fa-chart-area"><span> the area</span></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/customerPages/readC.php"><i class="fas fa-door-open"><span> booking</span></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/contactUs.php"><i class="fas fa-location-arrow"><span> contact us</span></i></a>
            </li>

            <!-- /* Geeft bezoekers de mogelijkheid zichzelf te registren & in te loggen*/

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-pencil-alt" data-toggle="modal" data-target="#Register"><span> register</span></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-sign-in-alt" data-toggle="modal" data-target="#Login"><span> login</span></i></a>
            </li>
-->

        </ul>
        
    </div>

</nav>









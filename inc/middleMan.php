<?php
  // for creating a new account
  if(isset($_POST['signup'])) {
    session_start();
    include("my_db.php");
  
    $fullname = htmlentities(mysqli_real_escape_string($con, $_POST['fname']));
    $uname    = htmlentities(mysqli_real_escape_string($con, $_POST['uname']));
    $email    = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($con, $_POST['upwd']));
    $confirm  = htmlentities(mysqli_real_escape_string($con, $_POST['confupwd']));
    $rand     = rand(1, 2);

    if(empty($fullname) || empty($uname) || empty($email) || empty($password) || empty($confirm)) {
      echo "<script>alert('You have not completed filling the form')</script>";
      echo "<script>window.open('signup.php', '_self')</script>";
      exit();
    }
    else {
      if (!preg_match("/^[a-z A-Z]*$/", $fullname)) {
        echo "<script>alert('Form Error')</script>";
        echo "<script>window.open('signup.php', '_self')</script>";
        exit(); 
      }
      else {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo "<script>alert('Form Error')</script>";
          echo "<script>window.open('signup.php', '_self')</script>";
          exit(); 
        } 
        else {
          $sql = "SELECT * FROM users_records WHERE email='$email' OR username='$uname'";
          $res = mysqli_query($con, $sql);
          $resCheck = mysqli_num_rows($res);

          if($resCheck > 0) {
            echo "<script>alert('Your cridentials are in use in this App already')</script>";
            echo "<script>window.open('signup.php', '_self')</script>";
            exit();    
          }
          else {
            if($rand == 1) {
                $profile = "MyCustom/images/default.jpeg";
            } else if($rand == 2) {
                $profile = "MyCustom/images/placeholder.jpg";
            }

            if($password === $confirm) {
              if(strlen($password) < 9) {
                echo "<script>alert('Please use more than 9 characters in your password')</script>";
                echo "<script>window.open('signup.php', '_self')</script>";
                exit(); 
              }
              else {
                $hashedPwd = password_hash($password, PASSWORD_BCRYPT);
                $token = uniqid(True);

                $sqlinsert = "INSERT INTO users_records(fullname,username,email,password,profile,token,
                date_created)VALUES('$fullname','$uname','$email','$hashedPwd',
                '$profile','$token',now())";

                $verifyquery = mysqli_query($con, $sqlinsert);

                if ($verifyquery) {
                  echo "<script>alert('Registration Success. Now you can login to your account.')</script>";
                  echo "<script>window.open('index.php', '_self')</script>";
                  exit(); 
                }
              }
            }
            else 
            {
              echo "<script>alert('Registration Error.')</script>";
              echo "<script>window.open('signup.php', '_self')</script>";
              exit();
            }
          }
        }
      }
    }
  }

  // for login to an existing account
  if(isset($_POST['signin'])) {
    session_start();
    include("my_db.php");
  
    $email    = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($con, $_POST['upwd']));

    if(empty($email) || empty($password)) {
      echo "<script>alert('You have not completed filling the form')</script>";
      echo "<script>window.open('index.php', '_self')</script>";
      exit();
    }
    else {
      $cnf_user = "SELECT * FROM users_records WHERE email='".$email."' ";
      $result   = mysqli_query($con, $cnf_user);
       
      if(mysqli_num_rows($result) > 0) {
        $row       = mysqli_fetch_assoc($result);
        $hashedPwd = $row['password'];

        if(password_verify($password, $hashedPwd)) {
          $_SESSION['email'] = $email;
          $online  = "UPDATE users_records SET status ='Online' WHERE email='".$email."'";
          $update_msg = mysqli_query($con, $online);

          $_SESSION['initial_time'] = time(); //start time

          $user     = $_SESSION['email'];
          $get_user = "SELECT * FROM users_records WHERE email='$user'";
          $run_user = mysqli_query($con, $get_user);
          $row      = mysqli_fetch_array($run_user);

          $username = $row['username'];
          echo "<script>window.open('home.php?username=$username', '_self')</script>";
        }
        else
        {
          echo "<script>alert('Error. Login Error.')</script>";
          echo "<script>window.open('index.php', '_self')</script>";
          exit();
        }
      }
      else
      {
        echo "<script>alert('Error. Login Error.')</script>";
        echo "<script>window.open('index.php', '_self')</script>";
        exit();
      }
    }
  }
?>
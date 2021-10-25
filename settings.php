<?php
  session_start();
  include("inc/my_db.php");
  include("inc/action.php");

  if (!isset($_SESSION['email'])) {
    echo "<script>window.open('index.php', '_self')</script>";
    exit();
  }
  else { 
    if((time() - $_SESSION['initial_time']) > 1200) { //time in sec when inactive
      $user     = $_SESSION['email'];
      $get_info = "SELECT * FROM users_records WHERE email='$user'";
      $run_info = mysqli_query($con, $get_info);
      $row      = mysqli_fetch_array($run_info);
      $myName   = $row['username'];
      
      $Offline = "UPDATE users_records SET status='Offline' WHERE username='".$myName."'";
      $sleep   = mysqli_query($con, $Offline);
      echo "<script>alert('Session expired after being inactive for long')</script>";
      echo"<script>window.open('inc/logout.inc.php', '_self')</script>";
      exit();
    }
    else {
      $_SESSION['initial_time'] = time();//calculate time in sec when active
    }
  ?> 

  <!DOCTYPE html>
  <html lang="en">
    <head>
      <!-- Meta tags -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="description" content="This is a crud project">
      <meta name="keywords" content="crud project">
      <meta name="author" content="Joeson Misiani">

      <title>Crud Project</title>

      <!-- Favicons -->
      <link rel="icon" href="MyCustom/images/aj.png" type="image/x-icon">

      <!--========== CSS & JQUERY ==========-->
      <link rel="stylesheet" href="MyCustom/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="MyCustom/fontawesome-free/css/all.css">
      <link rel="stylesheet" href="MyCustom/fontawesome-free/css/v4-shims.min.css"> 
      <link rel="stylesheet" href="MyCustom/fileupload/bootstrap-fileupload.css">
 
      <script src="MyCustom/js/jquery.js"></script>
      <script src="MyCustom/js/bootstrap.min.js"></script>
    </head>

    <style>
      /* custom properties */
      :root {
        /* fonts family */
        --ff-primary: sans-serif;
        --ff-secondary: 'ubuntu';
        --ff-clock: 'digital-7 mono';

        /* font weight */
        --fw-s1: 300;
        --fw-s2: 400;
        --fw-s3: 500;
        --fw-s4: 600;

        /* color */
        --clr-light: #fff;
        --clr-dark: #000;
        --clr-lightDark: #444;
        --clr-gray: #767676;
        --clr-grey: #ccc;
        --clr-dodger: #1e90ff;

        /* box shadow */
        --bs: 0.25em 0.25em 0.75em rgba(0,0,0,.25),
              0.125em 0.125em 0.25em rgba(0,0,0,.15);
      }
      /* custom properties */

      a, a:hover{ 
        text-decoration: none; 
        -webkit-transition:color .3s linear;
        -o-transition:color .3s linear;
        transition:color .3s linear;
        outline:0; 
      }
      li {
        list-style: none;
      }
      * {
        margin: 0;
        padding: 0;
      }
      body{
        background: #ccc;
      }

      nav {
        width: 100%;
        z-index: 999;
        height: 9vh;
        transition: all 0.3s ease;
        border-radius: none;
        background-color: rgba(0,0,0,0.5);
      }

      .cover {
        border:1px solid transparent;
        width: 100%;
        padding: 30px 80px;
      }

      /*[ left side ]*/
      .left_side {
        border: none; 
        padding-left: 0;
      }
      .left_side .sub_cover {
        border: 1px solid transparent;
        border-radius: 5px;
      }
      .left_side .title {
        background: var(--clr-dodger);
        border: none;
        border-bottom: 3px solid var(--clr-dark);
        height: 80px;
        width: 100.3%;
        margin-top: -1px;
        margin-left: -1px;
      }
      .left_side .title h1 {
        border: none;
        margin-top: 0;
        height: 60px;
        line-height: 60px;
        text-align: center;
        font-family: var(--ff-secondary);
        font-size: 20px;
        color: var(--clr-light);
      }
      .left_side .title h2 {
        border: none;
        margin-top: -20px;
        height: 20px;
        font-size: 16px;
        text-align: center;
        font-family: Segoe Print;
        color: var(--clr-light);
      }
      .left_side .profile {
        background: white;
        border: 1px solid transparent;
        margin-top: 0;
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 20px;
        padding-right: 20px;
      }
      .panel-heading {
        border: none;
        font-size: 15px;
        margin-left: 0px;
        margin-right: 0px;
        text-transform: uppercase;
        font-family: var(--ff-secondary);
        font-weight: var(--fw-s3);
      }
      .nav-tabs {
        background: #e0e1e7;
      }
      .nav-tabs a {
        color: #2f2f2f;
      }
      .MyInfo, .boxTwo  {
        width: 100%;
        border: 1px solid transparent;
        background-color: transparent;
        margin-top: 0px;
        padding-left: 0;
        padding-right: 0;
      }
      .mainInfo, .mainPwd {
        border: 1px solid transparent;
        width: 100%;
      }
      #forInfo, #forPwd {
        border: 1px solid transparent;
        width: 100%;
        margin-top: 0px;
        padding-left: 0;
        padding-right: 0;
      }
      #forInfo .jobInfo, #forPwd .job_body {
        border: none;
        padding-top: -10px;
      }
      #forInfo .boxInfo, #forPwd .box {
        width: 100%;
        height: 36px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 0;
        margin-top: 5px;
      }
      #forInfo .jobInfo input, #forPwd .job_body input {
        border: none;
        border-bottom: 1px solid #aaa;
        box-sizing: border-box;
        width: 100%;
        margin-top: 10px;
        outline: none;
        color: rgba(0,0,0,.7);
        background: transparent;     
        font-family: var(--ff-secondary);
        font-size: 16px;
      }
      #forInfo .inputWithIcon, #forPwd .inputWithIcon {
        position: relative;
      }
      #forInfo .inputWithIcon input, #forPwd .inputWithIcon input { 
        padding-left: 37px;
      }
      #forInfo .inputWithIcon i, #forPwd .inputWithIcon i { 
        position: absolute;
        top: 6px;
        left: 0;
        padding-top: 0px;
        padding-left: 8px;
        padding-bottom: 9px;
        padding-right: 8px;
        font-size: 17px;
      }
      #forInfo .inputWithIcon.inputIconBg i, #forPwd .inputWithIcon.inputIconBg i { 
        background-color: transparent;
        color: rgba(0,0,0,.7);
        padding-top: 6px;
        padding-left: 8px;
        padding-bottom: 10px;
        padding-right: 25px;
        border-radius: 5px 0 0 5px;
      }
      #forInfo .finalInfo, #forPwd .finalise {
        width: 100%;
        height: 45px;
        border: none;
        background-color: transparent;
        margin-top: 0px;
        padding-right: 0;
      }
      #forInfo .finalInfo .change, #forPwd .finalise .submit {
        background: dodgerblue;
        border-color: transparent;
        border-radius: 3px;
        color: #fff;
        font-size: 15px;
        letter-spacing: 0;
        height: 30px;
        width: 85px;
        margin-top: 8px;     
        font-family: var(--ff-secondary);
        padding-top: 4px;
        padding-left: 15px;
        float: right;
      }
      #forInfo .finalInfo .change:hover, #forPwd .finalise .submit:hover {
        cursor: pointer;
        background: dodgerblue;
        opacity: .8;
      }
      .disp {        
        margin-left: -20px;
      }
      .btn-theme02 {
        background: rgba(0,0,0,.5);
        border-color: transparent;
        border-radius: 3px;
        border: 1px solid transparent;
        color: #fff;
        font-size: 15px;
        height: 30px;
        margin-top: 8px;
        margin-left: 0px;
        font-family: var(--ff-secondary);
        padding-top: 2px;
      }
      .btn-theme02:hover {
        color: #fff;
        background: rgba(0,0,0,.5);
        opacity: .8;
      }
      .fileExists {
        background: dodgerblue;
        border-color: transparent;
        border-radius: 3px;
        color: #fff;
        font-size: 15px;
        height: 29px;
        margin-top: 8px;
        font-family: var(--ff-secondary);
        padding-top: 2px;
        position: absolute;
      }
      .fileExists:hover {
        color: #fff;
        background: dodgerblue;
        opacity: .8;
      }
    </style>

    <body>
      <nav>
        <?php include("navigation.php"); ?>
      </nav>

      <section>
        <div class="col-md-12 container-fluid cover">
          <div class="col-md-3"></div>

          <!-- Start Left Side -->
          <div class="col-md-6 left_side">
            <div class="sub_cover">
              <div class="title">
                <h1>
                  <?php
                    $user     = $_SESSION['email'];
                    $get_user = "SELECT * FROM users_records WHERE email='$user'";
                    $run_user = mysqli_query($con, $get_user);
                    $row      = mysqli_fetch_array($run_user);

                    $myfullname = $row['fullname'];
                    $myusername = $row['username'];
                    $mymail     = $row['email'];
                    $myprofile  = $row['profile'];
                    $mytoken    = $row['token'];  
                    
                    echo "Logged in as $username";
                  ?>
                </h1>

                <h2>Edit your Profile</h2>
              </div>

              <div class="col-lg-12 profile">                
                <div class="panel-heading">
                  <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
                    <li><a data-toggle="tab" href="#photo">Photo</a></li>
                    <li><a data-toggle="tab" href="#password">Password</a></li>
                  </ul>
                </div>

                <div class="panel-body">
                  <div class="tab-content">
                    <!-- [ start profile ] -->
                    <div id="profile" class="tab-pane  active">
                      <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 detailed">
                          <div class="MyInfo">
                            <div class="mainInfo">
                              <form action="" method="post" id="forInfo" autocomplete="off">
                                <div class="jobInfo">
                                  <div class="boxInfo">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input type="text" name="forName" value="<?php echo $myfullname ?>">
                                      <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="boxInfo">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input type="text" name="forUser" value="<?php echo $myusername ?>">
                                      <i class="fa fa-id-card fa-lg fa-fw" aria-hidden="true"
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="boxInfo">
                                    <div class="inputWithIcon inputIconBg">
                                      <input type="text" name="forEmail" value="<?php echo $mymail ?>">
                                      <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true" 
                                      style="margin-top:3px"></i>
                                    </div>
                                  </div>

                                  <div class="finalInfo">
                                    <input type="submit" class="form-control change" 
                                    name="forinfo" value="update">  
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php
                      if (isset($_POST['forinfo'])) {   
                        $updtfullname = htmlentities($_POST['forName']);
                        $updtusername = htmlentities($_POST['forUser']);
                        $updtemail    = htmlentities($_POST['forEmail']);

                        $update = "UPDATE users_records SET fullname='$updtfullname',username='$updtusername',
                        email='$updtemail' WHERE email='$user'";

                        $upgrade = mysqli_query($con, $update);

                        if ($upgrade) {
                          // parent directory
                          $newToken    = $_GET["token"];
                          $getNewToken = "SELECT * FROM users_records WHERE token='$newToken'";
                          $resNewToken = mysqli_query($con, $getNewToken);

                          if(mysqli_num_rows($resNewToken) == False) { 
                            // leave blank
                          }
                          else {
                            $main     = mysqli_fetch_assoc($resNewToken); 
                            $mainMail = $main['email'];
                          }

                          // child directory
                          $existing = $_GET["token"];
                          $resexist = "SELECT * FROM crud WHERE mytoken='$existing'";
                          $runexist = mysqli_query($con, $resexist);

                          if(mysqli_num_rows($runexist) == False) { 
                            // leave blank
                          }
                          else {
                            $sub       = mysqli_fetch_assoc($runexist); 
                            $existMail = $sub['mymail']; 

                            if($mainMail == $existMail) {
                              // leave blank
                            }
                            else {
                              $gettoken = $_GET["token"];
                              $resToken = "SELECT * FROM crud WHERE mytoken='$gettoken'";
                              $tokenSQL = mysqli_query($con, $resToken);

                              // assign parent names with new names 
                              $newUserMail = $mainMail;

                              // updating child directory with new names
                              $updtMail  ="UPDATE crud SET mymail='$newUserMail' WHERE mytoken='$gettoken'";
                              $runUPDT = mysqli_query($con, $updtMail);

                              if ($runUPDT) {
                                // updating the status
                                $Offline = "UPDATE users_records SET status='Offline' WHERE email='$updtemail'";
                                $update_msg = mysqli_query($con, $Offline);

                                echo "<script>window.open('inc/logout.inc.php', '_self')</script>";
                              }
                              else {                                
                                echo "<script>alert('Error! refused to change the child directory')</script>";
                              }
                            }
                          }
                        }
                      }
                    ?>
                    <!-- [ end profile ] -->

                    <!-- [ start photo ] -->
                    <div id="photo" class="tab-pane">
                      <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 detailed">
                          <form action="" method="post" enctype="multipart/form-data" class="forImg">
                            <div class="col-md-2"></div>

                            <div class="col-md-10">
                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail disp" style="width:200px;">
                                  <img src='<?php echo $myprofile; ?>' alt="profile">
                                </div>
                    
                                <div class="fileupload-preview fileupload-exists thumbnail" 
                                style="max-width:200px;max-height:200px;line-height:60px;">
                                </div>

                                <div>
                                  <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new">Select image</span>
                                    <span class="fileupload-exists">Change</span>
                                    <input type="hidden" name="oldimage" value="<?php echo $myprofile; ?>">
                                    <input type="file" name="u_image" class="default">
                                  </span>

                                  <input type="submit" name="profilepic" value="Update"
                                  class="btn btn-theme04 fileupload-exists fileExists"> 
                                </div>
                              </div>
                            </div>

                            <div class="col-md-2"></div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <?php 
                      if(isset($_POST['profilepic'])) {
                        $file = $_FILES['u_image'];
              
                        $fileName    =  $_FILES['u_image']['name'];
                        $fileTmpName =  $_FILES['u_image']['tmp_name'];
                        $fileSize    =  $_FILES['u_image']['size'];
                        $fileError   =  $_FILES['u_image']['error'];
                        $fileType    =  $_FILES['u_image']['type'];
                      
                        $fileExt       =  explode('.', $fileName);
                        $fileActualExt =  strtolower(end($fileExt));
                      
                        $allowed = array('jpg', 'jpeg', 'png', 'jfif');
  
                        if(in_array($fileActualExt, $allowed)) {
                          if($fileError === 0) {
                            if($fileSize < 10000000) {
                              $fileNameNew = uniqid('', true).".".$fileActualExt;
                              $fileDestination = 'MyProfiles/'.$fileNameNew;
                              unlink($profile);
                              move_uploaded_file($fileTmpName, $fileDestination);

                              $update = "UPDATE users_records SET profile='$fileDestination' 
                              WHERE email='$user'";
                              $run    = mysqli_query($con, $update);

                              if ($run) {
                                echo "<script>alert('Your Profile Updated successfully')</script>";
                                echo "<script>window.open('settings.php?token=$mytoken', '_self')</script>";
                                exit();
                              }
                            }
                            else {
                              echo "<script>alert('Your file is too big')</script>";
                              echo "<script>window.open('settings.php?token=$mytoken','_self')</script>";
                              exit();
                            }
                          }
                          else {
                            echo "<script>alert('There was an error uploading your file')</script>";
                            echo "<script>window.open('settings.php?token=$mytoken', '_self')</script>";
                            exit();
                          }
                        }
                        else {
                          echo "<script>alert('You cannot upload files of this type')</script>";
                          echo "<script>window.open('settings.php?token=$mytoken', '_self')</script>";
                          exit();
                        }
                      }
                    ?>
                    <!-- [ end photo ] -->

                    <!-- [ start password ] -->
                    <div id="password" class="tab-pane">
                      <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 detailed">

                          <div class="boxTwo">
                            <div class="mainPwd">
                              <form action="" method="post" id="forPwd" autocomplete="off">
                                <div class="job_body">
                                  <div class="box">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input type="password" name="user_pass" 
                                      placeholder="Current Password">
                                      <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="box">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input type="password" name="u_pass1" 
                                      placeholder="New Password">
                                      <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="box">
                                    <div class="inputWithIcon inputIconBg">
                                      <input type="password" name="u_pass2" 
                                      placeholder="Confirm Password">
                                      <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="finalise">
                                    <input type="submit" class="form-control submit" 
                                    name="forpassword" value="change">  
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php 
                      if(isset($_POST['forpassword'])) {
                        $oldPwd = htmlentities($_POST['user_pass']);
                        $pass1  = htmlentities($_POST['u_pass1']);
                        $pass2  = htmlentities($_POST['u_pass2']);

                        if(empty($oldPwd) || empty($pass1) || empty($pass2)) {
                          echo "<script>alert('Please complete the form')</script>";
                          echo "<script>window.open('settings.php?token=$mytoken', '_self')</script>";
                          exit();
                        } 
                        else {
                          $password_hash = $row['password'];
                      
                          if(password_verify($oldPwd, $password_hash)) {
                            if ($pass1 === $pass2) {
                              if(strlen($pass1) > 9) {
                                $user_recovery = $row['username'];

                                $encript_pwd = password_hash($pass1, PASSWORD_BCRYPT);
                                $update_pass = "UPDATE users_records SET password='$encript_pwd' 
                                WHERE username='$user_recovery'";
                                $run_pass    = mysqli_query($con, $update_pass);

                                if ($run_pass) {
                                  echo "<script>alert('Next time you sign in, use your new password')</script>";
                                  echo "<script>window.open('settings.php?token=$mytoken', '_self')</script>";
                                  exit();
                                }
                              }
                              else {
                                echo "<script>alert('Password should be of nine charactres atleast')</script>";
                                echo "<script>window.open('settings.php?token=$mytoken', '_self')</script>";
                                exit();
                              }
                            }
                            else {
                              echo "<script>alert('Password dont match')</script>";
                              echo "<script>window.open('settings.php?token=$mytoken', '_self')</script>";
                              exit();
                            }
                          }
                          else {
                            echo "<script>alert('Invalid Password')</script>";
                            echo "<script>window.open('settings.php?token=$mytoken', '_self')</script>";
                            exit();
                          }
                        }
                      }
                    ?>
                    <!-- [ end password ] -->
                  </div>
                </div>

                
              </div>
            </div>
          </div>
          <!-- Finish Left Side -->    

          <div class="col-md-3"></div>
        </div>
      </section>

      <!--============ javascript Files ============-->
      <script type="text/javascript" src="MyCustom/js/digitClock.js"></script>
      <script type="text/javascript" src="MyCustom/jquery/jquery.min.js"></script>
      <script type="text/javascript" src="MyCustom/bootstrap/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="MyCustom/fileupload/bootstrap-fileupload.js"></script>
    </body>
  </html>
<?php } ?>
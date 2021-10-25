<?php
  session_start();
  include("inc/my_db.php");
  include("inc/action.php");

  if (!isset($_SESSION['email'])) {
    echo "<script>window.open('index.php', '_self')</script>";
    exit();
  }
  else { 
    if((time() - $_SESSION['initial_time']) > 300) { //time in sec when inactive
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
        background-color: white;
      }
      .left_side .title {
        background: var(--clr-dodger);
        border: none;
        border-bottom: 3px solid var(--clr-dark);
        height: 80px;
        width: 100.5%;
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
      .left_side form {
        border: none;
        margin-top: 0;
        padding-left: 20px;
        padding-right: 20px;
      }
      .left_side form .myInput {
        border: none;
        width: 100%;
        height: 40px;
        margin-top: 5px;
      }
      .left_side form .myInput input {
        border: none;
        border-bottom: 1px solid var(--clr-gray);
        box-sizing: border-box;
        width: 100%;
        margin-top: 14px;
        padding-bottom: 1px;
        outline: none;
        color: var(--clr-lightDark);
        background: transparent;
        font-family: var(--ff-secondary);
        font-weight: var(--fw-s2);
        font-size: 16px;
      }
      .left_side form .myInput input:focus {
        transition: .3s;
        border-bottom-color: dodgerblue;
      }
      .inputWithIcon {
        position: relative;
      }
      .inputWithIcon input {
        padding-left: 30px;
      }
      .inputWithIcon i {
        position: absolute;
        top: 7px;
        left: 0;
        padding-top: 0px;
        padding-left: 8px;
        padding-bottom: 9px;
        padding-right: 8px;
      }
      .inputWithIcon.inputIconBg i {
        background-color: transparent;
        color: rgba(0,0,0,.7);
        padding-top: 10px;
        padding-left: 3px;
        padding-bottom: 10px;
        padding-right: 25px;
        border-radius: 5px 0 0 5px;
      }
      .inputWithIcon.inputIconBg input:focus + i {
        transition: .3s;
        color: rgba(0,0,0,.7);
      }
      .myPhoto {
        border: none;
        margin-top: 10px;
      }
      .btn-theme02 {
        border: none;
        background: rgba(0,0,0,.5);
        border-color: transparent;
        border-radius: 3px;
        color: #fff;
        font-size: 15px;
        letter-spacing: 0px;
        height: 30px;
        margin-top: 0px;
        font-family: ubuntu;
        padding-top: 4px;
      }
      .btn-theme02:hover {
        color: #fff;
        background: rgba(0,0,0,.5);
        opacity: .8;
      }


      /*[ Right Side ]*/
      .right_side {
        border: none;
        padding-right: 0;
      }
      .right_side .sub_cover {
        border: 1px solid transparent;
        border-radius: 5px;
        background-color: white;
        width: 100%;
      }
      .right_side .title {
        background: var(--clr-dodger);
        border: none;
        border-bottom: 3px solid var(--clr-dark);
        height: 80px;
        width: 100.2%;
        margin-top: -1px;
        margin-left: -1px;
      }
      .right_side .title h1 {
        border: none;
        margin-top: 0;
        height: 60px;
        line-height: 60px;
        text-align: center;
        font-family: var(--ff-secondary);
        font-size: 20px;
        color: var(--clr-light);
      }
      .right_side .title h2 {
        border: none;
        margin-top: -20px;
        height: 20px;
        font-size: 16px;
        text-align: center;
        font-family: Segoe Print;
        color: var(--clr-light);
      }
      .display {
        border: none;
        background-color: white;
        height: 100%;
      }
      #table {
        background-color: white;
        margin-bottom: 0;
      }
      #table thead {
        height: 50px;
        line-height: 40px;
      }
      #table tr:hover {
        background-color: #e8e8e8;
      }
      .click_me {
        font-size:16px;
        font-family:sans-serif;
      }
      .icon_left {
        margin-right: 10px;
      }

      /* viewing the item */
      .card {
        border: 1px solid transparent;
        display: flex;
        padding-bottom: 10px;
      }
      .card .left {
        border: 1px solid transparent;
        width: 50%;
        padding-top: 10px;
        padding-left: 20px;
      }
      .card img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
      }
      .card .right {
        border: 1px solid transparent;
        width: 50%;
        font-family: ubuntu;
      }
      .card .right p {
        border: 1px solid transparent;
        margin: 0;
        font-size: 16px;
        padding-top: 5px;
      }
      .card .right a {
        background: dodgerblue;
        color: white;
        padding: 5px 20px;
        font-size: 15px;
        margin-top: 35px;
        display: inline-block;
        border-radius: 3px;
      }
      .card .right a:hover {
        background: dodgerblue;
        color: white;
        opacity: .8;
      }

      /* for editing */
      .formBody {
        border: 1px solid transparent;
      }
      .box_two {
        width: 100%;
        height: 50px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }


      .formBody input {
        border: none;
        border-bottom: 1px solid #aaa;
        box-sizing: border-box;
        width: 95%;
        margin-top: 21px;
        padding-bottom: 5px;
        outline: none;
        color: rgba(0,0,0,.7);
        background: transparent;
        font-family: Bahnschrift;
        font-size: 16px;
      }
      .formBody input:focus {
        transition: .3s;
        border-bottom-color: dodgerblue;
      }
      .formBody .inputWithIcon {
        position: relative;
      }
      .formBody .inputWithIcon input {
        padding-left: 35px;
      }
      .formBody .inputWithIcon i {
        position: absolute;
        top: 8px;
        left: 0;
        padding-top: 0px;
        padding-left: 8px;
        padding-bottom: 9px;
        padding-right: 8px;
      }
      .formBody .inputWithIcon.inputIconBg i {
        background-color: transparent;
        color: rgba(0,0,0,.7);
        padding-top: 15px;
        padding-left: 3px;
        padding-bottom: 10px;
        padding-right: 25px;
        border-radius: 5px 0 0 5px;
      }
      .formBody .inputWithIcon.inputIconBg input:focus + i {
        transition: .3s;
        color: rgba(0,0,0,.7);
      }

      .finalise {
        width: 100%;
        height: 70px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      .finalise .submit {
        background: dodgerblue;
        border-color: transparent;
        border-radius: 3px;
        color: #fff;
        font-size: 16px;
        letter-spacing: 0;
        height: 30px;
        width: 20%;
        margin-top: 20px;
        font-family: ubuntu;
        padding-top: 2px;
      }
      .finalise .submit:hover {
        cursor: pointer;
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
          <!-- Start Left Side -->
          <div class="col-md-4 left_side">
            <div class="sub_cover">
              <div class="title">
                <h1>
                  <?php
                    $user     = $_SESSION['email'];
                    $get_user = "SELECT * FROM users_records WHERE email='$user'";
                    $run_user = mysqli_query($con, $get_user);
                    $row      = mysqli_fetch_array($run_user);
                    $user_name = $row['username'];
                    $mymail    = $row['email'];
                    $mytoken   = $row['token'];
                    
                    echo "Logged in as $user_name";
                  ?>
                </h1>

                <h2>Add a new record</h2>
              </div>

              <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="mymail" value="<?= $mymail; ?>">
                <input type="hidden" name="mytoken" value="<?= $mytoken; ?>">

                <div class="myInput">
                  <div class="inputWithIcon inputIconBg"> 
                    <input type="text" name="name" placeholder="Full name" required>
                    <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                  </div>
                </div>

                <div class="myInput">
                  <div class="inputWithIcon inputIconBg"> 
                    <input type="email" name="email" placeholder="someone@email.com" required>
                    <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true" style="margin-top:3px;"></i>
                  </div>
                </div>

                <div class="myInput">
                  <div class="inputWithIcon inputIconBg"> 
                    <input type="tel" name="phone" placeholder="Phonenumber" required>
                    <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true" style="margin-top:2px;"></i>
                  </div>
                </div>

                <div class="myPhoto">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width:150px;height:100px;">
                      <img src="MyCustom/images/default.jpeg" alt="placeholder">
                    </div>
                          
                    <div class="fileupload-preview fileupload-exists thumbnail" 
                    style="max-width:200px;max-height:200px;line-height:60px;">
                    </div>

                    <div>
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new">Choose image</span>
                        <span class="fileupload-exists">Change image</span>
                        <input type="file" name="avatar" class="default" required>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
                </div>
              </form>
            </div>
          </div>
          <!-- Finish Left Side -->    

          <!-- Start Right Side -->
          <div class="col-md-8 right_side">
            <div class="sub_cover">
              <div class="title">
                <h1>Retrieving Data from the Database</h1>

                <h2>Displaying the records</h2>
              </div>

              <!--***** [ Retrieving Data from the Database ] *****-->
              <div class="display">
                <?php
                  $umail   = $_SESSION['email'];
                  $check   = "SELECT * FROM crud WHERE mymail='".$umail."' ";
                  $confirm = mysqli_query($con, $check);
                  
                  if ( mysqli_num_rows($confirm) == 0 ) {
                    echo "<h4 style='height:28px;width:100%;text-align:center;font-size:20px;
                    border:none;margin-top:50px;margin-bottom:50px;font-family:ubuntu;'>";
                    echo "You have not Uploaded any Records Yet";
                    echo "</h4>";
                  } 
                  else { ?>
                    <?php
                      $showRecordPerPage = 6;

                      if(isset($_GET['page']) && !empty($_GET['page'])) {
                        $currentPage = $_GET['page'];
                      }
                      else {
                        $currentPage = 1;
                      }

                      $startFrom  = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
                      $totalRec   = "SELECT * FROM crud WHERE mymail='".$umail."'"; // add the email of the uploder
                      $allRecords = mysqli_query($con, $totalRec);
                      $totResSql  = mysqli_num_rows($allRecords);
                      $lastPage   = ceil($totResSql/$showRecordPerPage);
                      $firstPage  = 1;
                      $nextPage   = $currentPage + 1;
                      $prevPage   = $currentPage - 1;

                      $getSQL = "SELECT * FROM crud WHERE mymail='$umail' LIMIT $startFrom, $showRecordPerPage ";

                      // $crudSQL    = "SELECT * FROM `crud` LIMIT $startFrom, $showRecordPerPage";
                      $crudResult = mysqli_query($con, $getSQL);
                    ?>

                    <!-- displaying records specifically for the person who uploaded it -->
                    <table class="table" id="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php while($myrec = mysqli_fetch_array($crudResult)) { ?>
                          <tr>
                            <td><?= $myrec['id']; ?></td>

                            <td>
                              <img src="<?= $myrec['photo']; ?>" width="40px" height="40px" 
                              style="border-radius: 50%;">
                            </td>

                            <td class="click_me"><?= $myrec['name']; ?></td>

                            <td class="click_me"><?= $myrec['email']; ?></td>

                            <td class="click_me"><?= $myrec['phone']; ?></td>

                            <td>
                              <a href="<?php echo $myrec['id'];?>" type="button" data-toggle="modal" 
                              data-target="#view<?php echo $myrec['id'];?>" class="icon_left">
                                <i class="fa fa-eye fa-lg fa-fw" aria-hidden="true"></i>
                              </a>

                              <a href="<?php echo $myrec['id'];?>" type="button" data-toggle="modal" 
                              data-target="#edit<?php echo $myrec['id'];?>" class="icon_center">
                                <i class="fa fa-edit fa-lg fa-fw" aria-hidden="true"></i>
                              </a>
                              
                              <a class="icon_right" href="home.php?delete=<?= $myrec['id']; ?>"
                                onclick="return confirm('Do You Want To Delete This Record');">
                                <i style="color:red;margin-left:10px;margin-right:5px;" 
                                class="fa fa-trash-alt fa-lg fa-fw" aria-hidden="true"></i>
                              </a>
                            </td>
                          </tr>

                          <!-- pop-up of viewing specific record -->
                          <div id="view<?php echo $myrec['id'];?>" class="modal fade" 
                          role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" 
                                  data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">View This Candidate</h4>
                                </div>

                                <div class="modal-body">
                                  
                                  <div class='card'>
                                    <div class="left">
                                      <img src="<?php echo $myrec['photo'];?>" width="300" class="img-thumbnail">
                                    </div>

                                    <div class="right">
                                      <p><?php echo $myrec['name'];?></p>
                                      <p><?php echo $myrec['email'];?></p>
                                      <p><?php echo $myrec['phone'];?></p>

                                      <?php
                                        $user     = $_SESSION['email'];
                                        $get_user = "SELECT * FROM users_records WHERE email='".$user."' ";
                                        $run_user = mysqli_query($con, $get_user);
                                        $row      = mysqli_fetch_array($run_user);

                                        $username = $row['username'];

                                        echo "<a href='home.php?username=$username'>Back</a>";
                                      ?>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- pop-up of editing specific record -->
                          <div id="edit<?php echo $myrec['id'];?>" class="modal fade" 
                          role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" 
                                  data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Edit This Record</h4>
                                </div>

                                <div class="modal-body">
                                  <form action="" method="POST" enctype="multipart/form-data" id="form" autocomplete="off">
                                    <input type="hidden" name="id" value="<?php echo $myrec['id'];?>">
                                    <input type="hidden" name="mymail" value="<?php echo $myrec['mymail'];?>">

                                    <div class="myPhoto">
                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width:150px;height:100px;">
                                          <img src="<?php echo $myrec['photo'];?>" alt="placeholder">
                                        </div>
                                              
                                        <div class="fileupload-preview fileupload-exists thumbnail" 
                                        style="max-width:200px;max-height:200px;line-height:60px;">
                                        </div>

                                        <div>
                                          <span class="btn btn-theme02 btn-file">
                                            <span class="fileupload-new">Choose image</span>
                                            <span class="fileupload-exists">Change image</span>
                                            <input type="hidden" name="oldimage" value="<?php echo $myrec['photo'];?>">
                                            <input type="file" name="avatar" class="default">
                                          </span>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="formBody">
                                      <div class="box_two">
                                        <div class="inputWithIcon inputIconBg">
                                          <input type="text" name="name" value="<?php echo $myrec['name'];?>">
                                          <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                                        </div>
                                      </div>

                                      <div class="box_two">
                                        <div class="inputWithIcon inputIconBg">
                                          <input type="email" name="email" value="<?php echo $myrec['email'];?>">
                                          <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
                                        </div>
                                      </div>

                                      <div class="box_two">
                                        <div class="inputWithIcon inputIconBg">
                                          <input type="tel" name="phone" value="<?php echo $myrec['phone'];?>">
                                          <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
                                        </div>
                                      </div>

                                      <div class="finalise">
                                        <input type="submit" class="form-control submit" name="update"
                                        value="update">  
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>                          
                        <?php } ?>
                      </tbody>
                    </table>

                    <?php
                      $allRe = $_SESSION['email'];
                      $countAll = "SELECT * FROM crud WHERE mymail='$allRe'";
                      $countSQL = mysqli_query($con, $countAll);

                      if ( mysqli_num_rows($countSQL) <= 6 ) {
                        // if the table doesnt exceeds 6 records dont display this div 
                        echo "<div aria-label='Page navigation' style='display:none !important;'></div>";
                      } 
                      else { ?>
                        <!-- if the table exceeds 6 records display this div -->
                        <div aria-label="Page navigation" style="border:none;height:55px;margin-top:0;
                        padding-top:9px;padding-left:10px;">
                          <ul class="pagination" style="border:none;margin: 0;">
                            <?php if($currentPage != $firstPage) { ?>
                              <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1" 
                                aria-label="Previous">
                                  <span aria-hidden="true">First</span>
                                </a>
                              </li>
                            <?php } ?>
            
                            <?php if($currentPage >= 2) { ?>
                              <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $prevPage ?>">
                                  <?php echo $prevPage ?>
                                </a>
                              </li>
                            <?php } ?>

                            <li class="page-item active">
                              <a class="page-link" href="?page=<?php echo $currentPage ?>">
                                <?php echo $currentPage ?>
                              </a>
                            </li>

                            <?php if($currentPage != $lastPage) { ?>
                              <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $nextPage ?>">
                                  <?php echo $nextPage ?> 
                                </a>
                              </li>

                              <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next">
                                  <span aria-hidden="true">Last</span>
                                </a>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                      <?php } 
                    ?>
                  <?php } 
                ?>
              </div>
              <!--***** [ Retrieving Data from the Database ] *****-->

            </div>
          </div>
          <!-- Finish Right Side -->
        </div>
      </section>

      <!--========== JS Plugins ==========-->
      <script type="text/javascript" src="MyCustom/js/digitClock.js"></script>
      <script type="text/javascript" src="MyCustom/jquery/jquery.min.js"></script>
      <script type="text/javascript" src="MyCustom/bootstrap/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="MyCustom/fileupload/bootstrap-fileupload.js"></script>
    </body>
  </html>
<?php } ?>
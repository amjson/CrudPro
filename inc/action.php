<?php
  /******************************************************
	********** inserting record in the database *********** 
	******************************************************/
  $my_user      = $_SESSION['email'];
  $get_user     = "SELECT * FROM users_records WHERE email='$my_user'";
  $run_user     = mysqli_query($con, $get_user);
  $row          = mysqli_fetch_array($run_user);
  $disp_my_name = $row['username'];

  if (isset($_POST['add'])) {
    $file = $_FILES['avatar'];
    $fileName    =  $_FILES['avatar']['name'];
    $fileTmpName =  $_FILES['avatar']['tmp_name'];
    $fileSize    =  $_FILES['avatar']['size'];
    $fileError   =  $_FILES['avatar']['error'];
    $fileType    =  $_FILES['avatar']['type'];

    $fileExt       =  explode('.', $fileName);
    $fileActualExt =  strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'jfif');

    if(in_array($fileActualExt, $allowed)) {
      if($fileError === 0) {
        if($fileSize < 10000000) {
          $fileNameNew = $fileName;
          $fileDestination = 'MyRecords/'.$fileNameNew;

          if (file_exists($fileDestination)) {
            echo "<script>alert('Error! Your Photo is in use already, Use new Photo')</script>";
            echo "<script>window.open('home.php?username=$disp_my_name', '_self')</script>";
          } 
          else {
            move_uploaded_file($fileTmpName, $fileDestination);

            $mymail  = $_POST['mymail'];
            $mytoken = $_POST['mytoken'];
            $name    = $_POST['name'];
            $email   = $_POST['email'];
            $phone   = $_POST['phone'];

            $sqlCheck = "SELECT * FROM crud WHERE name='$name' OR email='$email' OR phone='$phone'";
            $res = mysqli_query($con, $sqlCheck);
            $resCheck = mysqli_num_rows($res);

            if($resCheck > 0) {
              echo "<script>alert('Error! Your cridentials are in use in already, Use new cridentials')</script>";
              echo "<script>window.open('home.php?username=$disp_my_name', '_self')</script>";
              exit();    
            }
            else {
              $sqlInsert = "INSERT INTO crud(mymail,mytoken,name,email,phone,photo) 
              VALUES('$mymail','$mytoken','$name','$email','$phone','$fileDestination')";

              $verifyquery = mysqli_query($con, $sqlInsert);

              if ($verifyquery) {
                echo "<script>alert('Your Record was added Successfully.')</script>";
                echo "<script>window.open('home.php?username=$disp_my_name', '_self')</script>";
                exit();
              }
            }
          }
        }
        else {
          echo "<script>alert('Your file is too big')</script>";
          echo "<script>window.open('home.php?username=$disp_my_name', '_self')</script>";
          exit();
        }
      }
      else {
        echo "<script>alert('There was an error uploading your file')</script>";
        echo "<script>window.open('home.php?username=$disp_my_name', '_self')</script>";
        exit();
      }
    }
    else {
      echo "<script>alert('You cannot upload files of this type')</script>";
      echo "<script>window.open('home.php?username=$disp_my_name', '_self')</script>";
      exit();
    } 
  }


  /******************************************************
	********** deleting record from the database **********
	******************************************************/
	if(isset($_GET['delete'])) {
		$id = $_GET['delete'];

		//deleting the photo from the upload folder
		$queryPhoto = "SELECT photo FROM crud WHERE id='$id' ";
		$qphoto     = mysqli_query($con, $queryPhoto);
	         
		if(mysqli_num_rows($qphoto) > 0) {
			$row = mysqli_fetch_assoc($qphoto);
			$imagepath = $row['photo'];
			unlink($imagepath);  
		}

		//deleting the record from the database
		$queryDel = "DELETE FROM crud WHERE id='$id' ";
		$queryres = mysqli_query($con, $queryDel);

    if ($queryres) {
    	$user     = $_SESSION['email'];
			$get_user = "SELECT * FROM users_records WHERE email='".$user."' ";
			$run_user = mysqli_query($con, $get_user);
			$row      = mysqli_fetch_array($run_user);

			$username = $row['username'];

      echo "<script>alert('Your Record has been Deleted Successfully.')</script>";
			echo "<script>window.open('home.php?username=$username', '_self')</script>";
      exit(); 
    }
	}


	/******************************************************
	********** editing record from the database ***********
	******************************************************/
  if (isset($_POST['update'])) {
    $id       =  $_POST['id'];  
    $mymail   =  $_POST['mymail'];
    $name     =  $_POST['name'];
    $email    =  $_POST['email'];
    $phone    =  $_POST['phone'];
    $oldimage =  $_POST['oldimage'];

    $file = $_FILES['avatar'];
    $fileName    =  $_FILES['avatar']['name'];
    $fileTmpName =  $_FILES['avatar']['tmp_name'];
    $fileSize    =  $_FILES['avatar']['size'];
    $fileError   =  $_FILES['avatar']['error'];
    $fileType    =  $_FILES['avatar']['type'];

    $fileExt       =  explode('.', $fileName);
    $fileActualExt =  strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'jfif');

    if(in_array($fileActualExt, $allowed)) {
      if($fileError === 0) {
        if($fileSize < 10000000) {
          unlink($oldimage);
          
          $newFile = 'MyRecords/'.$fileName;
          if (file_exists($newFile)) {
            echo "<script>alert('Error! Your Photo is in use already, Use new Photo')</script>";
            echo "<script>window.open('home.php?username=$disp_my_name', '_self')</script>";
          } 
          else {
            move_uploaded_file($fileTmpName, $newFile);

            $sqlupdt = "UPDATE crud SET mymail='$mymail', name='$name',email='$email',phone='$phone',
            photo='$newFile' WHERE id='$id' ";

            $verifyquery = mysqli_query($con, $sqlupdt);

            if ($verifyquery) {
              echo "<script>alert('Your Record has been Edited Successfully.')</script>";
              echo "<script>window.open('home.php?username=$disp_my_name', '_self')</script>";
              exit();
            }
          }
        }
      }
    }
  }
?>
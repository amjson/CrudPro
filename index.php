<?php  
  include ("inc/middleMan.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="This is a Crud Project">
    <meta name="keywords" content="Crud">
    <meta name="author" content="Joeson Misiani">

    <title>Crud Project</title>

    <!-- Favicons -->
    <link rel="icon" href="MyCustom/images/aj.png" type="image/x-icon">

    <!--========== CSS & JQUERY ==========-->
    <link rel="stylesheet" href="MyCustom/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="MyCustom/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="MyCustom/fontawesome-free/css/v4-shims.min.css"> 
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

    * {
      margin: 0;
      padding: 0;
      outline:0;
      box-sizing: border-box;
    }
    a, a:hover {
      text-decoration: none; 
      outline:0; 
    }
    li {
      list-style: none;
    }
    body {
      margin:0;
      padding:0;
      border:0;
      outline:0;
      background-color: #ccc;
      overflow: hidden;
    }
    .digitSix {
      position: fixed;
      transform: translateX(560%) translateY(-85%);
      border: 1px solid transparent;
      padding: 0px 5px;
      text-align: right;
      font-size: 25px;
      font-weight: var(--fw-s4);
      font-family: var(--ff-clock);
      color:  var(--clr-dark);
    }
    .formPage {
      border: 1px solid transparent;
      box-shadow: var(--bs);
      background-color: var(--clr-light);
      width: 36%;
      height: 350px;
      margin-top: 160px;
      margin-left: 446px;
      border-radius: 3px;
    }
    .max-width {
      display: flex;
      justify-content: space-between;
      border: 1px solid transparent;
      width: 90%;
      height: 80px;
      margin-left: 26px;
      padding-left: 0;
      padding-right: 0;
    }
    .blur,.focused {
      position: relative;
      font-weight: var(--fw-s4);
      margin: 0px;
      background: none;
      font-family: var(--ff-secondary);
      color: var(--clr-light);
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }
    .section_logo {
      border: 1px solid transparent;
      margin-top: 35px;
      margin-left: -260px;
      width: 8em;
      height: 29px;
      cursor: pointer;
    }
    .section_logo-big {
      position: relative;
      width: 100%;
      text-align: center;
    }
    .section_logo-big .blur {
      position: absolute;
      top: 0;
      line-height: 27px;
      font-size: 1.7em;
      width: 100%;
    }
    .section_logo-big .blur a {
      color: #999;
      opacity: .6;
    }
    .section_logo-small {
      display: inline-block;
    }
    .focused a {
      color: var(--clr-dark);
      letter-spacing: 1.7px;
    }
    .section_logo-small strong {
      color: var(--clr-dodger);
      opacity: 0.9;
    }
    .section_logo-big h3 {
      margin-top: 4px;
      padding-top: 4px;
      padding-left: 5px;
      padding-right: 4px;
      padding-bottom: 5px;
      line-height: 10px;
      position: relative;
      display: inline-block;
      font-size: .9em;
    }
    .section_logo-big .focused:before {
      bottom: 0;
      left: 0;
      content: '';
      position: absolute;
      width: 8px;
      height: 8px;
      opacity: 1;
      border-bottom: 1px solid var(--clr-dodger);
      border-left: 1px solid var(--clr-dodger);
    }
    .section_logo-big .focused:after {
      top: 0;
      right: 0;
      content: '';
      position: absolute;
      width: 8px;
      height: 8px;
      opacity: 1;
      border-top: 1px solid var(--clr-dodger);
      border-right: 1px solid var(--clr-dodger);
    }
    .dropMenu {
      border: 1px solid transparent;
      height: 30px;
      width: 35px;
      margin-top: 35px;
      margin-right: -260px;
    }
    .dropMenu .caret {
      border:1px solid transparent;
      height: 28px;
      width: 33px;
      margin-top: 0px;
      margin-left: 0px;
      float: left;
      font-family: Bookman Old Style;
      font-size: 18px;
      padding-top: 2px;
      padding-left: 15px;
    }
    .dropMenu .caret a {
      margin-left: -14px;
      color: rgba(0,0,0,.7);
      cursor: pointer;
    }
    .dropMenu .caret .drop_me_down {
      margin-left: -140px;
      padding-left: 25px;
      width: 170px;
      box-shadow: var(--bs);
    }
    .dropMenu .caret .drop_me_down .locate {
      font-family: Bookman Old Style;
      font-size: 18px;
    }
    form {
      border: 1px solid transparent;
      background-color: transparent;
      width: 90%;
      height: 260px;
      margin-top: -20px;
      margin-left: 26px;
      padding-top: 0px;
      padding-left: 10px;
      padding-right: 10px;
      overflow: hidden;
    }
    .job_body {
      border: 1px solid transparent;
      height: 100%;
    }
    .title {
      width: 100%;
      height: 37px;
      border: 1px solid transparent;
      background-color: transparent;
      padding-left: 10px;
      text-align: center;
    }
    .title h4 {
      border: none;
      box-sizing: border-box;
      background: transparent;
      width: 95%;
      outline: none;
      color: var(--clr-dark);
      font-family: var(--ff-secondary);
      font-size: 25px;
      font-weight: var(--fw-s3);
      text-transform: uppercase;
      letter-spacing: 2px;
      margin-top: 0;
    }
    .middleFirst {
      border: 1px solid transparent;
      width: 100%;
      height: 40px;
      margin-top: 5px;
    }
    .middleSecond {
      margin-top: 14px;
    }
    .job_body input {
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
    .job_body input:focus {
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
    .encrypt {
      position: relative;
      border: 1px solid transparent;
      width: 37px;
      height: 37px;
      margin-top: -37px;
      margin-left: 380px;
    }
    .encrypt i {
      position: absolute;
      top: 0;
      left: 0;
      border: 1px solid transparent;
      padding-top: 10px;
      padding-left: 10px;
      padding-bottom: 10px;
      padding-right: 23px;
      color: rgba(0,0,0,.6);
    }
    #hide1 {
      display: none;
    }
    .finalise {
      width: 100%;
      height: 40px;
      border: 1px solid transparent;
      background-color: transparent;
      margin-top: 35px;
      padding-left: 39%;
    }
    .finalise .submit {
      background: var(--clr-dodger);
      border-color: transparent;
      border-radius: 3px;
      color: var(--clr-light);
      font-size: 17px;
      letter-spacing: 2px;
      height: 30px;
      width: 37%;
      margin-top: 6px;
      font-family: var(--ff-secondary);
      font-weight: var(--fw-s3); 
      padding-top: 0px;
    }
    .finalise .submit:hover {
      cursor: pointer;
      background: var(--clr-dodger);
      opacity: .8;
    }
  </style>
  
  <body>
    <section>
      <div id="MyClockDisplay" class="digitSix"></div>

      <div class="formPage">
        <nav class="navbar navbar-expand-lg max-width">
          <div class="section_logo">
            <div class="section_logo-big"> 
              <h1 class="blur"><a href="index.html">CrudPro</a></h1>

              <h3 class="focused">
                <a href="index.html">
                  <span class="section_logo-small">Crud<strong>Pro</strong></span>
                </a>
              </h3>
            </div>
          </div> 

          <ul class="dropMenu">
            <li class='nav-item dropdown caret'>
              <a class='nav-link' id='navbarDropdownProfile' data-toggle='dropdown'
              aria-haspopup='true' aria-expanded='false'>
                <i class='fa fa-sign-in fa-lg fa-fw' aria-hidden='true'></i>
              </a>

              <div class='dropdown-menu dropdown-menu-right drop_me_down' 
              aria-labelledby='navbarDropdownProfile'>
                <a class='dropdown-item locate' href='signup.php'>Signup</a><br>
                <a class='dropdown-item locate' href='request.php'>Forgot Password</a>
              </div>
            </li>
          </ul>
        </nav>

        <form action="" method="POST" autocomplete="off">             
          <div class="job_body">
            <div class="title"><h4>Signin</h4></div>

            <div class="middleFirst">
              <div class="inputWithIcon inputIconBg">
                <input type="text" name="email" placeholder="someone@email.com">
                <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true" 
                style="margin-top:3px;"></i>
              </div>
            </div>

            <div class="middleSecond">
              <div class="inputWithIcon inputIconBg">
                <input type="password" name="upwd" id="pwd" placeholder="Password">
                <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
              </div>

              <div class="encrypt dencrypt" onclick="myFunction()">
                <i class="fa fa-eye fa-lg fa-fw" id="hide1" aria-hidden="true"></i>
                <i class="fa fa-eye-slash fa-lg fa-fw" id="hide2" aria-hidden="true"></i>
              </div>
            </div>

            <div class="finalise">
              <input type="submit" class="form-control submit" name="signin" value="signin">
            </div>
          </div>
        </form>
      </div>
    </section>

    <!--========== JS Plugins ==========-->
    <script type="text/javascript" src="MyCustom/js/digitClock.js"></script>
    <script>
      function myFunction() {
        var x = document.getElementById("pwd");
        var y = document.getElementById("hide1");
        var z = document.getElementById("hide2");

        if (x.type === 'password') {
          x.type = "text";
          y.style.display = "block";
          z.style.display = "none";
        }
        else {
          x.type = "password";
          y.style.display = "none";
          z.style.display = "block";
        }
      }
    </script>
  </body>
</html>
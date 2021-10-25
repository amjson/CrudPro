<style>
  nav .outerLayer {
    border: 1px solid transparent;
    width: 88%;
    padding-left: 0;
    padding-right: 0;
    display: flex;
    justify-content: space-between;
    margin: auto;
    height: 100%;
  }
  nav .outerLayer .logo {
    border: 1px solid transparent;
    font-family: var(--ff-secondary);
    font-weight: var(--fw-s4);
    font-size: 1.5em;
    color: var(--clr-light);
    cursor: pointer;
    height: 58px;
    line-height: 58px;
  }
  nav .outerLayer .logo span {
    color: var(--clr-dodger);
  }
  nav .outerLayer .menu {
    border: 1px solid transparent;
    font-family: var(--ff-secondary);
    font-weight: var(--fw-s3);
    height: 58px;
    line-height: 58px;
    display: flex;
  }
  nav .outerLayer .menu  li {
    border: 1px solid transparent;
    margin-left: 10px;
    margin-right: 10px;
  }
  nav .outerLayer .menu  li a {
    font-size: 16px;
    color: var(--clr-light);
    transition: .4s ease;
  }
  nav .outerLayer .menu  li a:hover {
    color: var(--clr-dodger);
  }

  .clock {
    border: 1px solid transparent;
    height: 58px;
    line-height: 58px;
    font-size: 25px;
    font-family: var(--ff-clock);
    color: var(--clr-light);
  }

  .top-right{
    border: 1px solid transparent;
    height: 100%;
    display: flex;
  }
  .my_pic{
    border: 1px solid white;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    margin-top: 10px;
  }            
  .my_pic img{
    width: 100%;
    height: 100%;
    border-radius:50%;
  }
  .my_name{
    border:1px solid transparent;
    height: 56px;
    line-height: 56px;
    font-family: ubuntu;
    font-size: 18px;
    color: #fff;
    padding-left: 10px;
    padding-right: 10px;
  }
  .my_form{
    border: 1px solid transparent;
    height: 56px;
    padding-left: 15px;
    padding-right: 15px;
  }
  .my_form button{
    border: none;
    border-radius: 50px;
    font-size: 16px;
    color: white;
    font-family: ubuntu;
    background-color: dodgerblue;
    margin-top: 11px;
    padding: 5px 15px;
  }
  .my_form button:hover{
    color: white;
    background-color: dodgerblue;
    opacity: .8;
  }  
</style>

<header class="outerLayer">
  <?php
    $user     = $_SESSION['email'];
    $get_user = "SELECT * FROM users_records WHERE email='$user'";
    $run_user = mysqli_query($con, $get_user);
    $row      = mysqli_fetch_array($run_user);
    $username = $row['username'];
    $myToken  = $row['token'];
    $profile  = $row['profile'];

    if(isset($_POST['logout'])) {
      $user      = $_SESSION['email'];
      $get_user  = "SELECT * FROM users_records WHERE email='$user'";
      $run_user  = mysqli_query($con, $get_user);
      $row       = mysqli_fetch_array($run_user);
      $my_name   = $row['username'];
      
      $Offline    = "UPDATE users_records SET status='Offline' WHERE username='".$my_name."' ";
      $update_msg = mysqli_query($con, $Offline);
      
      echo "<script>window.open('inc/logout.inc.php', '_self')</script>"; 
    }
  ?>        

  <div class="logo">
    <span>Crud</span>pro<span>.</span>
  </div> 
  
  <ul class="menu">
    <li><a href='home.php?username=<?=$username; ?>'>Home</a></li>
    <li><a href='settings.php?token=<?=$myToken; ?>'>Settings</a></li>
  </ul>

  <div id="MyClockDisplay" class="clock"></div>
  <script type="text/javascript">
    function showTime(){
      var date = new Date();
      var h = date.getHours(); //from 0 - 23 hours
      var m = date.getMinutes(); //from 0 - 59 minutes
      var s = date.getSeconds(); //from 0 - 59 seconds
      var session = "AM";

      if (h == 0){ h = 12; }
      if (h > 12){ h = h - 12; session = "PM"; }

      h = (h < 10) ? "0" + h : h;
      m = (m < 10) ? "0" + m : m;
      s = (s < 10) ? "0" + s : s;

      var time = h + ":" + m + ":" + s + " " + session;
      //for different browser of users
      document.getElementById("MyClockDisplay").innerText = time;
      document.getElementById("MyClockDisplay").textContent = time;

      //1000 milliseconds
      setTimeout(showTime, 1000); 
    }

    showTime();
  </script>

  <div class="top-right">
    <div class='my_pic'><img src='<?= $profile; ?>'></div>
    
    <div class='my_name'><?= $username; ?></div>

    <div class='my_form'>
      <form action='' method='post'>
        <button name='logout'>Logout</button>
      </form>
    </div>

  </div>
</header>
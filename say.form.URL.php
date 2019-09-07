<?php
    session_start();
    include_once 'pdoAllusers.php';
      $name = $_SESSION['full_name'];
      $email = $_SESSION['email_id'];
      $user_name = $_SESSION['user_name'];
      $password = $_SESSION['password'];
     // print_r($_SESSION);
      
?>
<!DOCTYPE html>
<html>
<head>
      <title>Dymanic Form Builder - dashboard</title>
      <link rel="stylesheet" type="text/css" href="css/styledashboard.css">
</head>
<body>
      <header>
            <h1><a href="index.php">Dynamic Forms</a></h1>
            <form action="logout.inc.php" method="POST">
            <table>
                  <tr>
                        <td><?php
            if ( isset($_SESSION["user_name"]) ) {
             //echo($_SESSION["user_name"]." | ");
              echo('<a href="dashboard.php" style="font-size:150%">'.$user_name.' | </a>');
             }
            ?></td>
                        <td><button type="submit" name="LogOut">Log out</button></td>
                  </tr>
            </table>
            </form>
      </header><br>
     
      <section>
        <center>
        <h2>Your form has been successfully created!</h2>
        <hr>
        <h3 style="color:#009688">Title: <u><?php echo $_SESSION['title']?></u></h3>
        <h3 style="color:#009688"><?php echo $_SESSION['description']?></h3>
        <h4>Share your form URL with everyone to fill in</h4>
        <p style="color:purple">
          <?php 
          echo $_SERVER['HTTP_HOST'].$_SESSION['form_url'];
          //echo $num;
          //echo "<pre>";
          //print_r($_SERVER);
          //.$_SESSION['form_url']
          ?></p>
        <hr>
        </center>
        <!--<a href="dashboard.php" style="float:right">back to dashboard</a>-->
      </section>
    
</body>
</html>
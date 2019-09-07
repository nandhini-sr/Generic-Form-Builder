<?php
    session_start();
    include_once 'pdoAllusers.php';
      $name = $_SESSION['full_name'];
      $email = $_SESSION['email_id'];
      $user_name = $_SESSION['user_name'];
      $password = $_SESSION['password'];
      //print_r($_SESSION);
      
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
            if ( isset($_SESSION["user_name"]) ) 
            {
             //echo($_SESSION["user_name"]." | ");
              echo('<a href="dashboard.php" style="font-size:150%">'.$user_name.' | </a>');
            }
            ?></td>
                        <td><button type="submit" name="LogOut">Log out</button></td>
                  </tr>
            </table>
            </form>
      </header><br>
<section id="middle">
  <h2>Create a new form</h2>
  <button type="submit" name="new_form" onclick="openPop();"><img src="images/blank.png"></button>
  <h2>Forms created till now:</h2>
  <?php
        $sqlf = "SELECT user_id from users where user_name = '$user_name';";
        $stmtf = $pdo->query($sqlf);
        $user_id = $stmtf->fetchColumn();


        $sqls = "SELECT form_id,form_title,form_URL,fsub_URL from forms where owner_id=$user_id;";
        $stmt = $pdo->query($sqls);
        if($stmt->rowCount()<1)
        {
            echo "<p>No form created yet!</p>";
        }
        else
        {
              echo "<table border='1'>
                    <tr>
                    <td>Form Title</td>
                    <td>Form URL</td>
                    <td>Submissions URL</td>
                    </tr>";
              while($tupple = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                $form_id = $tupple["form_id"];
                $form = "show.form.php?form_id=".$form_id;
                $sub = "show.submissions.php?form_id=".$form_id;
                echo "<tr><td>";
                echo($tupple['form_title']);
                echo("</td><td>");
                //echo($tupple['form_URL']);
               // echo "$form_id";
                echo('<a href="'.$form.'">'.$tupple["form_URL"].'</a>');
                echo("</td><td>");
                 echo('<a href="'.$sub.'">'.$tupple["fsub_URL"].'</a>');
                echo("</td></tr>");
              }
              echo "</table>";
        }

  ?>
</section>

<!--pop up modal -->
      <center>
      <div class="modal" id="modal">
            <div class="modal__dialog">
                  <section class="modal__content">
                        <a href="#" class="modal__close" onclick="exit()">&times;</a>
                        <h2 class="modal__title" style="color:#009688;">Enter Form Details</h2>  
                              <form action="create.form.php" method="POST">
                              <label for="title"><b>Title:</b> <input type="text" name="title" required></label><br>
                              <?php
                              if ( isset($_SESSION["titleCheck"]) ) 
                              {
                              echo('<b><p style="color:red;font-size:70%;">'.$_SESSION["titleCheck"]."</p></b>");
                              }
                              elseif( isset($_SESSION["titletaken"]) ) 
                              {
                              echo('<b><p style="color:red;font-size:70%;">'.$_SESSION["titletaken"]."</p></b>");
                              }?>
                              <br>
                              <label for="description"><b>Description:</b><br>
                              <textarea rows="5" cols="30" name="description" required></textarea></label><br>
                              <?php
                              if ( isset($_SESSION["descriptionCheck"]) ) 
                              {
                              echo('<b><p style="color:red;font-size:70%;">'.$_SESSION["descriptionCheck"]."</p></b>");
                              }?><br>
                              <label for="deadline"><b>Form Deadline:</b>
                              <input type="date" name="deadline" required></label><br>
                              <?php
                              if ( isset($_SESSION["dateCheck"]) ) 
                              {
                              echo('<b><p style="color:red;font-size:70%;">'.$_SESSION["dateCheck"]."</p></b>");
                              }?>
                              <br>
                              <button type="submit" name="createForm" id="createForm">Create Form</button>
                              </form>
                              <br><br>
                  </section>
            </div>
      </div>
</center>
      <!--end pop up modal-->     
      

      <script type="text/javascript" src="javascript/popupModal.js"></script>
      <?php
       if ( isset($_SESSION["titleCheck"]) ) {
             echo "<script>openPop();</script>";
             unset($_SESSION["titleCheck"]);
             }
      elseif ( isset($_SESSION["descriptionCheck"]) ) {
             echo "<script>openPop();</script>";
             unset($_SESSION["descriptionCheck"]);
             }
      elseif ( isset($_SESSION["dateCheck"]) ) {
             echo "<script>openPop();</script>";
             unset($_SESSION["dateCheck"]);
             }
      ?>
      
      
      

</body>
</html>
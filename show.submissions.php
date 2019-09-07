<?php
session_start();
	include_once 'pdoAllusers.php';
	//echo "<br>session<br>";
	//print_r($_SESSION);
	//echo "<br>post<br>";
	//print_r($_POST);
	//echo "<br>get<br>";
	//print_r($_GET);
	$form_id = $_GET['form_id'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dymanic Form Builder - buildForm</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="css/styledashboard.css">
        <header>
            <h1><a href="index.php">Dynamic Forms</a></h1>
            <form action="logout.inc.php" method="POST">
            <table>
                <tr>
                <td>
                <?php
                if (isset($_SESSION["user_name"]) ) 
                {
                  $user_name = $_SESSION['user_name'];
                  //echo($_SESSION["user_name"]." | ");
                  echo('<a href="dashboard.php" style="font-size:150%">'.$user_name.' | </a>');
                  echo "</td>";
                  echo '<td><button type="submit" name="LogOut">Log out</button></td>';
                  echo "</tr>";
                }
                ?>
            </table>
            </form>
        </header>

        <section>
        	<?php
        	/*$sqlf = "SELECT user_id from users where user_name = '$user_name';";
        	$stmtf = $pdo->query($sqlf);
        	$user_id = $stmtf->fetchColumn();*/

          if(!isset($_SESSION["user_name"]))
          {
                echo "<center><h2>LOG in to view submissions</h2>";
                echo '<a href="index.php" style="color:purple">back to index</a></center>';
          }
          else
          {
              $user = $pdo->query( "SELECT user_id from users where user_name = '$user_name'")->fetchColumn();
              $owner = $pdo->query( "SELECT owner_id from forms WHERE form_id=$form_id")->fetchColumn();
              //check for authorisation
              if($user != $owner)
              {
                  echo "<center><h4 style='color:red'>SECURITY: Only the user who created this form can view responses</h4>";
                  echo "<b>AUTHORIZATION CHECK: Can't display submissions page</b></center>";

              }
              else
              {
                  $sqlt = "SELECT form_title from forms where form_id = '$form_id'";
                  $stmtt = $pdo->query($sqlt);
                  echo "<center><h2>TITLE: ";
                  echo  $stmtt->fetchColumn();
                  echo "</h2>";
                  $sqldes = "SELECT form_description from forms where form_id = '$form_id';";
                  $stmtdes = $pdo->query($sqldes);
                  echo $stmtdes->fetchColumn();
                  echo "<br><br>";
                  echo"<b>User Responses:</b>";
                  echo"<hr></center>";

                  $sqlr = "SELECT * from form_inputs where form_id = '$form_id';";
                  $stmtr = $pdo->query($sqlr);
                  $total_questions = $stmtr->rowCount();

                  $sqld = "SELECT * from responses WHERE form_id=$form_id";
                  $stmtd = $pdo->query($sqld);
                  if($stmtd->rowCount()<1)
                  {
                      echo "<center><p>No responses yet!</p></center>";
                  }
                  else
                  {
                    for($i=1;$i<=$total_questions;$i++)
                    {
                      echo "<div style='margin-left:550px'>";
                      $sqle = "SELECT * from responses WHERE form_id=$form_id AND question_no=$i";
                      $stmte = $pdo->query($sqle);
                      echo "<b>Q$i)&nbsp&nbsp";
                      $sqlq = "SELECT question from form_inputs WHERE form_id=$form_id AND question_no=$i";
                      $stmtq = $pdo->query($sqlq);
                      echo"<u>";
                      echo ($stmtq->fetchColumn());
                      echo"</u></b><br>";
                      while($tupple = $stmte->fetch(PDO::FETCH_ASSOC))
                      {
                        echo($tupple['user_response']);
                        echo"<br>";
                      }
                      echo "</div>";
                      echo"<hr>";
                    }
                  }
              }
          }

	        ?>
        </section>

</body>
</html>
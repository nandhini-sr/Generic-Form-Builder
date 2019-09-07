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

	//$user_name = $_SESSION['user_name'];
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
        	$sqlf = "SELECT * from forms where form_id = '$form_id';";
        	$stmtf = $pdo->query($sqlf);
        	if($stmtf->rowCount()<1)
	        {
	           echo "<center><b><p style='color:red'>This form is not created yet!</p></b></center>";
	        }
	        else
	        {
	        	$sqlt = "SELECT form_title from forms where form_id = '$form_id';";
        	$stmtt = $pdo->query($sqlt);
        	echo "<center><h2>TITLE: ";
        	echo  $stmtt->fetchColumn();
        	echo "</h2>";

        	$sqldes = "SELECT form_description from forms where form_id = '$form_id';";
        	$stmtdes = $pdo->query($sqldes);
        	echo $stmtdes->fetchColumn();
        	echo "<br><br><hr></center>";

        	$sqldate = "SELECT form_deadline from forms where form_id = '$form_id';";
        	$stmtdate = $pdo->query($sqldate);
        	$deadline_for_form = $stmtdate->fetchColumn();
        	
        	if(date('Y-m-d')>$deadline_for_form)
        	{
        		echo "<center><b><p style='color:red'>Form deadline was $deadline_for_form! You can no longer fill in responses.</p></b></center>";
        	}
        	else
        	{
        		echo '<form action="submit.php" method="POST" style="margin-left:550px">';

	        	$sqld = "SELECT * from form_inputs WHERE form_id=$form_id";
	        	//$sqld = "SELECT question_no,question,input_type_id from form_inputs WHERE form_id=$form_id";
	        	$stmtd = $pdo->query($sqld);
	        	if($stmtd->rowCount()<1)
		        {
		            echo "<b><p style='color:red'>No questions were added to the form</p></b>";
		        }
		        else
		        {
		        	while($tupple = $stmtd->fetch(PDO::FETCH_ASSOC))
	              {
	              	$question_no = $tupple['question_no'];
	              	echo "$question_no) ";
	              	echo($tupple['question']);
	                echo"&nbsp&nbsp&nbsp&nbsp";
	              	if($tupple['input_type_id'] == 1)
	              	{
	              		echo "<input type='text' name='ques/$question_no' placeholder='answer $question_no' required>";
	              	}
	              	else if($tupple['input_type_id'] == 2)
	              	{
	              		echo "<br><br><textarea rows='5' cols='30' name='ques/$question_no' placeholder='answer $question_no' required></textarea>";
	              	}
	              	else if($tupple['input_type_id'] == 3)
	              	{
	              		echo "<input type='number' name='ques/$question_no' placeholder='answer $question_no' required>";
	              	}
	              	else if($tupple['input_type_id'] == 4)
	              	{
	              		echo "<input type='time' name='ques/$question_no' required>";
	              	}
	              	else if($tupple['input_type_id'] == 5)
	              	{
	              		echo "<input type='date' name='ques/$question_no' required>";
	              	}

	              	if ( isset($_SESSION["validation/".$question_no]) ) {
	             	echo('<p style="color:red;font-size:70%;"><b>'.$_SESSION["validation/".$question_no]."</b></p>");
	             	unset($_SESSION["validation/".$question_no]);
	             	}

	                //echo($tupple['question_no']);
	                //echo($tupple['input_type_id']);
	                echo("<br><br>");

	              }
	              $_SESSION['form_id']=$form_id;
	        	  echo '<input type="submit" name="setResponse">';
		        }

	        	}
	        }

        	?>
           	
        </form>
        </section>





</body>
</html>
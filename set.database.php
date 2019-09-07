<?php
session_start();
include_once 'pdoAllusers.php';
$title = $_SESSION['title'];

//echo "<br>session<br>";
//print_r($_SESSION);
//echo "<br>post<br>";
//print_r($_POST);
//echo "<br>cookie<br>";
//print_r($_COOKIE);

if(isset($_POST['done']))
{
	 if (count($_POST) <= 1)
	 {
	 	$_SESSION["NOque"] = "Add Questions to create the form!";
	 	header("Location: build.form.php");
		return;
	 }

	 else
	 {
	 	$sqlf = "SELECT form_id from forms where form_title = '$title';";
	    $stmtf = $pdo->query($sqlf);
	    $form_id = $stmtf->fetchColumn();

		foreach( $_POST as $stuff => $val ) 
		{
			//if($stuff[strlen($stuff) - 2] == 'e')//if answerType#
			if($stuff[0] == 'a')
			{
				//$question_no_prev = (int)$stuff[strlen($stuff)-1];
				$question_no = preg_replace("/[^0-9]/", '', $stuff);
				//echo preg_replace("/[^0-9]/", '', $string);
				
				//echo "$stuff<br>";
				//echo "$question_no<br>";
				//echo "prev: $question_no_prev<br>";

				$sqlc = "INSERT INTO form_inputs (form_id,question_no,input_type_id) VALUES (:form_id,:question_no,:val)";
				$stmtc = $pdo->prepare($sqlc);
				$stmtc->execute(array(
						':form_id' => $form_id,
						':question_no'=>$question_no,
						':val'=>$val
						));			
			}
			else if($stuff[0] == 'q') //if question#
			{
				//$question_no = (int)$stuff[strlen($stuff)-1];
				$question_no = preg_replace("/[^0-9]/", '', $stuff);

				$sqlc = "UPDATE form_inputs SET question = '$val' where form_id = $form_id AND question_no = $question_no";
				$stmtc = $pdo->prepare($sqlc);
				$stmtc->execute();	
			}	    
		}
		header("Location: say.form.URL.php");
		return;
	 }
}
else
{
	header("Location: index.php?Click_createForm_only");
	return;
}
?>


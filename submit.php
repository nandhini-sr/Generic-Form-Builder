<?php
	session_start();
	include_once 'pdoAllusers.php';
	//echo "<br>session<br>";
	//print_r($_SESSION);
	//echo "<br>post<br>";
	//print_r($_POST);
	$form_id = $_SESSION['form_id'];

	if(isset($_POST['setResponse']))
	{

	    $today_date = date('Y-m-d');
	    $sqls = "SELECT question_no from form_inputs WHERE form_id=$form_id AND (input_type_id='1' OR input_type_id='2')";
        $stmts = $pdo->query($sqls);
        while($tupple = $stmts->fetch(PDO::FETCH_ASSOC))
        {
           $qno = $tupple['question_no'];
          
           if(!preg_match("/^[a-zA-Z\s]*$/", $_POST['ques/'.$qno]))
			{
				$_SESSION["validation/".$qno] = "a-z A-Z only valid";
				header("Location: show.form.php?form_id=".$form_id);
				return;
			}
        }
       
		foreach( $_POST as $stuff => $val ) 
		{

			
			$question_no = preg_replace("/[^0-9]/", '', $stuff);
			if($question_no != 0)
			{
				$sql = "INSERT INTO responses (form_id,question_no,user_response,submit_date) VALUES (:form_id,:question_no,:user_response,:submit_date)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(
					':form_id' => $form_id,
					':question_no'=>$question_no,
					':user_response'=>$val,
					':submit_date'=>$today_date
					));	
			}		
			
		}
		header("Location: form.submit.success.php");
		return;
	}
	else
	{
		header("Location: goBackPage.php");
		return;
	}


?>
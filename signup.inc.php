<?php

session_start();

if(isset($_POST['SignUp']))
{
	include_once 'pdoAllusers.php';
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
     
    //ERROR HANDLERS

    //Check for empty field again
	if(empty($name) || empty($email) || empty($username) || empty($password) || empty($confirm))
	{
			$_SESSION["emptyCheck"] = "Please fill in all fields below";
			header("Location: index.php"); 
			return;
	}
	else
	{
		//check if input characters are valid - name
		if(!preg_match("/^[a-zA-Z\s]*$/", $name))
		{
			$_SESSION["nameCheck"] = "a-z A-Z only valid";
			header("Location: index.php");
			return;
		}
		else
		{
			//check email
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$_SESSION["emailCheck"] = "Please enter valid email-id";
                header("Location: index.php");
                return;
			}

			else
			{
				if($password!=$confirm)
				{
					$_SESSION["confirmCheck"] = "Confirm password doesn't match";
					header("Location: index.php");
					return;
				}

				else
				{
                //check for same username
               		$sql = "SELECT * from users where user_name = :user_name";
			   		$result = $pdo->prepare($sql);
			   		$result->execute(array(
						':user_name' => $username
					));
			   		if($result->rowCount()>0)
					{
						//unique username always
						$_SESSION["usertaken"] = "Your username is taken! Enter an unique username ";
						header("Location: index.php");
						return;
					}
					else
					{
						//HASHING PASSWORD
						$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
						//insert the user into the database
						$sql = " INSERT INTO users (full_name,email_id,user_name,password) VALUES (:full_name,:email_id,:user_name,:pass_word);";
					
						$stmt = $pdo->prepare($sql);
						$stmt->execute(array(
							':full_name' => $name,
							':email_id'=>$email,
							':user_name'=>$username,
							':pass_word'=>$hashedPwd
						));

                        $_SESSION['newUser'] = $name;                   
						header("Location: signupsuccess.php");
						return;
					}
				}
			}
		}
	}
}
else
{
	header("Location: index.php?Click_signup_only");
	return;
}

?>
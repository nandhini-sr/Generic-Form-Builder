<?php
include_once 'pdoAllusers.php';
session_start();

    $user_name = $_SESSION['user_name'];
    

    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
   

if ( isset($_POST['createForm'])) 
{

    // Error Handlers
    // Check name 
    if(!preg_match("/^[a-zA-Z\s0-9]*$/", $title))
    {
        $_SESSION["titleCheck"] = "a-z A-Z 0-9 only valid";
        header("Location: dashboard.php");
        return;
    }

    else
    {
        //check description
        if(!preg_match("/^[a-zA-Z\s0-9]*$/", $description))
        {
            $_SESSION["descriptionCheck"] = "a-z A-Z 0-9 only valid";
            header("Location: dashboard.php");
            return;
        }

        else
        {
            //check deadline
            if($deadline<date('Y-m-d'))
            {
                //echo $deadline;
                //echo "<br>";
                //echo date('Y-m-d');
                $_SESSION["dateCheck"] = "Enter correct deadline";
                header("Location: dashboard.php");
                return;
            }

            else
            {
                $sqlf = "SELECT user_id from users where user_name = '$user_name';";
                $stmtf = $pdo->query($sqlf);
                $owner_id = $stmtf->fetchColumn();
                
                $sql = "INSERT INTO forms (form_title,form_description,owner_id,form_deadline) VALUES (:title, :description, :owner_id,:form_deadline)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':title' => $title,
                    ':description' => $description,
                    ':owner_id'=>$owner_id,
                    ':form_deadline'=>$deadline
                ));

                $sqls = "SELECT * from forms";
                $stmts = $pdo->query($sqls);
                $now_form_id = $stmts->rowCount();
                //echo"<pre>";
                //print_r($_SERVER);
                //$URL = http\:\/\/localhost/Delta%20Inductions/show.form.php?form_id=$now_form_id;
                //$URL =  $_SERVER['HTTP_ORIGIN'];
                //$URL = $URL . '/Delta%20Inductions/show.form.php?form_id='.$now_form_id;
                $URL = '/Delta%20Inductions/show.form.php?form_id='.$now_form_id;
                //echo $URL;

                //$sub_URL =  $_SERVER['HTTP_ORIGIN'];
                //$sub_URL = $sub_URL . '/Delta%20Inductions/show.submissions.php?form_id='.$now_form_id;
                $sub_URL = '/Delta%20Inductions/show.submissions.php?form_id='.$now_form_id;

                $sqlu = "UPDATE forms SET form_URL = '$URL' WHERE form_id = $now_form_id";
                $stmtu = $pdo->prepare($sqlu);
                $stmtu->execute();

                $sqlua = "UPDATE forms SET fsub_URL = '$sub_URL' WHERE form_id = $now_form_id";
                $stmtua = $pdo->prepare($sqlua);
                $stmtua->execute();

                $_SESSION['title'] = $title;
                $_SESSION['description']=$description;
                $_SESSION['deadline']=$deadline;
                $_SESSION['form_url']=$URL;
                $_SESSION['form_sub_url']=$sub_URL;

                header( 'Location: build.form.php' );
                return;
            }
        
        }
            
    }
}

else
{
    header("Location: dashboard.php?Click_CreateForm_only");
    return;
}

?>


<?php
session_start();
//print_r($_SESSION);
//print_r($_POST);
//print_r($_COOKIE);

$selected = '';
function get_options($select)
{
  $answerType = array('short answer'=>'1','paragraph'=>'2','number'=>'3', 'time'=>'4','date'=>'5');
  $options='';
  while(list($k,$v)=each($answerType))
  {
    if($select == $v)
    {
      $options.='<option value="'.$v.'" selected>'.$k.'</option>';
    }

    else
    {
      $options.='<option value="'.$v.'">'.$k.'</option>';
    }
  }
  return $options;
}

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
                        <td><?php
            if ( isset($_SESSION["user_name"]) ) {
              $user_name = $_SESSION['user_name'];
             //echo($_SESSION["user_name"]." | ");
              echo('<a href="dashboard.php" style="font-size:150%">'.$user_name.' | </a>');
             }
            ?></td>
                        <td><button type="submit" name="LogOut">Log out</button></td>
                  </tr>
            </table>
            </form>
        </header><br>
        <center>
          <h2 style="color:#009688">Title: <u><?php echo $_SESSION['title']?></u></h2>
        <h4 style="color:#009688"><?php echo $_SESSION['description']?></h4>
        <form action="set.database.php" method="POST" style="margin:20px" id="main_form" name="main_form">
          <select  onchange="displayInput(this.value,this.id)" id="answerType0">
        <?php 
        echo get_options($selected);
        ?>    
        </select>
        <button onclick="addQuestion(); return false;">Add Question</button>
        <input type="submit" name="done" value="Create Form"><br>
        <?php
        if ( isset($_SESSION["NOque"]) ) {
             echo('<p style="color:red;font-size:70%;"><b>'.$_SESSION["NOque"]."</b></p>\n");
             unset($_SESSION["NOque"]);
             } ?>
        </form>
        </center>

        <script type="text/javascript" src="javascript/append.question.js"></script>
        
</body>
</html>
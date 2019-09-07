<?php
session_start();
include_once "build.form.php";
$selected = '';
if(isset($_POST['answerType']))
{
  //echo $_POST['countries'];
  $selected = $_POST['answerType'];
  //echo $selected;
  if($selected == '1')
  {
         $_SESSION['inputType'] = "<input type='text' name='text' placeholder='short answer preview'>";
         $_SESSION['answerType'] = $selected;
         header("Location: build.form.php");
         return;
        // echo "Input Name: <input type='text' name='name'>";
  }
  elseif($selected == '2')
  {
    $_SESSION['inputType'] = '<textarea rows="5" cols="30" name="description" placeholder="paragraph answer preview"></textarea>';
    $_SESSION['answerType'] = $selected;
         header("Location: build.form.php");
         return;
    //echo 'Input paragraph: <textarea rows="5" cols="30" name="description" required></textarea>'; 
  }
  elseif($selected == '3')
  {
    $_SESSION['inputType'] = '';
    $_SESSION['answerType'] = $selected;
         header("Location: build.form.php");
         return;
    //multiple choice
  }
  elseif($selected == '4')
  {
    $_SESSION['inputType'] = '';
    $_SESSION['answerType'] = $selected;
         header("Location: build.form.php");
         return;
    //multiple choice
  }
  elseif($selected == '5')
  {
    $_SESSION['inputType'] = "<input type='time' name='time'>";
    $_SESSION['answerType'] = $selected;
         header("Location: build.form.php");
         return;
    //echo "Input Time: <input type='time' name='time'>"; 
  }
  elseif($selected == '6')
  {
         $_SESSION['inputType'] = "<input type='number' name='number' placeholder='number'>";
         $_SESSION['answerType'] = $selected;
         header("Location: build.form.php");
         return;

         //echo "Input Number: <input type='number' name='number'>";
  }
  elseif($selected == '7')
  {
    $_SESSION['inputType'] = "<input type='date' name='date'>";
    $_SESSION['answerType'] = $selected;
         header("Location: build.form.php");
         return;
    //echo "Input Date: <input type='date' name='date'>"; 
  }
  elseif($selected == '8')
  {
    $_SESSION['inputType'] = "<input type='file' name='file'>";
    $_SESSION['answerType'] = $selected;
         header("Location: build.form.php");
         return;
    //echo "Input Date: <input type='date' name='date'>"; 
  }
  
}
?>
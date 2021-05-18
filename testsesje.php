<?php
 
  session_start();
   
  if($_SESSION['logged'] == true)
  {
    echo $_SESSION['startpage'];
    require_once "Segmenty/profilepanel.php";
    require_once "connect.php";
    $polaczenie = @new mysqli($host, $db_user, $db_pass, $db_name);
    if($polaczenie->connect_errno!=0)
    {
      echo "Error: ".$polaczenie->connect_errno;
    }
    else
    {
    $query = "SELECT * FROM wpisy WHERE data_wpisu >= DATE_SUB(CURDATE(),INTERVAL MOD(DAYOFWEEK(CURDATE())-2,7) DAY) AND date <= DATE_ADD(CURDATE(), INTERVAL MOD(7 - (DAYOFWEEK(CURDATE()) - 1), 7) DAY)";
    $view_now_week = @$polaczenie->query($query);
     
    $wpis = $view_now_week->fetch_assoc();
     
    echo $wpis['content'];
    }
    echo $_SESSION['endpage'];
  }
  else
  {
    header('Location: login.php');
  }
?>

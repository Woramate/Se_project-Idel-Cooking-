<?php
@session_start();
include("config.php");
mysqli_set_charset($objCon,"utf8");
date_default_timezone_set('Asia/Bangkok');

error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

$id_menu = $_POST['id_menu'];

$sql = "DELETE FROM food_menu WHERE id ='$id_menu'";
mysqli_query($objCon, $sql);

echo "<script type = 'text/javascript'>
            alert('ลบสูตรอาหารแล้ว');
            window.location.href ='homePage.php';
            </script>";

 ?>

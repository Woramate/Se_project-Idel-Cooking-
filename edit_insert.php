<?php
@session_start();
include("config.php");
mysqli_set_charset($objCon,"utf8");
date_default_timezone_set('Asia/Bangkok');

error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

$username = $_SESSION['username'];
$id_user = $_SESSION['id'];

$nameNew = $_POST['usernameNew'];
$myInfoNew = $_POST['myInfo'];

if ($_FILES['imageJa']['name']) {
  $main_pic_filename = $_FILES['imageJa']['name'];
  $main_pic_fileTMPname = $_FILES['imageJa']['tmp_name'];
  $main_pic_fileNEWname = uniqid()."-".$main_pic_filename;
  $main_pic_filedestination = "myfile/".$main_pic_fileNEWname;

  move_uploaded_file($main_pic_fileTMPname,$main_pic_filedestination);

  $Datasql = "UPDATE login SET pic = '$main_pic_filedestination' WHERE id_user = $id_user";
  mysqli_query($objCon, $Datasql);
}

if ($nameNew != $username) {

  if (strlen($nameNew) >= 20) {
    echo "<script type = 'text/javascript'>
    alert('ชื่อยาวเกิ๊น โปรดเปลี่ยน');
    window.location.href ='homePage.php';
    </script>";
    exit();
  }

  $Datasql = "UPDATE login SET name2 = '$nameNew' WHERE id_user = $id_user";
  mysqli_query($objCon, $Datasql);
}

$Datasql = "UPDATE login SET info = '$myInfoNew' WHERE id_user = $id_user";
mysqli_query($objCon, $Datasql);

echo "<script type = 'text/javascript'>
            alert('อัพเดทโปรไฟล์แล้ว');
            window.location.href ='homePage.php';
            </script>";

 ?>

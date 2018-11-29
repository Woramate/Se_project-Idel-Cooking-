<?php
@session_start();
include("config.php");
mysqli_set_charset($objCon,"utf8");

$name = $_POST['userName'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];

if (isset($name) && isset($pass) && isset($pass2)) {
  if ($pass != $pass2) {
    echo "<script type = 'text/javascript'>
    alert('Password ไม่ตรงกัน โปรดสมัครอีกครั้ง');
    window.location.href ='homePage.php';
    </script>";
    exit();
  } else {
    $dataSQL = "SELECT * FROM login WHERE name LIKE '".$name."'";
    $dataQuery = mysqli_query($objCon, $dataSQL);
    $dataResult = mysqli_fetch_array($dataQuery);

    if (!$dataResult) {
      $sql = "INSERT INTO login(name,password,star) VALUES ('$name','$pass', 0)";
        mysqli_query($objCon, $sql);
        echo "<script type = 'text/javascript'>
        alert('สมัครสมาชิกเรียบร้อย โปรดลงชื่อเข้าใช้อีกครั้ง');
        window.location.href ='homePage.php';
        </script>";
        exit();
    }else {
      echo "<script type = 'text/javascript'>
      alert('ชื่อนี้มีคนใช้แล้วครับ โปรดสมัครอีกครั้ง');
      window.location.href ='homePage.php';
      </script>";
      exit();
    }

  }
} else {
      echo "<script type = 'text/javascript'>
  alert('กรุณากรอกข้อมูลให้ครบ');
  window.location.href ='homePage.php';
  </script>";
      exit();
}


 ?>

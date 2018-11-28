<?php
@session_start();
include("config.php");
mysqli_set_charset($objCon,"utf8");

$name = $_POST['uname'];
$pass = $_POST['psw'];

$strSQL = "SELECT * FROM login WHERE name = '".$name."' and password = '".$pass."' ";
$objQuery = mysqli_query($objCon,$strSQL);
$objResult = mysqli_fetch_array($objQuery);
if(!$objResult){
    echo "<script type = 'text/javascript'>
		alert('ชื่อหรือรหัสผ่านไม่ถูกต้อง');
		window.location.href ='homePage.php';
		</script>";
    exit();
}
else{
    $_SESSION['username'] = $_POST['uname'];
    $_SESSION['id'] = $objResult['id_user'];

    @session_write_close();
//    echo ("complete");
    echo "<script type = 'text/javascript'>
    alert('เข้าสู่ระบบเรียบร้อย');
		window.location.href ='homePage.php';
		</script>";

}


?>

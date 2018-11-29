<?php
define('servername' , 'webservhost');
define('username', 'inwfood_59011171');
define('password','123456');
define('dbname','inwfood_SE_project');

$objCon = mysqli_connect(servername,username,password,dbname);

//mysqli_set_charset($objCon,"SET CHARACTER SET UTF8");
//if(mysqli_connect_errno()){
//    echo "BUG";
//    echo mysqli_connect_errno();
//  }else {
//    echo "connect";
//  }
  
?>
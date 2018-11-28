<?php
@session_start();
include("config.php");
mysqli_set_charset($objCon,"utf8");
date_default_timezone_set('Asia/Bangkok');

$name = $_POST['menu_name'];
$writer = $_POST['writer'];

$main_pic_filename = $_FILES['RecipePic']['name'];
$main_pic_fileTMPname = $_FILES['RecipePic']['tmp_name'];
$main_pic_fileNEWname = uniqid()."-".$main_pic_filename;
$main_pic_filedestination = "myfile/".$main_pic_fileNEWname;

$ingredients = null;
foreach($_POST['checklist'] as $selected_ingredients){
$ingredients .= $selected_ingredients.' ';
}

$step = $_POST['thisIsHowToDo_0'];
  $i = 1;
    while ($_POST['thisIsHowToDo_'.$i]) {
      $step .= '--CUTcutCUT--'.$_POST['thisIsHowToDo_'.$i];
      $i++;
    }


$step_pic_filename = $_FILES['step_pic_0']['name'];
$step_pic_fileTMPname = $_FILES['step_pic_0']['tmp_name'];
$step_pic_fileNEWname = uniqid()."-".$step_pic_filename;
$step_pic_filedestination = "myfile/".$step_pic_fileNEWname;

move_uploaded_file($step_pic_fileTMPname,$step_pic_filedestination);

$step_pic = $step_pic_filedestination;
  $j = 1;
    while ($_FILES['step_pic_'.$j]['name']) {

      $step_pic_filename = $_FILES['step_pic_'.$j]['name'];
      $step_pic_fileTMPname = $_FILES['step_pic_'.$j]['tmp_name'];
      $step_pic_fileNEWname = uniqid()."-".$step_pic_filename;
      $step_pic_filedestination = "myfile/".$step_pic_fileNEWname;

      move_uploaded_file($step_pic_fileTMPname,$step_pic_filedestination);

      $step_pic .= '--CUTcutCUT--'.$step_pic_filedestination;

      $j++;
    }

if(isset($name)){
        move_uploaded_file($main_pic_fileTMPname,$main_pic_filedestination);
        $Datasql = "INSERT INTO food_menu(menu_name, writer, ingredients, main_pic, step_pic, step)
        VALUES ('$name', '$writer', '$ingredients', '$main_pic_filedestination', '$step_pic', '$step')";
        mysqli_query($objCon, $Datasql);
    }
    else{
        echo "<script type = 'text/javascript'>
            alert('มีบางอย่างที่ผิดพลาด');
            </script>";
        exit();
    }

    echo "<script type = 'text/javascript'>
                alert('เพิ่มสูตรอาหาร ".$name." แล้ว');
                window.location.href ='homePage.php';
                </script>";
?>

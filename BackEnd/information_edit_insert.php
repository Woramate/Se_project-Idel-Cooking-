<?php
@session_start();
include("config.php");
mysqli_set_charset($objCon,"utf8");
date_default_timezone_set('Asia/Bangkok');

error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

$name = $_POST['menu_name'];
$writer = $_POST['writer'];
$id_writer = $_POST['id_writer'];
$id_menu = $_POST['id_menu'];
$sizeof_step = $_POST['sizeof_step'];

$dataSQL = "SELECT * FROM food_menu WHERE id = '$id_menu'";
$dataQuery = mysqli_query($objCon, $dataSQL);
$dataResult = mysqli_fetch_array($dataQuery);

$longStepPic = $dataResult['step_pic'];
$StepPic = explode('--CUTcutCUT--', $longStepPic);

$longStep = $dataResult['step'];
$step = explode('--CUTcutCUT--', $longStep);

$step_count = $dataResult['step_count'];

if ($_FILES['RecipePic']['name']) {
  $main_pic_filename = $_FILES['RecipePic']['name'];
  $main_pic_fileTMPname = $_FILES['RecipePic']['tmp_name'];
  $main_pic_fileNEWname = uniqid()."-".$main_pic_filename;
  $main_pic_filedestination = "myfile/".$main_pic_fileNEWname;

  move_uploaded_file($main_pic_fileTMPname,$main_pic_filedestination);

  $Datasql = "UPDATE food_menu SET main_pic = '$main_pic_filedestination' WHERE id = $id_menu";
  mysqli_query($objCon, $Datasql);

}


//--------------------------------------------------------------------menu



//--------------------------------------------------------------------ingredients

$ingredients = ' ';
foreach($_POST['checklist'] as $selected_ingredients){
$ingredients .= $selected_ingredients.' ';
}

//--------------------------------------------------------------------step

$newStep = $_POST['thisIsHowToDo_0'];
  $i = 1;
    while ($_POST['thisIsHowToDo_'.$i]) {
      $newStep .= '--CUTcutCUT--'.$_POST['thisIsHowToDo_'.$i];
      $i++;
    }

//--------------------------------------------------------------------step pic
$newStepPic = null;

for ($i=0; $i < $sizeof_step; $i++) {

  if (!isset($_FILES['step_pic_'.$i]['name'])) {

    $step_pic_filename = $_FILES['step_pic_'.$i]['name'];
    $step_pic_fileTMPname = $_FILES['step_pic_'.$i]['tmp_name'];
    $step_pic_fileNEWname = uniqid()."-".$step_pic_filename;
    $step_pic_filedestination = "myfile/".$step_pic_fileNEWname;

    move_uploaded_file($step_pic_fileTMPname,$step_pic_filedestination);

    $newStepPic .= $step_pic_filedestination.'--CUTcutCUT--';

  }else {
    $newStepPic .= $StepPic[$i].'--CUTcutCUT--';
  }
}

$Datasql = "UPDATE food_menu SET menu_name = '$name',ingredients = '$ingredients',step_pic = '$newStepPic',step = '$newStep' WHERE id = $id_menu";
mysqli_query($objCon, $Datasql);

echo "<script type = 'text/javascript'>
            alert('แก้ไขสูตรอาหาร ".$name." แล้ว');
            window.location.href ='homePage.php';
            </script>";

 ?>

<?php
@session_start();
include("config.php");
mysqli_set_charset($objCon,"utf8");
$username = $_SESSION['username'];
$id_user = $_SESSION['id'];
$id_menu = $_POST['id_menu'];

$dataSQL = "SELECT * FROM food_menu WHERE id = '$id_menu'";
$dataQuery = mysqli_query($objCon, $dataSQL);
$dataResult = mysqli_fetch_array($dataQuery);

$longStepPic = $dataResult['step_pic'];
$StepPic = explode('--CUTcutCUT--', $longStepPic);

$longStep = $dataResult['step'];
$step = explode('--CUTcutCUT--', $longStep);

$step_count = $dataResult['step_count'];

if (!isset($username) && $username != $dataResult['writer_id']) {
  echo "<script type = 'text/javascript'>
  alert('คุณไม่สามารถเข้าถึงหน้านี้ หรือมีบางอย่างผิดพลาด กรุณาติดต่อทีมพัฒนา');
  window.location.href ='homePage.php';
  </script>";
  exit();
}else {
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Page Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="createpage.css" />
        <link href="https://fonts.googleapis.com/css?family=Athiti:400,700" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Knewave" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <style media="screen">
        .thumbnail {
            position: relative;
            width: 400px;
            height: 400px;
            overflow: hidden;
        }
        .thumbnail img {
            position: absolute;
            left: 50%;
            top: 50%;
            width: auto;
            height: 400px;
            -webkit-transform: translate(-50%,-50%);
            -ms-transform: translate(-50%,-50%);
            transform: translate(-50%,-50%);
        }
        </style>
    </head>
    <body id="myBody">
        <header>
            <div class="topnv-container">
                <div id="brand">
                    <a href="homePage.php"><h1>!nwFood</h1></a>
                </div>
                <?php if (isset($username)) {
                  echo '<nav><form action="logout.php" method="post">
                            <button class="login-button" type="submit" style="width:auto;">สวัสดีคุณ '.$username.' คลิกที่นี่เพื่อออกจากระบบ</button>
                        </form><nav>';
                }else {
                  echo '<nav>
                        <button class="login-button" onclick="showLoginModal()" style="width:auto;">เข้าสู่ระบบ</button>
                        <button class="signup-button" onclick="showSignupModal()" style="width:auto;">สมัครสมาชิก</button>
                        </nav>';
                }

                ?>
                <div id="searchByName">
                        <input type="text" placeholder="ค้นหาสูตรอาหารจากชื่อ">
                </div>
            </div>
        </header>
        <div class="row">
            <div class="userColumn">
                <div class="username">
                    <p><?php echo $username; ?></p>
                </div>
                <div class="image">
                    <img src="picture/user.png" alt="">
                </div>
                <div class="profileBtn">
                    <button>โปรไฟล์</button>
                </div>

            </div>

            <div class="recipeColumn">
              <form action="information_edit_insert.php" method="post" enctype="multipart/form-data">
                <div class="recipeName">
                    <input type="text" placeholder="ชื่อสูตรอาหาร" class="recipeNameTag" name="menu_name" value="<?php echo $dataResult['menu_name']; ?>" required>
                </div>

                <div class="mainPictureBox">
                    <!--div  class="recipePicture picBorder" style="background-image: url(<?php echo $dataResult['main_pic'];?>); background-size: cover">
                      <img id="mainPic" src="#" style="display:none" />
                    </div-->

                    <div  class="recipePicture picBorder">   <!-- ลบ Style -->
                      <img id="mainPic" src="./<?php echo $dataResult['main_pic'];?>"/>   <!-- ใส่ path image ใน Tag image เอา Display: none ออก -->
                    </div>
                    <div class="addImage">
                        <img src="picture/addImage2.png" id="addBtnPic" style="cursor:pointer" />
                        <input type="file" id="getRecipePic"  name="RecipePic"  style="display:none" />
                    </div>
                </div>

                <h3>แก้ไขวัตถุดิบ</h3>
                <table style="margin-left: 100px; text-align:left">
                  <?php
                  $selectSQL = "SELECT COUNT(id), eng_type, type FROM ingredients GROUP BY eng_type";
                  $selectQuery = mysqli_query($objCon,$selectSQL);
                  while ($selectresult = mysqli_fetch_array($selectQuery)) {
                    echo '<tr>';
                    echo '<th width="100px"><div class="ingredient"><h4>';
                    echo $selectresult['type'];
                    echo '</h4></div></th>';

                    $type = $selectresult['eng_type'];

                    echo '<th>';
                    $ingredientsSQL = "SELECT * FROM ingredients WHERE eng_type = '".$type."' ";
                    $ingredientsQuery = mysqli_query($objCon, $ingredientsSQL);
                    $br = 1;
                    while ($ingredientsResult = mysqli_fetch_array($ingredientsQuery)) {
                        echo '<input type="checkbox" name="checklist[]" value="'.$ingredientsResult['eng_name'].'"'.((strrpos($dataResult['ingredients'], $ingredientsResult['eng_name']))?"checked='checked'":"").'> <div class="checkboxtext" style="font-size: 15px">'.$ingredientsResult['th_name'].'</div>';
                        if ($br%5 == 0) {
                          echo "</br>";
                        }
                        $br++;
                    }

                    echo '</th></tr>';
                  }
                  ?>
                    <!-- <input class="name" type="text" placeholder="วัตถุดิบ" name="ingredients"> -->
                  </table>

                <h3>แก้ไขขั้นตอน</h3>
                <div class="howToDo">
                    <!-- <input type='text' placeholder='ใส่วิธีทำลงที่นี่' class="0 step"> -->

                    <?php for ($i=0; $i < sizeof($step); $i++) { ?>

                      <textarea name="thisIsHowToDo_<?php echo $i ?>"><?php echo $step[$i]; ?></textarea>
                      <div class="mainPictureBox">
                          <div  class="recipePicture picBorder" style="background-image: url(<?php echo $StepPic[$i];?>); background-size: cover">
                              <img src="#" alt="recipe image" id="Pic0" class="picFull" style="display:none"/>
                          </div>
                          <div class="addImage">
                              <img src="picture/addImage2.png" id="Btn0" style="cursor:pointer" />
                              <input type="file" getRecipePic id="PicTag0" name="step_pic_<?php echo $i ?>" style="display:none" />
                          </div>
                      </div>

                    <?php } ?>

                </div>

                <!-- <div class="addMoreBox">
                    <button type="button" class="addMore">เพิ่มขั้นตอน</button>
                </div> -->

                <div class="saveBtnBox">
                  <button type="submit" class="btn btn-primary mb-2" name="submit" > บันทึกการเปลี่ยนแปลง </button>
                </div>

                <input type="hidden" value="<?php echo sizeof($step); ?>" name="sizeof_step" >
                <input type="hidden" value="<?php echo $id_user; ?>" name="id_writer" >
                <input type="hidden" value="<?php echo $id_menu; ?>" name="id_menu" >
                <input type="hidden" value="<?php echo $username; ?>" name="writer" >
                </form>
            </div>
        </div>
        <script src="main.js"></script>
    </body>
</html>
<?php } ?>

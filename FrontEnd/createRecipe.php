<?php
@session_start();
include("config.php");
mysqli_set_charset($objCon,"utf8");
$username = $_SESSION['username'];
$id_user = $_SESSION['id'];

$userSQL = "SELECT * FROM login WHERE id_user = '$id_user'";
$userQuery = mysqli_query($objCon, $userSQL);
$userResult = mysqli_fetch_array($userQuery);

if (!isset($username)) {
  echo "<script type = 'text/javascript'>
  alert('โปรดloginเพื่อสร้างสูตรอาหาร');
  window.location.href ='homePage.php';
  </script>";
  exit();
}else {
?>
<!DOCTYPE html>
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
    </head>
    <body id="myBody">
        <header>
            <div class="topnv-container">
                <div id="brand">
                    <a href="homePage.php"><h1>!nwFood</h1></a>
                </div>
                <?php if (isset($username)) {
                  $profileURL = "profile.php";
                  echo '<nav>
                        <form action="logout.php" method="post">
                            <button class="login-button" type="submit" style="width:auto;">ออกจากระบบ</button>
                        </form>
                        <button class="profile-btn"><a href="'.$profileURL.'">'.$username.'</a></button>
                        <nav>';
                }else {
                  echo '<nav>
                        <button class="login-button" onclick="showLoginModal()" style="width:auto;">เข้าสู่ระบบ</button>
                        <button class="signup-button" onclick="showSignupModal()" style="width:auto;">สมัครสมาชิก</button>
                        </nav>';
                }

                ?>                
            </div>
        </header>
        <div class="row">
            <div class="userColumn">
                <div class="username">
                    <p><?php echo $username; ?></p>
                </div>
                <div class="image">
                    <?php echo'<img class="profile-img" src="'.$userResult['pic'].'" alt="Avatar">'; ?>
                </div>
                <div class="profileBtn">
                    <p><?php echo $userResult['name'] ?></p>
                </div>

            </div>

            <div class="recipeColumn">
              <form action="createRecipe_insert.php" method="post" enctype="multipart/form-data">
                <div class="recipeName">
                    <input type="text" placeholder="ชื่อสูตรอาหาร" class="recipeNameTag" name="menu_name" required>
                </div>

                <div class="mainPictureBox">
                    <div  class="recipePicture picBorder">
                        <img id="mainPic" src="#" alt="recipe image" style="display:none"/>
                    </div>
                    <div class="addImage">
                        <img src="picture/addImage2.png" id="addBtnPic" style="cursor:pointer" />
                        <input type="file" id="getRecipePic"  name="RecipePic" style="display:none" />
                    </div>
                </div>

                <h3>วัตถุดิบ</h3>
                <table style="margin-left: 100px; text-align:left">
                  <?php
                  $selectSQL = "SELECT COUNT(id), eng_type, type FROM ingredients GROUP BY eng_type";
                  $selectQuery = mysqli_query($objCon,$selectSQL);
                  while ($selectresult = mysqli_fetch_array($selectQuery)) {
                    echo '<tr>';
                    echo '<th width="70px"><div class="ingredient"><h4>';
                    echo $selectresult['type'];
                    echo '</h4></div></th>';

                    $type = $selectresult['eng_type'];

                    echo '<th>';
                    $dataSQL = "SELECT * FROM ingredients WHERE eng_type = '".$type."' ";
                    $dataQuery = mysqli_query($objCon, $dataSQL);
                    $br = 1;
                    while ($dataResult = mysqli_fetch_array($dataQuery)) {
                        echo '<input type="checkbox" name="checklist[]" value="'.$dataResult['eng_name'].'"> <div class="checkboxtext" style="font-size: 15px">'.$dataResult['th_name'].'</div>';
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
                <h3>ขั้นตอน</h3>
                <div class="howToDo">
                    <!-- <input type='text' placeholder='ใส่วิธีทำลงที่นี่' class="0 step"> -->
                    <textarea name="thisIsHowToDo_0"></textarea>
                    <div class="mainPictureBox">
                        <div  class="recipePicture picBorder">
                            <img src="#" alt="recipe image" id="Pic0" class="picFull" style="display:none"/>
                        </div>
                        <div class="addImage">
                            <img src="picture/addImage2.png" id="Btn0" style="cursor:pointer" />
                            <input type="file" getRecipePic id="PicTag0" name="step_pic_0" style="display:none" />
                        </div>
                    </div>
                </div>

                <div class="addMoreBox">
                    <button type="button" class="addMore">เพิ่มขั้นตอน</button>
                </div>

                <div class="saveBtnBox">
                  <button type="submit" class="btn btn-primary mb-2" name="submit" > บันทึก </button>
                </div>

                <input type="hidden" value="<?php echo $id_user; ?>" name="id_writer" >
                <input type="hidden" value="<?php echo $username; ?>" name="writer" >
                </form>
            </div>
        </div>
        <script src="main.js"></script>
    </body>
</html>
<?php } ?>

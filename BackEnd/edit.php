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
  alert('คุณไม่สามารถเข้าถึงหน้านี้ หรือมีบางอย่างผิดพลาด กรุณาติดต่อทีมพัฒนา');
  window.location.href ='homePage.php';
  </script>";
  exit();
}else {
?>
<!DOCTYPE html>
<html>
    <head>
        <title>edit Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" media="screen" href="editProfile.css" />
        <link href="https://fonts.googleapis.com/css?family=Knewave" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Athiti:400,700" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <style>
            body{
                /* background-color: #181818;   */
                /* background-image: url("picture/bgpage.jpeg");
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat; */
                background-color: #102c35;
                font-family: "Athiti" , sans-serif;
                font-size: 15px;
                margin: 0;
                padding: 0;
                cursor: default;
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

          </div>
      </header>
        <div class="profile-box">

            <p class="profile-head">Profile</p>

            <form action="edit_insert.php" method="post" enctype="multipart/form-data">
                <div class="imgCol">
                    <div class="profile-img-box">
                        <img id="profileImg" src="./<?php echo $userResult['pic'];?>" alt="pic" >
                    </div>
                    <div class="imageBtn">
                        <input type="file" name="imageJa" id="profileImageBtnJa" accept="image/*">
                    </div>

                </div>
                <div class="infoCol">
                    <div class="profile-infor">
                        <div class="usernameBox">
                            <p class="boldy">USERNAME : </p>
                            <p id='userID'><?php echo $userResult['name']; ?></p>
                        </div>
                        <div class="nameBox">
                            <p class="boldy">Name         : </p>
                            <input type="text" value="<?php echo $userResult['name2']; ?>" class="recipeNameTag" name="usernameNew" required>
                        </div>
                        <div class="infoBox ">
                            <p class="boldy">Info           : </p>
                            <textarea name="myInfo" value="<?php echo $userResult['info']; ?>" cols="50" rows="6"></textarea>
                        </div>
                   </div>

                   <!-- <div class="recipe-box">
                        <p>สูตรอาหาร</p>
                   </div> -->

                   <button type="submit" class="profile-edit">บันทึก</button>
                </div>
            </form>



        </div>

        <!-- ------------------------------------------------------------------------- -->
        <script src="editProfileJS.js"></script>
    </body>
</html>
<?php } ?>

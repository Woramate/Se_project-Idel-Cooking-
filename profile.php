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
                .DnameBox input{
                    font-family: "Athiti";
                    font-size: 15px;
                    display: inline-block;
                    width: 373px;
                }
                .DnameBox p{
                    display: inline-block;
                    font-size: 20px;
                }
                .DusernameBox{
                    display: block;
                }
                .DusernameBox p{  
                    display: inline-block;
                    font-size: 20px;
                }
                .DinfoBox{

                }
                .DinfoBox p{
                    display: inline-block;
                    white-space: pre;
                    font-size: 20px;
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
        <div class="profile-box">

            <p class="profile-head">Profile</p>
            

                <div class="imgCol">
                    <div class="profile-img-box">
                        <?php
                        if (substr($userResult['pic'],22) == "") {
                            echo '<img id="profileImg" src="picture/download.png" alt="default">';
                        } else {
                            echo'<img id="profileImg" src="'.$userResult['pic'].'" alt="Avatar">';
                        }
                        ?>                        
                    </div>                   
                </div>
                <div class="infoCol">
                    <div class="profile-infor">
                        <div class="DusernameBox">
                            <p class="boldy">USERNAME : </p>
                            <p id='userID'><?php echo $userResult['name']; ?></p>
                        </div>
                        <div class="DnameBox">
                            <p class="boldy">Name         : </p>
                            <p> <?php echo $userResult['name2']; ?></p>
                        </div>
                        <div class="DinfoBox ">
                            <p class="boldy">Info            :</p>
                            <p> <?php echo $userResult['info']; ?></p>
                        </div>                       
                   </div>                   
                   <button type="submit" class="profile-edit"><a href="edit.php" style="text-decoration: none; color: white;">แก้ไข</a></button>
                </div>          
            <div class="recipe-box">
                <p style="margin-left: 40px">สูตรอาหาร</p>
                <?php
                
                    $tmp = $userResult['name'];
                    $dataSQL = "SELECT * FROM food_menu WHERE writer = '$tmp'" ;
                    $dataQuery = mysqli_query($objCon, $dataSQL);
                    while($dataResult = mysqli_fetch_array($dataQuery))
                    {
                        echo '<div style="border: 1px solid #000; border-collapse: collapse;">';
                        echo '<p style="margin-left : 70px; display : inline-block;">'.$dataResult['menu_name'].'</p>';
                        echo '<div style="display : inline-block; float : right; margin-right : 70px; margin-top : 1em; margin-bottom : 1em;"><form action="information_edit.php" method="post">
                              <input type="hidden" value="'.$dataResult['id'].'" name="id_menu" >
                              <button class="Peditbtn-recipe">แก้ไข</button>
                              </form></div>';
                        echo '<div style="display : inline-block; float : right; margin-right : 70px; margin-top : 1em; margin-bottom : 1em;"><form action="information_edit_delete.php" method="post">
                              <input type="hidden" value="'.$dataResult['id'].'" name="id_menu" >
                              <button class="Pdeletebtn-recipe">ลบ</button>
                              </form></div>';
                        echo '</div>';
                    }
                ?>
                
            </div>
        </div>

        <!-- ------------------------------------------------------------------------- -->
        <script src="editProfileJS.js"></script>
    </body>
</html>
<?php } ?>

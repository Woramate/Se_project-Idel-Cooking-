<?php
@session_start();
include("config.php");
mysqli_set_charset($objCon,"utf8");
$id_menu = $_GET['id'];
$username = $_SESSION['username'];

$userSQL = "SELECT * FROM login WHERE id_user = '$id_user'";
$userQuery = mysqli_query($objCon, $userSQL);
$userResult = mysqli_fetch_array($userQuery);

?>
<html>
    <head>
        <title>SE-IndexPage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Knewave" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Athiti:400,700" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <style>
            body{
                /* background-color: #181818;   */
                background-image: url("picture/BG-Homepage.png");
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
                min-height: 100% ;
                top: 0px ;
                margin: 0;
            }
        </style>
    </head>
    <body id="myBody" style="font-family: 'Athiti' , sans-serif;">
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
         <!------------------------------- login Form  ---------------------------------->
        <div id="loginBox" class="modal">
            <form action="" class="modal-content animate">
                <span onclick="closeLoginModal()" class="close" title="Close Modal">&times;</span>
                <div class="logo-login">
                    <h3>!nwFood</h3>
                </div>
                <div class="loginForm">
                    <label for="uname"><b>ไอดี</b></label>
                    <input type="text" placeholder="ใส่ไอดีที่นี่นะจ้ะ" name="uname" required>

                    <label for="psw"><b>รหัสผ่าน</b></label>
                    <input type="password" placeholder="ใส่รหัสผ่านตรงนี้จ้ะ" name="psw" required>
                    <span class="forgetpsw"><a href="#">ลืมรหัสผ่านหรอ?</a></span>
                    <div class="loginBtnBox">
                        <button type="submit" class="loginBtn">เข้าสู่ระบบ</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- ---------------------------------------------------------------------------->
        <!------------------------------- sign up From ---------------------------------->
        <div id="signupBox" class="modal">
            <form action="" class="modal-content animate">
                <span onclick="closeSignupModal()" class="close" title="Close Modal">&times;</span>
                <div class="logo-signup">
                    <h3>!nwFood</h3>
                </div>
                <div class="loginForm">
                    <label for="uname"><b>ไอดี</b></label>
                    <input type="text" placeholder="ใส่ไอดีที่นี่นะจ้ะ" name="uname" required>

                    <label for="psw"><b>รหัสผ่าน</b></label>
                    <input type="password" placeholder="ใส่รหัสผ่านตรงนี้จ้ะ" name="psw" required>
                    <label for="psw"><b>รหัสผ่านอีกรอบ</b></label>
                    <input type="password" placeholder="ใส่รหัสผ่านอีกครั้งตรงนี้จ้ะ" name="psw" required>

                    <label>
                        <input type="checkbox"  name="termandprivacy">ยอมรับข้อกำหนดการใช้งานและนโยบายความเป็นส่วนตัว
                    </label>

                    <div class="signupBtnBox">
                        <button type="submit" class="signupBtn">สมัครสมาชิก</button>
                    </div>
                </div>
            </form>
        </div>

        <!------------------------------------------------------------------------------->
        <?php

        $dataSQL = "SELECT * FROM food_menu WHERE id = '$id_menu'";
        $dataQuery = mysqli_query($objCon, $dataSQL);
        $dataResult = mysqli_fetch_array($dataQuery);
        $tmp = $dataResult['writer'];
        $writerSQL = "SELECT * FROM login WHERE name = '$tmp'";
        $writerQuery = mysqli_query($objCon, $writerSQL);
        $writerResult = mysqli_fetch_array($writerQuery);

        $longIngredients = $dataResult['ingredients'];
        $ingredients = explode(" ", $longIngredients);

        $longStepPic = $dataResult['step_pic'];
        $StepPic = explode('--CUTcutCUT--', $longStepPic);

        $longStep = $dataResult['step'];
        $step = explode('--CUTcutCUT--', $longStep);

        echo '<div class="sidebar" id="sidebarID" style="overflow: hidden; background-color: #424242;">';
        if (substr($writerResult['pic'],22) == "") {
            echo '<img class="profile-img" src="picture/download.png" alt="default" style="margin: 50px 0 0 57px">';
        } else {
            echo'<img class="profile-img" src="'.$writerResult['pic'].'" alt="Avatar" style="margin: 50px 0 0 57px">';
        }
            
        echo    '<h2 style="text-align: center; color: #FFD900;">'.$dataResult['writer'].'</h2>
                <button class="follow-btn">ติดตาม</button>
                <h2 style="text-align: center; color: #FFD900; margin-top: 5px; margin-bottom: 5px;">คะแนน</h2>
                <div style="margin-top: 20px; padding: 5px 0 5px 115px">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star "></span>
                  </div>
                </div>';

                echo '<div class="recipeList" style="margin-top: 2%; background-color: #efefef; width: 60%; margin-left: 480px; text-align: center;">
                    <h1 style="text-align: center;">'.$dataResult['menu_name'].'</h1>';

                if (substr($dataResult['main_pic'],22) == "") {
                  echo '</br>';
                } else {
                  echo'<img class="food-img" src="'.$dataResult['main_pic'].'">';
                }

                echo '<h2 style="text-align: left; margin-left: 5px">วัตถุดิบ: </h2>';


                echo '<p style="text-align: left; margin-left : 30px;">';
                for ($i=0 ; $i < sizeof($ingredients); $i++) {

                  $dataSQL = "SELECT * FROM ingredients WHERE eng_name = '$ingredients[$i]'";
                  $dataQuery = mysqli_query($objCon, $dataSQL);
                  $dataResult = mysqli_fetch_array($dataQuery);

                  echo $dataResult['th_name'];
                  echo " ";

                    }

                echo '</p>';

                for ($i=0; $i < sizeof($step); $i++) {
                  $num = $i +1;

                  

                  if ($StepPic[$i] && substr($StepPic[$i],22) == "") {
                    } else {
                      echo "<div style='margin-left: 70px; text-align:left' >".$num.". ".$step[$i]."</div><br>";                     
                      echo '<img class="food-img" src="'.$StepPic[$i].'">';
                      echo '</br></br></br>';
                    }

                }
                    
                echo '<h1 style="visibility: hidden">_____________</h1>';
                echo '<h1 style="visibility: hidden">_____________</h1>';                     
                echo '</div>'; 
                
         ?>      
        
        <!------------------------------------------------------------------------------->
        <script src="main.js"></script>
    </body>
</html>

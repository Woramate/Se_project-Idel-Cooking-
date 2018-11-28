<?php
@session_start();
include("config.php");
mysqli_set_charset($objCon,"utf8");
$checklist = array("");
header("Cache-Control: max-age=0; no-cache; no-store; must-revalidate");
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SE-IndexPage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Knewave" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Athiti:400,700" rel="stylesheet">
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
            ul {
                list-style-type: none;
                padding: 0;
                margin: 0;
            }
            ul li {
                border: 1px solid #ddd;
                margin-top: -1px; /* Prevent double borders */
                background-color: #f6f6f6;
                padding: 12px;
                text-decoration: none;
                font-size: 18px;
                color: black;
                display: block;
                position: relative;
            }
            ul li:hover {
                background-color: #eee;
            }
            .close-ul {
                cursor: pointer;
                position: absolute;
                top: 50%;
                right: 0%;
                padding: 13px 16px;
                transform: translate(0%, -50%);
            }
            .close-ul:hover {
                background: #bbb;
            }
            .thumbnail {
                margin: auto auto;
                position: relative;
                width: 325px;
                height: 325px;
                overflow: hidden;
            }
            .thumbnail img {
                position: absolute;
                left: 50%;
                top: 50%;
                width: auto;
                height: 330px;
                margin-top: 20px;
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

         <!------------------------------- login Form  ---------------------------------->
        <div id="loginBox" class="modal">
            <form action="check_login.php" class="modal-content animate" method="post" enctype="multipart/form-data">
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
            <form action="save_register.php" method="post" enctype="multipart/form-data" class="modal-content animate">
                <span onclick="closeSignupModal()" class="close" title="Close Modal">&times;</span>
                <div class="logo-signup">
                    <h3>!nwFood</h3>
                </div>
                <div class="loginForm">
                    <label for="uname"><b>ไอดี</b></label>
                    <input type="text" placeholder="ใส่ไอดีที่นี่นะจ้ะ" name="userName" required>

                    <label for="psw"><b>รหัสผ่าน</b></label>
                    <input type="password" placeholder="ใส่รหัสผ่านตรงนี้จ้ะ" name="pass" required>
                    <label for="psw"><b>รหัสผ่านอีกรอบ</b></label>
                    <input type="password" placeholder="ใส่รหัสผ่านอีกครั้งตรงนี้จ้ะ" name="pass2" required>

                    <!-- <label>
                        <input type="checkbox"  name="termandprivacy">ยอมรับข้อกำหนดการใช้งานและนโยบายความเป็นส่วนตัว
                    </label> -->

                    <div class="signupBtnBox">
                        <button type="submit" class="signupBtn">สมัครสมาชิก</button>
                    </div>
                </div>
            </form>
        </div>
        <!------------------------------------------------------------------------------->
        <div class="sidebar" id="sidebarID">
            <div id="yourIngredient" class="sidebar" style="display: none; background-color: #424242;">
                <div class="yourIngredientList">
                    <ul>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                        <li>Test<span class="close-ul">&times;</span></li>
                    </ul>
                </div>
                <button class="searchRecipe" style="margin-left: 24px;" onclick="Display2()">
                    <span>ย้อนกลับ</span>
                </button>
                <h1 style="color: white">_____________________________</h1>
            </div>
            <a class="logo-sidebar" href="homePage.php" style="font-size: 40px; padding-left: 65px; text-decoration: none;">!nwFood</a>
            <div class="phagraph-sidebar">
                <p style="line-height: 1px">ค้นหาสูตรอาหารจากวัตถุดิบ</p>
            </div>
            <button class="notification" onclick="Display1()">
                    <span>วัตถุดิบของคุณ</span>
                    <span class="badge">0</span>
            </button>
            <div class="searchIngredient-container">
                <input class="input-searchIngredient" type="text" placeholder="ค้นหาวัตถุดิบ" name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
            <div>
                <form action="inwHome.php" method="post">

                  <?php
                  error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
                  $selectSQL = "SELECT COUNT(id), eng_type, type FROM ingredients GROUP BY eng_type";
                  $selectQuery = mysqli_query($objCon,$selectSQL);

                  while ($selectresult = mysqli_fetch_array($selectQuery)) {

                    echo '<button class="accordion" type="button">+ '.$selectresult['type'].'</button>
                    <div class="panel">';

                    $type = $selectresult['eng_type'];

                    $dataSQL = "SELECT * FROM ingredients WHERE eng_type = '".$type."' ";
                    $dataQuery = mysqli_query($objCon, $dataSQL);
                    while ($dataResult = mysqli_fetch_array($dataQuery)) {
                        echo '<input  class="input-checkIngredients" type="checkbox" name="checklist[]" value="'.$dataResult['eng_name'].'"'.((in_array($dataResult['eng_name'],$_POST['checklist']))?"checked='checked'":"").'> <div class="checkboxtext">'.$dataResult['th_name'].'</div>';
                    }

                    echo '</div>';
                  }
                  ?>

                <input class="notification" type="submit" name="submit" value="Submit" style="margin: 30px 30px 20px 97px">
                </form>

                <button class="requestIngredient-button" style="font-size: 15px;">ขอเพิ่มวัตถุดิบ >>></button>
                <h1>_____________________________</h1>
            </div>
        </div>
        <div class="recipeListHead">
          <?php if (isset($username)) {
            echo '<a href="createRecipe.php"><button class="createRecipe-btn">+ สร้างสูตรอาหารของฉัน</button></a>';
          } ?>
            <div class="navbar-recipeList">
                <div class="subnav-recipeList">
                    <button class="subnavbtn">เรียงตามลำดับ <i class="fa fa-caret-down"></i></button>
                    <div class="subnav-content">
                        <a href="#">ล่าสุด</a>
                        <a href="#">ยอดนิยม</a>
                        <a href="#">แนะนำ</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="recipeList">
            <div class="row-recipeList">
              <?php

                if(!empty($_POST['checklist'])){

                    $data_chk = serialize($_POST['checklist']);
                    $rev_data = unserialize($data_chk);
                    $filter = "";
                    $counter=1;
                    foreach($rev_data as $r){
                        if($counter==1){
                            $filter = $filter. " '%".$r."%'";
                        }else {
                            $filter = $filter. "  OR ingredients LIKE  '%".$r."%'";
                        }
                        $counter+=1;
                    }

                    $counter=0;
                    $resultSQL = mysqli_query($objCon,"SELECT * FROM food_menu WHERE ingredients LIKE $filter");

                    while ($dataResult = mysqli_fetch_array($resultSQL)) {
                        $url = "information.php?id=".$dataResult['id'];

                        echo '<div class="column-recipeList">';
                        echo '<div class="card-recipeList">';

                        echo '<div class="thumbnail">';
                        echo '<img src="'.$dataResult['main_pic'].'">';
                        echo '</div>';

                        echo '<div class="container-recipeList">';
                        echo '<h2>'.$dataResult['menu_name'].'</h2>';
                        echo '<p class="title-recipeList">'.$dataResult['writer'].'</p>';
                        echo '<a href="'.$url.'"><button class="moreInfo-btn">ดูเพิ่มเติม</button></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                else{
                    $dataSQL = "SELECT * FROM food_menu ORDER BY id DESC";
                    $dataQuery = mysqli_query($objCon, $dataSQL);

                    while ($dataResult = mysqli_fetch_array($dataQuery)) {
                        $url = "information.php?id=".$dataResult['id'];

                        echo '<div class="column-recipeList">';
                        echo '<div class="card-recipeList">';

                        echo '<div class="thumbnail">';
                        echo '<img src="'.$dataResult['main_pic'].'">';
                        echo '</div>';

                        echo '<div class="container-recipeList">';
                        echo '<h2>'.$dataResult['menu_name'].'</h2>';
                        echo '<p class="title-recipeList">'.$dataResult['writer'].'</p>';
                        echo '<a href="'.$url.'"><button class="moreInfo-btn">ดูเพิ่มเติม</button></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }

              ?>
            </div>
            <h1 style="visibility: hidden">_____________</h1>
            <h1 style="visibility: hidden">_____________</h1>
            <h1 style="visibility: hidden">_____________</h1>
        </div>
        <script src="main.js"></script>
    </body>
</html>

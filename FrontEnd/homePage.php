<?php
@session_start();
include("config.php");
mysqli_set_charset($objCon,"utf8");
$checklist = array("");
header("Cache-Control: max-age=0; no-cache; no-store; must-revalidate");
$username = $_SESSION['username'];
$id_user = $_SESSION['id'];
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
                <form action="homePage.php" method="get">
                    <div id="searchByName">
                            <input type="text" name="s" placeholder="ค้นหาสูตรอาหารจากชื่อ">
                    </div>
                </form>
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
            <a class="logo-sidebar" href="homePage.php" style="font-size: 40px; padding-left: 65px; text-decoration: none;">!nwFood</a>
            <div class="phagraph-sidebar">
                <p style="line-height: 1px; font-family: 'Athiti', sans-serif;">ค้นหาสูตรอาหารจากวัตถุดิบ</p>
            </div>                      
                <form action="homePage.php" method="post">

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
                        echo '<div style="display: inline-block"><input  class="input-checkIngredients" type="checkbox" name="checklist[]" value="'.$dataResult['eng_name'].'"'.((in_array($dataResult['eng_name'],$_POST['checklist']))?"checked='checked'":"").'> <div class="checkboxtext">'.$dataResult['th_name'].'</div></div>';
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
                $s = $_GET['s'];
                if(!empty($_POST['checklist']) || !empty($s)){
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
                    if(empty($s)){
                        $resultSQL = mysqli_query($objCon,"SELECT * FROM food_menu WHERE ingredients LIKE $filter");
                    }else{
                        $resultSQL = mysqli_query($objCon,"SELECT * FROM food_menu WHERE menu_name LIKE '%".$s."%' ");
                    }
                    while ($dataResult = mysqli_fetch_array($resultSQL)) {

                        $url = "information.php?id=".$dataResult['id'];

                        echo '<div class="column-recipeList">';
                        echo '<div class="card-recipeList">';

                        echo '<div class="thumbnail">';

                          if (substr($dataResult['main_pic'],22) == "") {
                            echo '<img src="myfile/defult_pic.png">';
                          } else {
                            echo'<img src="'.$dataResult['main_pic'].'">';
                          }

                          if ($dataResult['writer_id'] == $id_user) {
                            echo '<form action="information_edit.php" method="post">
                                  <input type="hidden" value="'.$dataResult['id'].'" name="id_menu" >
                                  <button class="editbtn-recipe">แก้ไข</button>
                                  </form>';
                            echo '<form action="information_edit_delete.php" method="post">
                                <input type="hidden" value="'.$dataResult['id'].'" name="id_menu" >
                                <button class="deletebtn-recipe">ลบ</button>
                                </form>';
                          }

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

                        if (substr($dataResult['main_pic'],22) == "") {
                          echo '<img src="myfile/defult_pic.png">';
                        } else {
                          echo'<img src="'.$dataResult['main_pic'].'">';
                        }

                        if ($dataResult['writer_id'] == $id_user) {
                          echo '<form action="information_edit.php" method="post">
                                <input type="hidden" value="'.$dataResult['id'].'" name="id_menu" >
                                <button class="editbtn-recipe">แก้ไข</button>
                                </form>';
                          echo '<form action="information_edit_delete.php" method="post">
                                <input type="hidden" value="'.$dataResult['id'].'" name="id_menu" >
                                <button class="deletebtn-recipe">ลบ</button>
                                </form>';

                        }

                        echo '</div>';
                        $out = getStrLenTH(htmlspecialchars($dataResult['menu_name'])) > 20 ? getSubStrTH(htmlspecialchars($dataResult['menu_name']),0,20)."..." : htmlspecialchars($dataResult['menu_name']);
                        echo '<div class="container-recipeList">';                                            
                        echo '<h2>'.$out.'</h2>';
                        echo '<p class="title-recipeList">'.$dataResult['writer'].'</p>';
                        echo '<a href="'.$url.'" target="_blank" ><button class="moreInfo-btn">ดูเพิ่มเติม</button></a>';

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                function getMBStrSplit($string, $split_length = 1){
                    mb_internal_encoding('UTF-8');
                    mb_regex_encoding('UTF-8');
                    $split_length = ($split_length <= 0) ? 1 : $split_length;
                    $mb_strlen = mb_strlen($string, 'utf-8');
                    $array = array();
                    $i = 0;
                    while($i < $mb_strlen)
                    {
                        $array[] = mb_substr($string, $i, $split_length);
                        $i = $i+$split_length;
                    }
                    return $array;
                }
                function getStrLenTH($string) {
                    $array = getMBStrSplit($string);
                    $count = 0;
                    foreach($array as $value)
                    {
                        $ascii = ord(iconv("UTF-8", "TIS-620", $value ));
                        if( !( $ascii == 209 ||  ($ascii >= 212 && $ascii <= 218 ) || ($ascii >= 231 && $ascii <= 238 )) )
                        {
                            $count += 1;
                        }
                    }
                    return $count;
                }
                function getSubStrTH($string, $start, $length)
                {			
                    $length = ($length+$start)-1;
                    $array = getMBStrSplit($string);
                    $count = 0;
                    $return = "";
		
                    for($i=$start; $i < count($array); $i++)
                    {
                        $ascii = ord(iconv("UTF-8", "TIS-620", $array[$i] ));
		
                        if( $ascii == 209 ||  ($ascii >= 212 && $ascii <= 218 ) || ($ascii >= 231 && $ascii <= 238 ) )
                        {			
                            $length++;
                        }
		
                        if( $i >= $start )
                        {
                            $return .= $array[$i];
                        }
		
                        if( $i >= $length )
                            break;
                    }
	
                    return $return;
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

<?php
@session_start();
@session_destroy();
echo "<script type = 'text/javascript'>
    window.location.href ='homePage.php';
</script>";
?>

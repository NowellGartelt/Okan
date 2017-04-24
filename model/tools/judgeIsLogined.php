<!-- model/tools/judgeIsLogined.php -->
<?php 
class judgeIsLogined {
    public function judgeIsLogined() {
        if (isset($_SESSION['loginID'])) {
            $loginID = $_SESSION['loginID'];
        } else {
            $loginID = null;
        }
        
        if ($loginID == null) {
            header( 'Location: /Okan/controller/login.php' );
            exit();
        }
    }
}
?>
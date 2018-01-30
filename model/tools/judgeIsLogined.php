<!-- model/tools/judgeIsLogined.php -->
<?php 
class judgeIsLogined {
    
    // コンストラクタ、何もしない
    public function __construct() {
        
    }
    
    public function judgeIsLogined() {
        if (isset($_SESSION['loginID'])) {
            $loginID = $_SESSION['loginID'];
        } else {
            $loginID = null;
        }
        
        if ($loginID == null) {
            header( 'Location: ../../Okan/login.php' );
            exit();
        }
    }
}
?>
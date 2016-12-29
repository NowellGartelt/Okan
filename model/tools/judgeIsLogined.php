<!-- model/tools/judgeIsLogined.php -->
<?php 
// model/tools/judgeIsLogined.php
class judgeIsLogined {
	public function judgeIsLogined() {
		if (isset($_SESSION['loginID'])) {
			$loginID = $_SESSION['loginID'];
		} else {
			$loginID = "";
		}
		
		if ($loginID == "") {
			header( "Location: /Okan/controller/login.php" ) ;
//			echo "Login Error.";
			exit();
		}
	}
}
?>
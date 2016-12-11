<!-- model/tools/judgeIsLogined.php -->
<?php 
// model/tools/judgeIsLogined.php
class judgeIsLogined {
	public function judgeIsLogined(){
		if(empty($_SESSION['login'])){
			header( "Location: /Okan/controller/login.php" ) ;
			echo "Login Error.";

		}
	}
}
?>
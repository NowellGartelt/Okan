<!-- model/searchMemberByLogIdAndPass.php-->
<?php
session_start();

class searchMemberByLogIdAndPass{
 private $loginID = '';
 private $loginPassword = '';
 
 public function searchMemberByLogIdAndPass($loginID, $loginPassword){
  include '../model/tools/databaseConnect.php';

  $this->loginID = $loginID;
  $this->loginPassword = $loginPassword;

  $query = "SELECT loginPassword FROM usertable WHERE loginId = '$loginID'";
  $result = mysqli_query($link, $query);
  $row = mysqli_fetch_array($result);
  $getLoginPassword = $row['loginPassword'];

  if($getLoginPassword !== $loginPassword){
   return 'noRegistration';

  } elseif ($getLoginPassword == $loginPassword) {
   return 'login';
  
  }
  mysqli_close($link);

 }
}
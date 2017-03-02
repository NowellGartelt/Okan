<!-- model/searchMemberByLogIdAndPass.php-->
<?php
class searchMemberByLogIdAndPass {
    private $loginID = null;
    private $loginPassword = null;
 
    public function searchMemberByLogIdAndPass($loginID, $loginPassword){
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        $this->loginPassword = $loginPassword;

        $query = "SELECT loginPassword FROM usertable WHERE loginID = '$loginID'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        $getLoginPassword = $row['loginPassword'];
        
/*
        var_dump($loginPassword);
        var_dump($getLoginPassword);        
        var_dump(password_verify($loginPassword, $getLoginPassword));
*/
        if (password_verify($loginPassword, $getLoginPassword)) {
//        if ($loginPassword == $getLoginPassword) {
            return 'login';
            
        } else {
            return 'noRegistration';
            
        }
        mysqli_close($link);
    }
}
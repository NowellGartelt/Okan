<!-- model/searchMemberByLogIdAndPass.php-->
<?php
class searchMemberByLogIdAndPass {
    private $loginID = null;
    private $loginPassword = null;
 
    // コンストラクタ、何もしない
    public function __construct() {
        
    }
    
    public function searchMemberByLogIdAndPass($loginID, $loginPassword){
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        $this->loginPassword = $loginPassword;

        // ログインIDから登録されたパスワードの取得
        $query = "SELECT loginPassword FROM usertable WHERE loginID = '$loginID'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        $getLoginPassword = $row['loginPassword'];
        
        if (password_verify($loginPassword, $getLoginPassword)) {
            return 'login';
            
        } else {
            return 'noRegistration';
            
        }
        mysqli_close($link);
    }
}
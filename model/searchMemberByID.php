<!-- model/searchMemberByID.php-->
<?php
class searchMemberByID {
    // 変数初期化
    private $loginID = null;
 
    public function searchMemberByID($loginID){
        // DB接続情報
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;

        if ($loginID == null) {
            $result = null;
            
        } else {
            $query = "SELECT * FROM usertable WHERE loginID = '$loginID'";
            $result = mysqli_query($link, $query);
            $result = mysqli_fetch_array($result);
            
        }
        
        mysqli_close($link);
        
        return $result;
    }
}
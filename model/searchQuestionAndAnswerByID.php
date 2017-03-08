<!-- model/searchQuestionAndAnswerByID.php-->
<?php
class searchQuestionAndAnswerByID {
    // 変数初期化
    private $loginID = null;
 
    public function searchQuestionAndAnswerByID($loginID){
        // DB接続情報
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;

        $query = "SELECT question, answer FROM usertable WHERE loginID = '$loginID'";
        $result = mysqli_query($link, $query);
        $result = mysqli_fetch_array($result);
        
        mysqli_close($link);
        
        return $result;
    }
}
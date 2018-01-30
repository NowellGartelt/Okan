<!-- model/registMember.php -->
<?php
class registMember {
    private $loginID = null;
    private $password = null;
    private $name = null;
    private $registDate = null;
    private $isAdmin = null;
    private $question = null;
    private $answer = null;
    private $defTax = null;
    private $query_registIncInfo = null;
    // private $memberInfo = null;

    // コンストラクタ、何もしない
    public function __construct() {
        
    }
    
    public function registMember($loginID, $password, $name, $registDate, $isAdmin, 
            $question, $answer, $defTax) {
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->password = $password;
        $this->name = $name;
        $this->registDate = $registDate;
        $this->isAdmin = $isAdmin;
        $this->question = $question;
        $this->answer = $answer;
        $this->defTax = $defTax;
        
        if ($loginID == null || $password == null || $name == null || 
                $registDate == null || $question == null || $answer == null) {
            return $memberInfo;

        } else {
            // メンバー情報の登録
            $query_registMember =
                "INSERT INTO usertable (
                loginID, loginPassword, name, addDate, updateDate, isAdmin, question, answer, defTax)
                VALUES (
                '$loginID', '$password', '$name', '$registDate', null, '$isAdmin', '$question', '$answer', '$defTax')";
            $result_registMember = mysqli_query($link, $query_registMember);
            $memberInfo = mysqli_fetch_array($result_registMember);

        }
        
        mysqli_close($link);
        
        return $memberInfo;
    }
}
?>
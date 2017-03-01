<!-- model/registMember.php -->
<?php
class registMember {
    private $loginID = null;
    private $password = null;
    private $name = null;
    private $registDate = null;
    private $isAdmin = null;
    private $query_registIncInfo = null;
    // private $memberInfo = null;

    public function registMember($loginID, $password, $name, $registDate, $isAdmin){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->password = $password;
        $this->name = $name;
        $this->registDate = $registDate;
        $this->isAdmin = $isAdmin;
        
        if ($loginID == null || $password == null || $name == null || $registDate == null) {
            return $memberInfo;

        } else {
            $query_registMember =
                "INSERT INTO usertable (
                loginID, loginPassword, name, addDate, updateDate, isAdmin)
                VALUES (
                '$loginID', '$password', '$name', '$registDate', null, '$isAdmin')";
            $result_registMember = mysqli_query($link, $query_registMember);
            $memberInfo = mysqli_fetch_array($result_registMember);

        }
        
        mysqli_close($link);
        
        return $memberInfo;
    }
}
?>
<!-- model/updatePassWord.php -->
<?php
class updatePassWord {
    private $loginID = null;
    private $password = null;
    
    public function updatePassWord($loginID, $password){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->password = $password;
        
        // すべてnullだった場合はnullを返して何もしない
        // include文による実行時の動作
        if ($loginID == null && $password == null) {
            return $memberInfo;
                    
        } else {
            // IDを元にパスワードの更新
            $query_updateMemberInfo = 
                "UPDATE usertable
                SET loginPassword = '$password' 
                WHERE loginID = '$loginID'";
            $result_updateMemberInfo = mysqli_query($link, $query_updateMemberInfo);
            $memberInfo = mysqli_fetch_array($result_updateMemberInfo);
            
        }
        mysqli_close($link);
        
        return $memberInfo;
    }
}
?>
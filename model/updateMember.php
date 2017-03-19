<!-- model/updateMember.php -->
<?php
class updateMember {
    private $query_updateMemberInfo = null;
    private $name = null;
    private $loginID = null;
    private $loginIDBefore = null;
    private $password = null;
    private $changeNameFlg = null;
    private $changelogIDFlg = null;
    private $changePasswordFlg = null;
    private $userID = null;
  
    public function updateMember($name, $loginID, $password, $changeNameFlg, 
            $changelogIDFlg, $changePasswordFlg, $userID, $loginIDBefore){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->name = $name;
        $this->loginID = $loginID;
        $this->password = $password;
        $this->changeNameFlg = $changeNameFlg;
        $this->changelogIDFlg = $changelogIDFlg;
        $this->changePasswordFlg = $changePasswordFlg;
        $this->userID = $userID;
        $this->loginIDBefore = $loginIDBefore;
        
        // すべてnullだった場合はnullを返して何もしない
        // include文による実行時の動作
        if ($name == null && $loginID == null && $password == null && 
                $changeNameFlg == null && $changelogIDFlg == null && $changePasswordFlg == null) {
            return $memberInfo;
                    
        } else {
            // 3つすべて更新する場合
            if ($changeNameFlg == true && $changelogIDFlg == true && $changePasswordFlg == true) {
                $query_updateMemberInfo = 
                    "UPDATE usertable 
                    SET name = '$name', loginID = '$loginID', loginPassword = '$password' 
                    WHERE userID = '$userID'";
                $result_updateMemberInfo = mysqli_query($link, $query_updateMemberInfo);
                $memberInfo = mysqli_fetch_array($result_updateMemberInfo);
                
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo = 
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$loginIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$loginIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
            // 2つ更新する場合
            // 名前とログインIDを変更する場合
            } elseif ($changeNameFlg == true && $changelogIDFlg == true) {
                $query_updateMemberInfo = 
                    "UPDATE usertable
                    SET name = '$name', loginID = '$loginID' 
                    WHERE userID = '$userID'";
                $result_updateMemberInfo = mysqli_query($link, $query_updateMemberInfo);
                $memberInfo = mysqli_fetch_array($result_updateMemberInfo);
            
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo =
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$loginIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$loginIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
            // ログインIDとパスワードを変更する場合
            } elseif ($changelogIDFlg == true && $changePasswordFlg == true) {
                $query_updateMemberInfo = 
                    "UPDATE usertable
                    SET loginID = '$loginID', loginPassword = '$password'
                    WHERE userID = '$userID'";
                $result_updateMemberInfo = mysqli_query($link, $query_updateMemberInfo);
                $memberInfo = mysqli_fetch_array($result_updateMemberInfo);
            
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo =
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$loginIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$loginIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
            // 名前とパスワードを変更する場合
            } elseif ($changeNameFlg == true && $changePasswordFlg == true) {
                $query_updateMemberInfo = 
                    "UPDATE usertable
                    SET name = '$name', loginPassword = '$password'
                    WHERE userID = '$userID'";
                $result_updateMemberInfo = mysqli_query($link, $query_updateMemberInfo);
                $memberInfo = mysqli_fetch_array($result_updateMemberInfo);
            
            // 1つ更新する場合
            // 名前を変更する場合
            } elseif ($changeNameFlg == true) {
                $query_updateMemberInfo = 
                    "UPDATE usertable
                    SET name = '$name' 
                    WHERE userID = '$userID'";
                $result_updateMemberInfo = mysqli_query($link, $query_updateMemberInfo);
                $memberInfo = mysqli_fetch_array($result_updateMemberInfo);
            
            // ログインIDを変更する場合
            } elseif ($changelogIDFlg == true) {
                $query_updateMemberInfo = 
                    "UPDATE usertable
                    SET loginID = '$loginID' 
                    WHERE userID = '$userID'";
                $result_updateMemberInfo = mysqli_query($link, $query_updateMemberInfo);
                $memberInfo = mysqli_fetch_array($result_updateMemberInfo);
            
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo =
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$loginIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$loginIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
            // パスワードを変更する場合
            } elseif ($changePasswordFlg == true) {
                $query_updateMemberInfo = 
                    "UPDATE usertable
                    SET loginPassword = '$password' 
                    WHERE userID = '$userID'";
                $result_updateMemberInfo = mysqli_query($link, $query_updateMemberInfo);
                $memberInfo = mysqli_fetch_array($result_updateMemberInfo);
            
            }
        }
        mysqli_close($link);
        
        return $memberInfo;
    }
}
?>
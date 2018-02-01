<?php
/**
 * パスワード更新クエリ実行クラス
 * 
 * ログインIDと更新後パスワードを受け取り、DBにパスワード更新のクエリを実行する
 * 
 * @author user
 * @access public
 * @package model
 * @name updatePassWord
 * @var string $loginID ログインID
 * @var string $password パスワード
 */

class updatePassWord {
    // インスタンス変数の定義
    private $loginID = null;
    private $password = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * パスワード更新クエリ実行関数
     * 
     * ログインIDと更新後パスワードを受け取り、DBにパスワード更新のクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $password パスワード
     * @return array $memberInfo クエリ実行結果
     */
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

        // DB切断
        mysqli_close($link);
        
        return $memberInfo;
    }
}

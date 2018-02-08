<?php
/**
 * ログイン情報照合クラス
 * 
 * ログインIDとパスワードを受け取り、DBにメンバー情報を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchMemberByLogIdAndPass
 * 
 * @var string $loginID ログインID
 * @var string $password パスワード
 */

class searchMemberByLogIdAndPass {
    // インスタンス変数の定義
    private $loginID = null;
    private $password = null;
    private $resultLogin = null;
 
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * ログイン情報照合関数
     * 
     * ログインIDとパスワードを受け取り、DBにメンバー情報を検索するクエリを実行する
     * 
     * @access public
     * @var string $loginID ログインID
     * @var string $password パスワード
     * @return string $resultLogin 照合結果
     */
    public function searchMemberByLogIdAndPass($loginID, $password){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        $this->password = $password;
        $resultLogin = "";

        // ログインIDから登録されたパスワードの取得
        $query = "SELECT loginPassword FROM usertable WHERE loginID = '$loginID'";
        $queryResult = mysqli_query($link, $query);
        $row = mysqli_fetch_array($queryResult);
        $getPassword = $row['loginPassword'];

        // DB切断
        mysqli_close($link);
        
        return $getPassword;
        
    }
}

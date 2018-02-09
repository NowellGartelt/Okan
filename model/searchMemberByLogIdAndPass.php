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
 * @var string $loginID ログインID
 * @var string $password パスワード
 */
class searchMemberByLogIdAndPass 
{
    // インスタンス変数の定義
    private $loginID = null;
    private $password = null;
    private $getPassword = null;
 
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() 
    {
        
    }
    
    /**
     * ログイン情報照合関数
     * 
     * ログインIDとパスワードを受け取り、DBにメンバー情報を検索するクエリを実行する
     * 
     * @access public
     * @var string $loginID ログインID
     * @var string $password パスワード
     * @return string ログインIDに紐付くパスワード(暗号化済)
     */
    public function searchMemberByLogIdAndPass(string $loginID, string $password)
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->password = $password;
        
        // いずれかの値が空の場合、nullを返す
        if ($loginID == null || $password == null) {
            $this->getPassword = null;
            
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            // ログインIDから登録されたパスワードの取得
            $query = "SELECT loginPassword FROM usertable WHERE loginID = '$loginID'";
            $queryResult = mysqli_query($link, $query);
            $row = mysqli_fetch_array($queryResult);
            $this->getPassword = $row['loginPassword'];
            
            // DB切断
            mysqli_close($link);
        
        }
        
        return $this->getPassword;
        
    }
}

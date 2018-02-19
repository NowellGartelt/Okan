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
 * @var object $model モデルクラス共通処理オブジェクト
 * @var string $loginID ログインID
 * @var string $password パスワード
 */
class searchMemberByLogIdAndPass 
{
    // インスタンス変数の定義
    private $model = "";
    private $loginID = "";
    private $password = "";
    private $getPassword = "";
 
    /**
     * コンストラクタ
     *
     * @access public
     */
    public function __construct() 
    {
        // モデルの共通処理取得
        require_once 'model.php';
        $this->model = new model();
        
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
            include 'tools/databaseConnect.php';
            
            // DB接続に失敗した場合
            if ($link == false) {
                $DBConnect = "failed";
                $this->model -> setDBConnectResult($DBConnect);
                $this->result = null;
                
            } else {
                $DBConnect = "success";
                $this->model -> setDBConnectResult($DBConnect);
                
                // ログインIDから登録されたパスワードの取得
                $query = "SELECT * FROM usertable WHERE loginID = '$loginID'";
                $queryResult = mysqli_query($link, $query);
                $row = mysqli_fetch_assoc($queryResult);
                $this->getPassword = $row['loginPassword'];
                
            }
            // DB切断
            mysqli_close($link);
        
        }
        return $this->getPassword;
        
    }
}

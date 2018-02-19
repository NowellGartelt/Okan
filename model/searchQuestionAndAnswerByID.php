<?php
/**
 * 秘密の質問・回答取得クエリ実行クラス
 * 
 * ログインIDを受け取り、DBに検索するクエリを実行し、秘密の質問と回答を検索する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchQuestionAndAnswerByID
 * @var object $model モデルクラス共通処理オブジェクト
 * @var string $loginID ログインID
 * @var array $result クエリ実行結果
 */
class searchQuestionAndAnswerByID 
{
    // インスタンス変数の定義
    private $model = "";
    private $loginID = "";
    private $result = array();
 
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
     * 秘密の質問・回答取得クエリ実行関数
     * 
     * ログインIDを受け取り、DBに検索するクエリを実行し、秘密の質問と回答を検索する
     * 
     * @access public
     * @param string $loginID ログインID
     * @return array ログインIDに紐付く秘密の質問、回答
     */
    public function searchQuestionAndAnswerByID(string $loginID)
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        
        if ($loginID == null) {
            $this->result = null;
            
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
                
                // メンバー情報に設定された秘密の質問と答えの取得
                $query = "SELECT question, answer FROM usertable WHERE loginID = '$loginID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_assoc($queryResult);
                
            }
            // DB切断
            mysqli_close($link);
        
        }
        return $this->result;
        
    }
}

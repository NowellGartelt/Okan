<?php
/**
 * メンバー情報検索クエリ実行クラス
 * 
 * ログインIDを受け取り、DBにメンバー情報を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchMemberIDByID
 * @var object $model モデルクラス共通処理オブジェクト
 * @var string $loginID ログインID
 * @var array $result クエリ実行結果
 */
class searchMemberIDByID 
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
     * ユーザID取得クエリ実行関数
     * 
     * ログインIDを受け取り、ユーザIDを取得するクエリを実行する
     * ユーザIDは各メンバーに割り当てられた一意で変更不可能なID
     * 
     * @param string $loginID
     * @return array
     */
    public function searchMemberIDByID(string $loginID) 
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        
        // 値がnullだった場合、nullを返す
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
                
                // ログインIDと一致するメンバー情報の取得
                $query = "SELECT * FROM usertable WHERE loginID = '$loginID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_assoc($queryResult);
                
            }
            // DB切断
            mysqli_close($link);
            
        }
        return $this->result;
        
    }
}

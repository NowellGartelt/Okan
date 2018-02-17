<?php
/**
 * ユーザデフォルト税率取得クラス
 * 
 * ユーザIDを元に、当該ユーザのデフォルト設定された税率を取得する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchDefTaxByID
 * @var int $userID ユーザID
 * @var int $defTax デフォルト税率
 */
class searchDefTaxByID 
{
    // インスタンス変数の定義
    private $model = "";
    private $userID = "";
    private $defTax = "";
    
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
     * デフォルト税率検索クエリ実行関数
     * 
     * ユーザIDを元に、当該ユーザのデフォルト設定された税率を取得する
     * 
     * @access public
     * @param int $userID ユーザID
     * @return int 取得したデフォルト税率
     */
    public function searchDefTaxByID(int $userID) 
    {
        // 引き渡された値の受け取り
        $this->userID = $userID;
        
        // いずれかの値がnullだった場合、nullを返す
        if ($userID == "") {
            $this->defTax = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // DB接続に失敗した場合
            if ($link == false) {
                $DBConnect = "failed";
                $this->model -> setDBConnectResult($DBConnect);
                $this->defTax = null;
                
            } else {            
                $DBConnect = "success";
                $this->model -> setDBConnectResult($DBConnect);
                
                $query = "SELECT * FROM usertable WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $row = mysqli_fetch_assoc($queryResult);
                $this->defTax = $row['defTax'];
            
            }
            // DB切断
            mysqli_close($link);
            
        }
        return $this->defTax;
        
    }
}

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
    private $userID = "";
    private $defTax = "";
    
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
        if ($userID == null) {
            $this->defTax = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            $query = "SELECT * FROM usertable WHERE userID = '$userID'";
            $queryResult = mysqli_query($link, $query);
            $row = mysqli_fetch_assoc($queryResult);
            $this->defTax = $row['defTax'];
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->defTax;
        
    }
}

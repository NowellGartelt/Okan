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
 * @var string $loginID ログインID
 * @var int $defTax デフォルト税率
 */
class searchDefTaxByID 
{
    // インスタンス変数の定義
    private $loginID = null;
    private $defTax = null;
    
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
     * @param string $loginID ログインID
     * @return int 取得したデフォルト税率
     */
    public function searchDefTaxByID(string $loginID) 
    {
        // 引き渡された値の受け取り
        $this->loginID = $loginID;
        
        // いずれかの値がnullだった場合、nullを返す
        if ($loginID == null) {
            $this->defTax = null;
            
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            $query = "SELECT defTax FROM usertable WHERE loginID = '$loginID'";
            $queryResult = mysqli_query($link, $query);
            $row = mysqli_fetch_array($queryResult);
            $this->defTax = $row['defTax'];
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->defTax;
        
    }
}

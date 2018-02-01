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

class searchDefTaxByID {
    private $loginID = null;
    private $defTax = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * デフォルト税率検索クエリ実行関数
     * 
     * ユーザIDを元に、当該ユーザのデフォルト設定された税率を取得する
     * 
     * @access public
     * @param string $loginID ログインID
     * @return int $getDefTax 取得したデフォルト税率
     */
    public function searchDefTaxByID($loginID) {
        $this->loginID = $loginID;
        
        include '../model/tools/databaseConnect.php';
        
        $query = "SELECT defTax FROM usertable WHERE loginID = '$loginID'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        $getDefTax = $row['defTax'];
        
        return $getDefTax;
        
        // DB切断
        mysqli_close($link);
    }
}

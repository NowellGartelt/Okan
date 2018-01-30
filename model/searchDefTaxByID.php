<?php
/**
 * ユーザデフォルト税率取得クラス
 * 
 * ユーザIDを元に、当該ユーザのデフォルト設定された税率を取得する
 * 
 * @access public
 * @package model
 * @name searchDefTaxByID
 * @var string $loginID
 * @var int $defTax
 * @param string $loginID
 * @return int $getDefTax
 * 
 */

class searchDefTaxByID {
    private $loginID = null;
    private $defTax = null;
    
    // コンストラクタ、何もしない
    public function __construct() {
        
    }
    
    public function searchDefTaxByID($loginID) {
        $this->loginID = $loginID;
        
        include '../model/tools/databaseConnect.php';
        
        $query = "SELECT defTax FROM usertable WHERE loginID = '$loginID'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        $getDefTax = $row['defTax'];
        
        return $getDefTax;

        mysqli_close($link);
    }
}

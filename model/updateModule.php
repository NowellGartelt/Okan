<?php
/**
 * モジュールフラグ更新クエリ実行クラス
 * 
 * モジュールフラグ更新情報を受け取り、各モジュールフラグを更新するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name updateModule
 * @var int $userID ユーザID
 * @var array $result クエリ実行結果
 */
class updateModule 
{
    private $userID = "";
    private $moduleTaxCalcFlg = "";
    private $modulePayNameFlg = "";
    private $modulePayCateFlg = "";
    private $modulePaymentFlg = "";
    private $modulePayMemoFlg = "";
    private $moduleIncNameFlg = "";
    private $moduleIncCateFlg = "";
    private $moduleIncMemoFlg = "";
    private $result = array();
    
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
     * モジュールフラグ更新用クエリ実行関数
     * 
     * モジュールフラグ更新情報を受け取り、DBにモジュールフラグを更新するクエリを実行する
     * 
     * @access public
     * @param int $userID ユーザID
     * @return array 更新クエリ実行結果
     */
    public function updateModule(int $userID, 
            int $taxCalcFlg, int $payNameFlg, int $payCateFlg, int $paymentFlg, int $payMemoFlg, 
            int $incNameFlg, int $incCateFlg, int $incMemoFlg)
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->moduleTaxCalcFlg = $taxCalcFlg;
        $this->modulePayNameFlg = $payNameFlg;
        $this->modulePayCateFlg = $payCateFlg;
        $this->modulePaymentFlg = $paymentFlg;
        $this->modulePayMemoFlg = $payMemoFlg;
        $this->moduleIncNameFlg = $incNameFlg;
        $this->moduleIncCateFlg = $incCateFlg;
        $this->moduleIncMemoFlg = $incMemoFlg;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($userID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // 入力された情報で支出情報の更新
            $query = "
                UPDATE usertable 
                SET taxCalcFlg = '$taxCalcFlg', payNameFlg = '$payNameFlg', payCateFlg = '$payCateFlg', paymentFlg = '$paymentFlg', 
                payMemoFlg = '$payMemoFlg', incNameFlg = '$incNameFlg', incCateFlg = '$incCateFlg', incMemoFlg = '$incMemoFlg'  
                WHERE userID = '$userID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_assoc($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;

    }
}

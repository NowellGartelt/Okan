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
 * @var int $moduleTaxCalcFlg 消費税自動計算機能使用フラグ
 * @var int $modulePayNameFlg 支出名使用フラグ
 * @var int $modulePayCateFlg 支出カテゴリ使用フラグ
 * @var int $modulePaymentFlg 支払方法使用フラグ
 * @var int $modulePayMemoFlg 支出一言メモ使用フラグ
 * @var int $moduleIncNameFlg 収入名使用フラグ
 * @var int $moduleIncCateFlg 収入カテゴリ使用フラグ
 * @var int $moduleIncMemoFlg 収入一言メモ使用フラグ
 * @var string $updateDate 更新日時
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
    private $updateDate = "";
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
     * @param int $taxCalcFlg 消費税自動計算機能使用フラグ
     * @param int $payNameFlg 支出名使用フラグ
     * @param int $payCateFlg 支出カテゴリ使用フラグ
     * @param int $paymentFlg 支払方法使用フラグ
     * @param int $payMemoFlg 支出一言メモ使用フラグ
     * @param int $incNameFlg 収入名使用フラグ
     * @param int $incCateFlg 収入カテゴリ使用フラグ
     * @param int $incMemoFlg 収入一言メモ使用フラグ
     * @param string $updateDate 更新日時
     * @return array 更新クエリ実行結果
     */
    public function updateModule(int $userID, 
            int $taxCalcFlg, int $payNameFlg, int $payCateFlg, int $paymentFlg, 
            int $payMemoFlg, int $incNameFlg, int $incCateFlg, int $incMemoFlg,
            string $updateDate)
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
        $this->updateDate = $updateDate;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($userID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // 入力された情報で支出情報の更新
            $query = "
                UPDATE usertable 
                SET taxCalcFlg = '$taxCalcFlg', payNameFlg = '$payNameFlg', payCateFlg = '$payCateFlg', 
                paymentFlg = '$paymentFlg', payMemoFlg = '$payMemoFlg', incNameFlg = '$incNameFlg', 
                incCateFlg = '$incCateFlg', incMemoFlg = '$incMemoFlg', updateDate = '$updateDate'  
                WHERE userID = '$userID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_assoc($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;

    }
}

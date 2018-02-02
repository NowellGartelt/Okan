<?php
/**
 * 支出情報登録クエリ実行クラス
 * 
 * 支出情報を受け取り、DBに登録するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name registPayByTrans
 * @var string $loginID ログインID
 * @var string $query_registPayInfo 支出情報登録クエリ
 * @var string $payName 支出名
 * @var int $payment 支出額
 * @var string $payCategory 支出カテゴリ
 * @var string $payState 支出情報一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
 * @var DateTime $payDate 支出日
 * @var DateTime $registDate 登録日
 * @var int $taxFlg 税別フラグ
 * @var int $tax 税率
 */

class registPayByTrans {
    // インスタンス変数の定義
    private $loginID = null;
    private $query_registPayInfo = null;
    private $payName = null;
    private $payment = null;
    private $payCategory = null;
    private $payState = null;
    private $payDate = null;
    private $registDate = null;
    private $taxFlg = null;
    private $tax = null;
    private $methodOfPaymet = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 支出情報登録クエリ実行関数
     * 
     * 支出情報を受け取り、DBに登録するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $payName 支出名
     * @param int $payment 支出額
     * @param string $payCategory 支出カテゴリ
     * @param string $payState 支出情報一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param DateTime $payDate 支出日
     * @param DateTime $registDate 登録日
     * @param int $taxFlg 税別フラグ
     * @param int $tax 税率
     * @return array $paymentInfo クエリ実行結果
     */
    public function registPayByTrans($loginID, $payName, $payment, $payCategory, 
            $payState, $payDate, $registDate, $taxFlg, $tax, $methodOfPaymet){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->payName = $payName;
        $this->payment = $payment;
        $this->payCategory = $payCategory;
        $this->payDate = $payDate;
        $this->payState = $payState;
        $this->id = $id;
        $this->taxFlg = $taxFlg;
        $this->tax = $tax;
        $this->methodOfPaymet = $methodOfPaymet;

        if ($loginID == "" || $payName == "" || $payment == "" || 
                $payCategory == "" || $payDate == "" || $registDate == "") {
            $paymentInfo = null;
            
        } else {
            // 支出情報の登録
            $query_registPay =
                "INSERT INTO paymentTable (
                payName, payment, payCategory, payState, payDate, registDate, updateDate, loginID, taxFlg, tax, mopID)
                VALUES (
                '$payName', '$payment', '$payCategory', '$payState', '$payDate', '$registDate', null, '$loginID', $taxFlg, $tax, $methodOfPaymet)";
            $result_registPayInfo = mysqli_query($link, $query_registPay);
            $paymentInfo = mysqli_fetch_array($result_registPayInfo);
            
        }
        
        // DB切断
        mysqli_close($link);
        
        return $paymentInfo;
    }
}

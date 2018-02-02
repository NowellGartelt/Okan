<?php
/**
 * 支出情報更新用クエリ実行クラス
 * 
 * 支出情報を受け取り、DBに支出情報を更新するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name updatePayByTrans
 * @var string $loginID ログインID
 * @var string $query_updatePayInfo 支出情報更新用クエリ
 * @var string $payName 支出名
 * @var int $payment 支出額
 * @var string $payCategory 支出カテゴリ
 * @var DateTime $payDate 支出日
 * @var string payState 支出一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
 * @var int $id 支出ID
 * @var boolean $taxFlg 税別フラグ
 * @var int $tax 税率  
 */

class updatePayByTrans {
    // インスタンス変数の定義
    private $loginID = null;
    private $query_updatePayInfo = null;
    private $payName = null;
    private $payment = null;
    private $payCategory = null;
    private $payDate = null;
    private $payState = null;
    private $id = null;
    private $taxFlg = null;
    private $tax = null;
    private $methodOfPayment = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 支出情報更新用クエリ実行関数
     * 
     * 支出情報を受け取り、DBに支出情報を更新するクエリを実行する
     * 
     * @access publc
     * @param string $loginID ログインID
     * @param string $query_updatePayInfo 支出情報更新用クエリ
     * @param string $payName 支出名
     * @param int $payment 支出額
     * @param string $payCategory 支出カテゴリ
     * @param DateTime $payDate 支出日
     * @param string payState 支出一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param int $id 支出ID
     * @param boolean $taxFlg 税別フラグ
     * @param int $tax 税率
     * @return array $paymentInfo クエリ実行結果
     */
    public function updatePayByTrans($loginID, $payName, $payment, $payCategory, 
            $payDate, $payState, $id, $taxFlg, $tax, $methodOfPayment){
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
        $this->methodOfPayment = $methodOfPayment;
        
        // 入力された情報で支出情報の更新
        $query_updatePayInfo =
            "UPDATE paymentTable 
            SET payName = '$payName', payment = '$payment', payCategory = '$payCategory',
            payDate = '$payDate', payState = '$payState', taxFlg = '$taxFlg', tax = '$tax', 
            mopID = '$methodOfPayment' 
            WHERE paymentID = '$id' AND loginID = '$loginID'";
        $result_updatePayInfo = mysqli_query($link, $query_updatePayInfo);
        $paymentInfo = mysqli_fetch_array($result_updatePayInfo);
        
        // DB切断
        mysqli_close($link);
        
        return $paymentInfo;
    }
}

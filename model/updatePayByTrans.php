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
 * @var string $payName 支出名
 * @var int $payment 支出額
 * @var string $payCategory 支出カテゴリ
 * @var string $payDate 支出日
 * @var string payState 支出一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
 * @var int $id 支出ID
 * @var boolean $taxFlg 税別フラグ
 * @var int $tax 税率  
 * @var array $result クエリ実行結果
 */
class updatePayByTrans 
{
    // インスタンス変数の定義
    private $loginID = null;
    private $payName = null;
    private $payment = null;
    private $payCategory = null;
    private $payDate = null;
    private $payState = null;
    private $id = null;
    private $taxFlg = null;
    private $tax = null;
    private $methodOfPayment = null;
    private $result = null;
    
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
     * @param string $payDate 支出日
     * @param string payState 支出一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param int $id 支出ID
     * @param boolean $taxFlg 税別フラグ
     * @param int $tax 税率
     * @param int $methodOfPayment 支払方法
     * @return array 更新クエリ実行結果
     */
    public function updatePayByTrans(string $loginID, string $payName, int $payment, string $payCategory, 
            string $payDate, string $payState, int $id, bool $taxFlg, int $tax, int $methodOfPayment)
    {
        // 引き渡された値の取得
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
        
        // 必須の値が空だった場合、nullを返す
        if ($loginID == null || $payment == null || $payDate == null || $id == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'model.php';
            $model = new model();
            $link = $model -> getDatabaseCon();
            
            // 入力された情報で支出情報の更新
            $query =
                "UPDATE paymentTable 
                SET payName = '$payName', payment = '$payment', payCategory = '$payCategory',
                payDate = '$payDate', payState = '$payState', taxFlg = '$taxFlg', tax = '$tax', 
                mopID = '$methodOfPayment' 
                WHERE paymentID = '$id' AND loginID = '$loginID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);
            
            // DB切断
            mysqli_close($link);
        
        }
        
        return $this->result;
        
    }
}

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
 * @var string $payName 支出名
 * @var int $payment 支出額
 * @var string $payCategory 支出カテゴリ
 * @var string $payState 支出情報一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
 * @var DateTime $payDate 支出日
 * @var DateTime $registDate 登録日
 * @var int $taxFlg 税別フラグ
 * @var int $tax 税率
 * @var array $result クエリ実行結果
 */
class registPayByTrans 
{
    // インスタンス変数の定義
    private $loginID = null;
    private $query = null;
    private $payName = null;
    private $payment = null;
    private $payCategory = null;
    private $payState = null;
    private $payDate = null;
    private $registDate = null;
    private $taxFlg = null;
    private $tax = null;
    private $methodOfPaymet = null;
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
     * @param string $payDate 支出日
     * @param string $registDate 登録日
     * @param int $taxFlg 税別フラグ
     * @param int $tax 税率
     * @param int $methodOfPaymet 支払方法
     * @return array 挿入クエリ実行結果
     */
    public function registPayByTrans(string $loginID, string $payName, int $payment, 
            string $payCategory, string $payState, string $payDate, string $registDate, 
            int $taxFlg, int $tax, int $methodOfPaymet)
    {
        // 引き渡された値の受け取り
        $this->loginID = $loginID;
        $this->payName = $payName;
        $this->payment = $payment;
        $this->payCategory = $payCategory;
        $this->payDate = $payDate;
        $this->registDate = $registDate;
        $this->payState = $payState;
        $this->taxFlg = $taxFlg;
        $this->tax = $tax;
        $this->methodOfPaymet = $methodOfPaymet;
        
        // いずれかの値がnullだった場合、nullを返す
        if ($loginID == "" || $payment == "" || $payDate == "" || $registDate == "") {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'model.php';
            $model = new model();
            $link = $model -> getDatabaseCon();
            
            // 支出情報の登録
            $query =
                "INSERT INTO paymentTable (
                payName, payment, payCategory, payState, payDate, registDate, updateDate, 
                loginID, taxFlg, tax, mopID)
                VALUES (
                '$payName', '$payment', '$payCategory', '$payState', '$payDate', '$registDate', 
                null, '$loginID', $taxFlg, $tax, $methodOfPaymet)";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);
            
            // DB切断
            mysqli_close($link);
        
        }
        
        return $this->result;
        
    }
}

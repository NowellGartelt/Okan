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
 * @var int $userID ユーザID
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
    private $model = "";
    private $userID = "";
    private $query = "";
    private $payName = "";
    private $payment = "";
    private $payCategory = "";
    private $payState = "";
    private $payDate = "";
    private $registDate = "";
    private $taxFlg = "";
    private $tax = "";
    private $methodOfPaymet = "";
    private $result = array();
    
    /**
     * コンストラクタ
     *
     * @access public
     */
    public function __construct() 
    {
        // モデルの共通処理取得
        require_once 'model.php';
        $this->model = new model();
        
    }
    
    /**
     * 支出情報登録クエリ実行関数
     * 
     * 支出情報を受け取り、DBに登録するクエリを実行する
     * 
     * @access public
     * @param int $userID ユーザID
     * @param string $payName 支出名
     * @param int $payment 支出額
     * @param string $payCategory 支出カテゴリ
     * @param string $payState 支出情報一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param string $payDate 支出日
     * @param string $registDate 登録日
     * @param int $taxFlg 税別フラグ
     * @param int $tax 税率
     * @param int $methodOfPaymet 支払方法
     * @return boolean 挿入クエリ実行結果
     */
    public function registPayByTrans(int $userID, string $payName, int $payment, 
            string $payCategory, string $payState, string $payDate, string $registDate, 
            int $taxFlg, int $tax, int $methodOfPaymet)
    {
        // 引き渡された値の受け取り
        $this->userID = $userID;
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
        if ($userID == "" || $payment == "" || $payDate == "" || $registDate == "") {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // DB接続に失敗した場合
            if ($link == false) {
                $DBConnect = "failed";
                $this->model -> setDBConnectResult($DBConnect);
                $this->result = null;
                
                
            } else {
                $DBConnect = "success";
                $this->model -> setDBConnectResult($DBConnect);
                
                // 事前確認
                $query = "
                    SELECT COUNT(*) 
                    FROM paymentTable 
                    WHERE userID = '$userID'
                    ";
                $queryResult = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($queryResult);
                $countBefore = (int) $result['COUNT(*)'];
                
                // 支出情報の登録
                $query = "
                    INSERT INTO paymentTable (
                    payName, payment, payCategory, payState, payDate, registDate, updateDate, 
                    userID, taxFlg, tax, mopID)
                    VALUES (
                    '$payName', '$payment', '$payCategory', '$payState', '$payDate', '$registDate', 
                    '$registDate', '$userID', $taxFlg, $tax, $methodOfPaymet)
                    ";
                $queryResult = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($queryResult);
                
                // 事後確認
                $query = "
                    SELECT COUNT(*)
                    FROM paymentTable
                    WHERE userID = '$userID'
                    ";
                $queryResult = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($queryResult);
                $countAfter = (int) $result['COUNT(*)'];
                
                $countDiff = $countAfter - $countBefore;
            
                if ($countDiff == 1) {
                    $this->result = true;
                    
                } else {
                    $this->result = false;
                    
                }
            }
            // DB切断
            mysqli_close($link);
        
        }
        
        return $this->result;
        
    }
}

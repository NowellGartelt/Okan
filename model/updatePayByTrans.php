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
 * @var int $userID ユーザID
 * @var string $payName 支出名
 * @var int $payment 支出額
 * @var string $payCategory 支出カテゴリ
 * @var string $payDate 支出日
 * @var string payState 支出一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
 * @var int $id 支出ID
 * @var boolean $taxFlg 税別フラグ
 * @var int $tax 税率
 * @var string $updateDate 更新日時
 * @var array $result クエリ実行結果
 */
class updatePayByTrans 
{
    // インスタンス変数の定義
    private $model = "";
    private $userID = "";
    private $payName = "";
    private $payment = "";
    private $payCategory = "";
    private $payDate = "";
    private $payState = "";
    private $id = "";
    private $taxFlg = "";
    private $tax = "";
    private $methodOfPayment = "";
    private $updateDate = "";
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
     * 支出情報更新用クエリ実行関数
     * 
     * 支出情報を受け取り、DBに支出情報を更新するクエリを実行する
     * 
     * @access publc
     * @param int $userID ユーザID
     * @param string $payName 支出名
     * @param int $payment 支出額
     * @param string $payCategory 支出カテゴリ
     * @param string $payDate 支出日
     * @param string payState 支出一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param int $id 支出ID
     * @param boolean $taxFlg 税別フラグ
     * @param int $tax 税率
     * @param int $methodOfPayment 支払方法
     * @param string $updateDate 更新日時
     * @return array 更新クエリ実行結果
     */
    public function updatePayByTrans(int $userID, string $payName, int $payment, string $payCategory, 
            string $payDate, string $payState, int $id, int $taxFlg, int $tax, int $methodOfPayment,
            string $updateDate)
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->payName = $payName;
        $this->payment = $payment;
        $this->payCategory = $payCategory;
        $this->payDate = $payDate;
        $this->payState = $payState;
        $this->id = $id;
        $this->taxFlg = $taxFlg;
        $this->tax = $tax;
        $this->methodOfPayment = $methodOfPayment;
        $this->updateDate = $updateDate;
        
        // 必須の値が空だった場合、nullを返す
        if ($userID == "" || $payment == "" || $payDate == "" || $id == "" 
                || $updateDate == "") {
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
                
                // 入力された情報で支出情報の更新
                $query = "
                    UPDATE paymentTable 
                    SET payName = '$payName', payment = '$payment', payCategory = '$payCategory',
                    payDate = '$payDate', payState = '$payState', taxFlg = '$taxFlg', tax = '$tax', 
                    mopID = '$methodOfPayment', updateDate = '$updateDate' 
                    WHERE paymentID = '$id' AND userID = '$userID'
                    ";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_assoc($queryResult);
                
            }
            // DB切断
            mysqli_close($link);
        
        }
        return $this->result;
        
    }
}

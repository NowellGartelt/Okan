<?php
/**
 * メンバー情報更新クラス
 * 
 * メンバー情報の更新のため、DBにアクセスするためのクラス
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name updateMember
 * @var string $name ユーザ名(更新後)
 * @var string $loginID ログインID(更新後)
 * @var string $logIDBefore ログインID(更新前)
 * @var string $password パスワード(更新後)
 * @var int $tax デフォルト税率(更新後)
 * @var boolean $chgNameFlg ユーザ名変更フラグ
 * @var boolean $chgLogIDFlg ログインID変更フラグ
 * @var boolean $chgPassFlg パスワード変更フラグ
 * @var boolean $chgTaxFlg デフォルト税率変更フラグ
 * @var int $userID ユーザID(変更不可)
 * @var array $result クエリ実行結果
 */
class updateMember 
{
    // インスタンス変数の定義
    private $query = null;
    private $name = null;
    private $loginID = null;
    private $logIDBefore = null;
    private $password = null;
    private $tax = null;
    private $chgNameFlg = null;
    private $chgLogIDFlg = null;
    private $chgPassFlg = null;
    private $chgTaxFlg = null;
    private $userID = null;
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
     * メンバー情報更新関数
     * 
     * メンバー情報の更新のため、DBにアクセスするためのクラス
     * 
     * @param string $name ユーザ名(更新後)
     * @param string $loginID ログインID(更新後)
     * @param string $password パスワード(更新後)
     * @param int $tax デフォルト税率(更新後)
     * @param boolean $chgNameFlg ユーザ名変更フラグ
     * @param boolean $chgLogIDFlg ログインID変更フラグ
     * @param boolean $chgPassFlg パスワード変更フラグ
     * @param boolean $chgTaxFlg デフォルト税率変更フラグ
     * @param int $userID ユーザID(変更不可)
     * @param string $logIDBefore ログインID(変更前)
     * @return array 更新クエリ実行結果
     */
    public function updateMember(string $name, string $loginID, string $password, int $tax, 
            bool $chgNameFlg, bool $chgLogIDFlg, bool $chgPassFlg, bool $chgTaxFlg, 
            int $userID, string $logIDBefore)
    {
        // 引き渡された値の取得
        $this->name = $name;
        $this->loginID = $loginID;
        $this->password = $password;
        $this->tax = $tax;
        $this->chgNameFlg = $chgNameFlg;
        $this->chgLogIDFlg = $chgLogIDFlg;
        $this->chgPassFlg = $chgPassFlg;
        $this->chgTaxFlg = $chgTaxFlg;
        $this->userID = $userID;
        $this->loginIDBefore = $logIDBefore;
        
        // すべてnullだった場合はnullを返して何もしない
        // include文による実行時の動作
        if ($name == null && $loginID == null && $password == null && $tax == null && 
                $chgNameFlg == null && $chgLogIDFlg == null && $chgPassFlg == null && $chgTaxFlg == null) {
            return $this->result;
                    
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            // 4つすべて更新する場合
            if ($chgNameFlg == true && $chgLogIDFlg == true && $chgPassFlg == true && $chgTaxFlg == true) {
                $query =
                    "UPDATE usertable
                    SET name = '$name', loginID = '$loginID', loginPassword = '$password', defTax = '$tax' 
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
                
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo =
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
            // 3つ更新する場合
            // 名前とログインIDとパスワードを変更する場合
            } elseif ($chgNameFlg == true && $chgLogIDFlg == true && $chgPassFlg == true) {
                $query = 
                    "UPDATE usertable 
                    SET name = '$name', loginID = '$loginID', loginPassword = '$password' 
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
                
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo = 
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
            // 名前とログインIDとデフォルト税率を変更する場合
            } elseif ($chgNameFlg == true && $chgLogIDFlg == true && $chgTaxFlg == true) {
                $query =
                    "UPDATE usertable
                    SET name = '$name', loginID = '$loginID', defTax = '$tax'
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
                
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo =
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
            // ログインIDとパスワードとデフォルト税率を変更する場合
            } elseif ($chgLogIDFlg == true && $chgPassFlg == true && $chgTaxFlg == true) {
                $query =
                    "UPDATE usertable
                    SET loginID = '$loginID', loginPassword = '$password', defTax = '$tax'
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
                
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo =
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
            // 名前とパスワードとデフォルト税率を変更する場合
            } elseif ($chgNameFlg == true && $chgPassFlg == true && $chgTaxFlg == true) {
                $query =
                    "UPDATE usertable
                    SET name = '$name', loginPassword = '$password', defTax = '$tax' 
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
                
            // 2つ更新する場合
            // 名前とログインIDを変更する場合
            } elseif ($chgNameFlg == true && $chgLogIDFlg == true) {
                $query = 
                    "UPDATE usertable
                    SET name = '$name', loginID = '$loginID' 
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
            
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo =
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
            // ログインIDとパスワードを変更する場合
            } elseif ($chgLogIDFlg == true && $chgPassFlg == true) {
                $query = 
                    "UPDATE usertable
                    SET loginID = '$loginID', loginPassword = '$password'
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
            
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo =
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
            // 名前とパスワードを変更する場合
            } elseif ($chgNameFlg == true && $chgPassFlg == true) {
                $query = 
                    "UPDATE usertable
                    SET name = '$name', loginPassword = '$password'
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
            
            // 名前とデフォルト税率を変更する場合
            } elseif ($chgNameFlg == true && $chgTaxFlg == true) {
                $query =
                    "UPDATE usertable
                    SET name = '$name', defTax = '$tax'
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
                
            // ログインIDとデフォルト税率を変更する場合
            } elseif ($chgLogIDFlg == true && $chgTaxFlg == true) {
                $query =
                    "UPDATE usertable
                    SET loginID = '$loginID', defTax = '$tax'
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
                
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo =
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
             // パスワードとデフォルト税率を変更する場合
            } elseif ($chgPassFlg == true && $chgTaxFlg == true) {
                $query =
                    "UPDATE usertable
                    SET loginPassword = '$password', defTax = '$tax'
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
                
            // 1つ更新する場合
            // 名前を変更する場合
            } elseif ($chgNameFlg == true) {
                $query = 
                    "UPDATE usertable
                    SET name = '$name' 
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
            
            // ログインIDを変更する場合
            } elseif ($chgLogIDFlg == true) {
                $query = 
                    "UPDATE usertable
                    SET loginID = '$loginID' 
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
            
                // ログインIDを変更する場合、これまでの支払い情報と収入情報をすべて変更する
                $query_updatePaymentInfo =
                    "UPDATE paymentTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updatePaymentInfo = mysqli_query($link, $query_updatePaymentInfo);
                $paymentInfo = mysqli_fetch_array($result_updatePaymentInfo);
                
                $query_updateIncomeInfo =
                    "UPDATE incomeTable
                    SET loginID = '$loginID'
                    WHERE loginID = '$logIDBefore'";
                $result_updateIncomeInfo = mysqli_query($link, $query_updateIncomeInfo);
                $incomeInfo = mysqli_fetch_array($result_updateIncomeInfo);
                
            // パスワードを変更する場合
            } elseif ($chgPassFlg == true) {
                $query = 
                    "UPDATE usertable
                    SET loginPassword = '$password' 
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
            
            // デフォルト税率を変更する場合
            } elseif ($chgTaxFlg == true) {
                $query =
                    "UPDATE usertable
                    SET defTax = '$tax'
                    WHERE userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
                
            }
            
            // DB切断
            mysqli_close($link);
            
        }

        return $this->result;
        
    }
}

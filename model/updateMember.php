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
        if (($name == null && $loginID == null && $password == null && $tax == null 
                && $chgNameFlg == null && $chgLogIDFlg == null && $chgPassFlg == null && $chgTaxFlg == null)
                || $userID == null) {
            return $this->result;
                    
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            $query = "";
            $queryUpdate = "UPDATE usertable ";
            $querySet = "SET ";
            $queryWhere = " WHERE userID = '$userID'";
            
            $queryCount = 0;
            
            if ($chgNameFlg == true) {
                $querySet .= "name = '$name'";
                $queryCount = $queryCount + 1;
            }
            if ($chgLogIDFlg == true) {
                if ($queryCount > 0) {
                    $querySet .= ", ";
                }
                $querySet .= "loginID = '$loginID'";
                $queryCount = $queryCount + 1;
                
            }
            if ($chgPassFlg == true) {
                if ($queryCount > 0) {
                    $querySet .= ", ";
                }
                $querySet .= "loginPassword = '$password'";
                $queryCount = $queryCount + 1;
                
            }
            if ($chgTaxFlg == true) {
                if ($queryCount > 0) {
                    $querySet .= ", ";
                }
                $querySet .= "defTax = '$tax'";
                $queryCount = $queryCount + 1;
                
            }
            
            $query = $queryUpdate.$querySet.$queryWhere;
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);
            
            if ($chgLogIDFlg == true) {
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
            
            }
            
            // DB切断
            mysqli_close($link);
            
        }

        return $this->result;
        
    }
}

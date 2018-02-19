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
 * @var object $model モデルクラス共通処理オブジェクト
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
 * @var string $updateDate 更新日時
 * @var array $result クエリ実行結果
 */
class updateMember 
{
    // インスタンス変数の定義
    private $model = "";
    private $query = "";
    private $name = "";
    private $loginID = "";
    private $logIDBefore = "";
    private $password = "";
    private $tax = "";
    private $chgNameFlg = "";
    private $chgLogIDFlg = "";
    private $chgPassFlg = "";
    private $chgTaxFlg = "";
    private $userID = "";
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
     * @param string $updateDate 更新日時
     * @return array 更新クエリ実行結果
     */
    public function updateMember(string $name, string $loginID, string $password, int $tax, 
            bool $chgNameFlg, bool $chgLogIDFlg, bool $chgPassFlg, bool $chgTaxFlg, 
            int $userID, string $logIDBefore, string $updateDate)
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
        $this->updateDate = $updateDate;
        
        // すべてnullだった場合はnullを返して何もしない
        // include文による実行時の動作
        if (($name == null && $loginID == null && $password == null && $tax == null 
                && $chgNameFlg == null && $chgLogIDFlg == null && $chgPassFlg == null && $chgTaxFlg == null)
                || $userID == null || $updateDate == null) {
            return $this->result;
                    
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
                
                // SQL文初期設定
                $query = "";
                
                $queryUpdate = "UPDATE usertable ";
                $querySet = "SET updateDate = '$updateDate'";
                $queryWhere = " WHERE userID = '$userID'";
                
                // 名前変更フラグが立ってる場合、名前を条件に追記
                if ($chgNameFlg == true) {
                    $querySet .= ", name = '$name'";
                    
                }
                // ログインID変更フラグが立ってる場合、ログインIDを条件に追記
                if ($chgLogIDFlg == true) {
                    $querySet .= ", loginID = '$loginID'";
                                    
                }
                // パスワード変更フラグが立ってる場合、パスワードを条件に追記
                if ($chgPassFlg == true) {
                    $querySet .= ", loginPassword = '$password'";
                    
                }
                // デフォルト税率変更フラグが立ってる場合、デフォルト税率を条件に追記
                if ($chgTaxFlg == true) {
                    $querySet .= ", defTax = '$tax'";
                    
                }
                
                // SQL文連結作成
                $query = $queryUpdate.$querySet.$queryWhere;
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_array($queryResult);
                
            }
            // DB切断
            mysqli_close($link);
            
        }
        return $this->result;
        
    }
}

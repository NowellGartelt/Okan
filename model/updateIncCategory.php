<?php
/**
 * 収入カテゴリ更新クエリ実行クラス
 * 
 * 収入カテゴリ更新情報を受け取り、カテゴリ名を更新するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name updateIncCategory
 * @var object $model モデルクラス共通処理オブジェクト
 * @var int $userID ユーザID
 * @var string $categoryName カテゴリ名
 * @var int $categoryID カテゴリID(個人用のカテゴリID)
 * @var string $updateDate 更新日時
 * @var array $result クエリ実行結果
 */
class updateIncCategory 
{
    // インスタンス変数の定義
    private $model = "";
    private $userID = "";
    private $categoryName = "";
    private $categoryID = "";
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
     * 収入カテゴリ更新用クエリ実行関数
     * 
     * 収入カテゴリ更新情報を受け取り、DBにカテゴリ名を更新するクエリを実行する
     * 
     * @access public
     * @param int $userID ユーザID
     * @param string $categoryName カテゴリ名
     * @param int $categoryID カテゴリID(個人用のカテゴリID)
     * @param string $updateDate 更新日時
     * @return array 更新クエリ実行結果
     */
    public function updateIncCategory(int $userID, string $categoryName, 
            int $categoryID, string $updateDate)
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->categoryName = $categoryName;
        $this->categoryID = $categoryID;
        $this->updateDate = $updateDate;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($userID == null || $categoryName == null || $categoryID == null || $updateDate == null) {
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
                    UPDATE incCategoryTable 
                    SET categoryName = '$categoryName', updateDate = '$updateDate' 
                    WHERE personalID = '$categoryID' AND userID = '$userID'";
                $queryResult = mysqli_query($link, $query);
                
            }
            // DB切断
            mysqli_close($link);
            
        }
        return $this->result;

    }
}

<?php
/**
 * 支出カテゴリ更新クエリ実行クラス
 * 
 * 支出カテゴリ更新情報を受け取り、カテゴリ名を更新するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name updatePayCategory
 * @var int $userID ユーザID
 * @var string $categoryName カテゴリ名
 * @var int $categoryID カテゴリID(個人用のカテゴリID)
 * @var string $updateDate 更新日時
 * @var array $result クエリ実行結果
 */
class updatePayCategory 
{
    private $userID = "";
    private $categoryName = "";
    private $categoryID = "";
    private $updateDate = "";
    private $result = array();
    
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
     * 支出カテゴリ更新用クエリ実行関数
     * 
     * 支出カテゴリ更新情報を受け取り、DBにカテゴリ名を更新するクエリを実行する
     * 
     * @access public
     * @param int $userID ユーザID
     * @param string $categoryName カテゴリ名
     * @param int $categoryID カテゴリID(個人用のカテゴリID)
     * @param string $updateDate 更新日時
     * @return array 更新クエリ実行結果
     */
    public function updatePayCategory(int $userID, string $categoryName, int $categoryID,
            string $updateDate)
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->categoryName = $categoryName;
        $this->categoryID = $categoryID;
        $this->updateDate = $updateDate;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($userID == null || $categoryName == null || $categoryID == null 
                || $updateDate == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // 入力された情報で支出情報の更新
            $query = "
                UPDATE payCategoryTable 
                SET categoryName = '$categoryName', 
                updateDate = '$updateDate' 
                WHERE personalID = '$categoryID' AND userID = '$userID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_assoc($queryResult);
            
            // DB切断
            mysqli_close($link);

        }
        
        return $this->result;
        
    }
}

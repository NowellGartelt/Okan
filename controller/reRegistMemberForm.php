<!-- controller/registPayForm.php -->
<?php
session_start();

// 入力内容エラーによる再表示ではない場合、エラーフラグをすべてリセットする。
if (!$errorFlg) {
    $errorInputInfo = false;
    $errorShortLoginID = false;
    $errorRegistedLoginID = false;
    $errorPasswordCondition = false;
    
}

include '../view/registMemberForm.php';
?>
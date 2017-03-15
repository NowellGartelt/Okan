<!-- controller/updateMemberForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

include '../model/searchMemberByID.php';

// ログイン中のメンバー情報の取得
$result = new searchMemberByID($loginID);
$searchMemberByID = $result -> searchMemberByID($loginID);
$memberInfo = $searchMemberByID;

include '../view/updateMemberForm.php';
?>
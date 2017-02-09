<!-- controller/refePaySortByForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

include '../view/refPaySortByForm.php';
?>
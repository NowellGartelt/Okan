<!-- controller/forgotMemberForm.php -->
<?php
session_start();

if (!$errorFlg) {
    $errorNoInput = false;
    $errorNoRegistration = false;
    $errorQuestionNotMatch = false;
    $errorAnswerNotMatch = false;
    
}

include '../view/forgotMemberForm.php';
?>
<!-- 
view/forgotMemberForm.php
-->
<html>
 <head>
  <title>Okan：メンバー情報忘れ</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」のメンバー登録画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <br><br>
  <div align="center">
   <p>Okan：メンバー情報忘れ</p><br>
<?php if ($errorFlg == true) {?>
<?php     if ($errGetInfo == "emptyList") { ?>
   <p>悪いわねぇ、画面開くの失敗しちゃったわ</p>
   <p>もういっかい入れ直してくれる？</p><br>
<?php     } elseif ($errInput == "noInput") { ?>
   <p>ちょっと、項目が足りてないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php     } elseif ($errInput == "noRegistration" 
                || $errInput == "errQuestionNoMatch" 
                || $errInput == "errAnswerNotMatch") {?>
   <p>ちょっと、その情報じゃ登録されてないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php     } ?>
<?php } else {?>
   <p>パスワード忘れたの？</p>
   <p>仕方ないわねー...まずは秘密の質問と、その答えを書きなさいよね</p><br>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/forgotMemberResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>ログインIDは？※：</td>
       <td><input type="text" name="loginID"></td>
      </tr>
      <tr>
       <td>秘密の質問は？※：</td>
       <td><input type="text" name="question"></td>
      </tr>
      <tr>
       <td>質問の答えは？※：</td>
       <td><input type="text" name="answer"></td>
      </tr>
     </tbody>
    </table>
    <br>
    <a>※は必須項目よ。</a>
    <br>
    <br>
    <button type="submit">オカンに教える</button>
   </form>
   <form action="../../Okan/login.php" method="post">
    <input type="hidden" name="fromPage" value="forgotMember"; ?>
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
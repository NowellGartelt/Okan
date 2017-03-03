<!-- view/forgetMemberForm.php -->
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
<?php if ($errorInputInfo == true) { ?>
   <p>ちょっと、項目が足りてないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } elseif ($errorShortLoginID == true) { ?>
   <p>ちょっと、ログインIDの長さが足りてないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } elseif ($errorRegistedLoginID == true) { ?>
   <p>そのログインIDは既に使われてて、登録できないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } elseif ($errorPasswordCondition == true) { ?>
   <p>ちょっと、パスワードが条件に合ってないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } else {?>
   <p>パスワード忘れたの？</p>
   <p>仕方ないわねー...まずは秘密の質問と、それに答えなさいね</p><br>
<?php } ?>
   <img src="../cosmetics/img/カーチャン.gif">
   <br><br>
   <p></p>
   <form action="../controller/reRegistMemberForm.php" method="post">
    <table>
     <tbody>
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
   <form action="../controller/login.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
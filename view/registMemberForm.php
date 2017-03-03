<!-- view/registMemberForm.php -->
<html>
 <head>
  <title>Okan：メンバー登録</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」のメンバー登録画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <br><br>
  <div align="center">
   <p>Okan：メンバー登録</p><br>
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
   <p>今日からいろいろと手伝ったげるわよ</p>
   <p>まずはあんたのことを教えなさいよね</p><br>
<?php } ?>
   <img src="../cosmetics/img/カーチャン.gif">
   <br><br>
   <p></p>
   <form action="../controller/registMemberResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>名前はどうするの？※：</td>
       <td><input type="text" name="name"></td>
      </tr>
      <tr>
       <td>IDはどうするの？※：</td>
       <td><input type="text" name="loginID"></td>
      </tr>
      <tr>
       <td>パスワードは？※：</td>
       <td><input type="password" name="password"></td>
      </tr>
     </tbody>
    </table>
    <br>
    <a>※は必須項目よ。</a>
    <br>
    <br>
    <table>
      <tr>
       <td><h6>ログインID：</h6></td>
       <td><h6>6文字以上、他ユーザーの使用済みのものは使用不可</h6></td>
      </tr>
      <tr>
       <td><h6>パスワード：</h6></td>
       <td><h6>数字、アルファベット小文字、大文字、<br>
       記号(!, ?, -, _, @, +, &)からそれぞれ1文字づつ使うこと<br>
       計6文字以上であること</h6></td>
      </tr>
    </table>
    <br>
    <button type="submit">オカンに教える</button>
   </form>
   <form action="../controller/login.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
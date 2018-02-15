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
<?php if ($errFlg == true) { ?>
<?php   if ($errInput == "lackInput") { ?>
   <p>ちょっと、項目が足りてないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php   } elseif ($errInput == "errLengthLoginID") { ?>
   <p>ちょっと、ログインIDの長さがおかしいわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php   } elseif ($errInput == "errTaxRange") { ?>
   <p>ちょっと、ログインIDが長すぎるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php   } elseif ($errInput == "registedLoginID") { ?>
   <p>そのログインIDは既に使われてて、登録できないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php   } elseif ($errInput == "passwordCondition") { ?>
   <p>ちょっと、パスワードが条件に合ってないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php   } else { ?>
   <p>今日からいろいろと手伝ったげるわよ</p>
   <p>まずはあんたのことを教えなさいよね</p><br>
<?php   } ?>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/registMemberResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>名前はどうするの？※：</td>
       <td><input type="text" name="name" style="width: 150px"></td>
      </tr>
      <tr>
       <td>IDはどうするの？※：</td>
       <td><input type="text" name="loginID" style="width: 150px"></td>
      </tr>
      <tr>
       <td>パスワードは？※：</td>
       <td><input type="password" name="password" style="width: 150px"></td>
      </tr>
      <tr>
       <td>デフォルトで使う税率は？：</td>
       <td><input type="number" name="defTax" style="width: 150px"> %</td>
      </tr>
      <tr>
       <td>秘密の質問は？※：</td>
       <td><input type="text" name="question" style="width: 150px"></td>
      </tr>
      <tr>
       <td>秘密の質問に対する答えは？※：</td>
       <td><input type="text" name="answer" style="width: 150px"></td>
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
       <td><h6>6文字以上10文字以下、他ユーザーの使用済みのものは使用不可</h6></td>
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
   <form action="../../Okan/login.php" method="post">
    <input type="hidden" name="fromPage" value="registMember"; ?>
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
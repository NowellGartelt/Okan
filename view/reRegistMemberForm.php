]<!-- view/reRegistMemberForm.php -->
<html>
 <head>
  <title>Okan：パスワード再登録</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」のパスワード再登録画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <br><br>
  <div align="center">
   <p>Okan：パスワード再登録</p><br>
<?php if ($errorFlg == true) { ?>
<?php     if ($errorNoInput == true) { ?>
   <p>ちょっと、何も入力されてないじゃない</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php     } elseif ($errorPasswordUnmatch == true) { ?>
   <p>ちょっと、パスワードと確認の方が一致しないじゃない</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php     } elseif ($errorPasswordCondition == true) { ?>
   <p>ちょっと、パスワードが条件を満たしてないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php     }?>
<?php } else {?>
   <p>パスワードを再登録するのね？</p>
   <p>今度は忘れるんじゃないわよ</p><br>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/reRegistMemberResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>新しいパスワードは？※：</td>
       <td><input type="password" name="password" style="width: 150px"></td>
      </tr>
      <tr>
       <td>確認でもっかい入れるのよ ※：</td>
       <td><input type="password" name="passwordCheck" style="width: 150px"></td>
      </tr>
     </tbody>
    </table>
    <br>
    <a>※は必須項目よ。</a>
    <br>
    <br>
    <table>
      <tr>
       <td><h6>パスワード：</h6></td>
       <td><h6>数字、アルファベット小文字、大文字、<br>
       記号(!, ?, -, _, @, +, &)からそれぞれ1文字づつ使うこと<br>
       計6文字以上であること</h6></td>
      </tr>
    </table>
    <input type="hidden" name="loginID" value=<?php echo $loginID; ?>>
    <button type="submit">オカンに教える</button>
   </form>
   <form action="../../Okan/login.php" method="post">
    <input type="hidden" name="fromPage" value="reRegistMember"; ?>
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
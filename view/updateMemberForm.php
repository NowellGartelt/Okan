<!-- view/updateMemberForm.php -->
<html>
 <head>
  <title>Okan：メンバー情報更新</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の更新画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <div align="right">
   <p>LoginID：<?php echo $loginID; ?></p>
   <form action="../controller/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：メンバー情報更新</p><br>
<?php if ($errorInputInfo == false) { ?>
   <p>メンバー情報を変更するのね？</p>
   <p>新しいのをどうするのか、ちゃんと考えなさいよね</p><br>
<?php } elseif ($errorInputInfo == true) { ?>
   <p>ちょっと、項目が間違ってるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } ?>
   <img src="../cosmetics/img/カーチャン.gif">
   <br><br>
   <p></p>
   <form action="../controller/updateMemberResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>名前は？：</td>
       <td><input type="text" name="name" value=<?php echo $memberInfo['name']; ?>></td>
      </tr>
      <tr>
       <td>ログインIDは？：</td>
       <td><input type="text" name="loginID" value=<?php echo $memberInfo['loginID']; ?>></td>
      </tr>
      <tr>
       <td>パスワードは？：</td>
       <td><input type="password" name="password"></td>
      </tr>
     </tbody>
    </table>
    <br>
    <input type="hidden" name="userID" value=<?php echo $memberInfo['userID']; ?>>
    <input type="hidden" name="nameBefore" value=<?php echo $memberInfo['name']; ?>>
    <input type="hidden" name="loginIDBefore" value=<?php echo $memberInfo['loginID']; ?>>
    <input type="hidden" name="passwordBefore" value=<?php echo $memberInfo['loginPassword']; ?>>
    <button type="submit">オカンに教え直す</button>
   </form>
   <form action="../controller/menu.php" method="post">
    <input type="hidden" name="page" value="update">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
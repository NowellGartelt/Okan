<!-- view/login.php -->
<html>
 <head>
  <title>Okan：ログイン</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」のログイン画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <div align="center">
   <br><br>
   <p>Okan：ログイン</p><br>
<?php if ($login == "emptyIDorPass") { ?>
   <p>ちょっと、何も入力してないじゃない</p>
   <p>もう一回確認しなさいよね</p><br>
<?php } elseif ($login == "noRegistration") { ?>
   <p>ちょっと、そのログインIDとパスワードだと登録されてないわよ</p>
   <p>もう一回確認しなさいよね</p><br>
<?php } else {?>
   <p>ん？あんた誰よ</p>
   <p>まずはログインIDとパスワードを教えなさいよね</p><br>
<?php }?>
   <img src="../cosmetics/img/カーチャン.gif">
   <br> <br>
   <form action="../controller/loginAction.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>ログインID：</td>
       <td><input type="text" name="loginID"></td>
      </tr>
      <tr>
       <td>パスワード：</td>
       <td><input type="password" name="loginPassword"></td>
      </tr>
     </tbody>
    </table>
    <br>
    <button type="submit">ログインする</button>
   </form>
   <table>
    <tr>
     <td>
      <form action="../controller/registMemberForm.php" method="post">
       <button type="submit">新規登録</button>
      </form>
     </td>
     <td>
      <form action="../controller/forgotMemberForm.php" method="post">
       <button type="submit">ID・パスワード忘れ</button>
      </form> 
     </td>
    </tr>
   </table>
   <br><br>
   <form action="mailto:fuen.works.999@gmail.com" method="post">
    <button type="submit">おかんに意見する</button>
   </form>
  </div>
 </body>
</html>
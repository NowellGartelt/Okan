<!-- view/registIncResult.php -->
<html>
 <head>
  <title>Okan：メンバー登録完了</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の登録完了画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <br><br>
  <div align="center">
   <p>Okan：メンバー登録完了</p><br>
   <p>ログインIDは<?php echo $loginID; ?>ね？覚えたわよ</p>
   <p>お金何に使ったのか、ちゃんと報告しなさいよね</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/login.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
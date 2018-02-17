<!-- view/errRegistPayResult.php -->
<html>
 <head>
  <title>Okan：登録失敗</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の登録失敗画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <div align="right">
   <p>LoginID：<?php echo $loginID; ?></p>
   <form action="../../Okan/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：登録失敗</p><br>
   <p>悪いわねぇ、覚えるのに失敗しちゃったわ</p>
   <p>登録画面から、もういっかい登録し直してくれる？</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
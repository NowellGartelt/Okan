<!-- view/errReferencePayResult.php -->
<html>
 <head>
  <title>Okan：参照失敗</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の支出の登録完了画面。">
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
   <p>Okan：参照失敗</p><br>
   <p>悪いわねぇ、探すのに失敗しちゃったわ</p>
   <p>参照画面から、もういっかい探し直してくれる？</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
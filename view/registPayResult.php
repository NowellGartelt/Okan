<!-- view/menu.php -->
<html>
　<head>
　 <title>Okan：登録完了</title>
　 <meta charset="UTF-8">
　 <meta name="description" content="収支管理システム「Okan」の登録完了画面。">
　 <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <p>Okan：登録完了</p><br>
  <p>xxにxx円ね？</p>
  <p>しょうがないわね、今日だけよ</p><br>
  <img src="../lib/img/カーチャン.gif">
  <br><br>
  <p></p>
  <form action="../controller/registPayForm.php" method="post">
   <input type="submit" value="もういっかい登録する">
  </form>
  <form action="../controller/menu.php" method="post">
   <input type="submit" value="戻る">
  </form>
　</body>
</html>
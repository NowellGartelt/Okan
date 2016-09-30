<!-- view/menu.php -->
<html>
　<head>
　 <title>Okan：削除完了</title>
　 <meta charset="UTF-8">
　 <meta name="description" content="収支管理システム「Okan」の削除完了画面。">
　 <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
　<div align="right">
   <form action="../controller/logout.php" method="post">
    <input type="submit" value="ログアウト">
   </form>
  </div>
  <center>
  <p>Okan：削除完了</p><br>
  <p><?php echo $payState; ?>で、<?php echo $payName; ?>に<?php echo $payment; ?>円使ったヤツね？</p>
  <p>取り消しといたたわよ</p><br>
  <img src="../lib/img/カーチャン.gif">
  <br><br>
  <p></p>
  <form action="../controller/referencePayResult.php" method="post">
   <input type="submit" value="もういっかい訊く">
  </form>
  <form action="../controller/menu.php" method="post">
   <input type="submit" value="戻る">
  </form>
  </center>
　</body>
</html>
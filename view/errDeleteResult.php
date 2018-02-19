<!-- view/errRegistPayResult.php -->
<html>
 <head>
  <title>Okan：削除失敗</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の削除失敗画面。">
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
   <p>Okan：削除失敗</p><br>
<?php if ($fromPage == "deleteIncForm" || $fromPage == "deletePayForm") { ?>
   <p>悪いわねぇ、消したい情報を探すの失敗しちゃったわ</p>
   <p>参照画面から、もういっかい表示し直してくれる？</p><br>
<?php } elseif ($fromPage == "deleteIncResult" || $fromPage == "deletePayResult") {?>
   <p>悪いわねぇ、消すのに失敗しちゃったわ</p>
   <p>削除確認画面から、もういっかい削除し直してくれる？</p><br>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
<?php if ($fromPage == "deleteIncForm" || $fromPage == "deleteIncResult") { ?>
   <form action="../../Okan/referenceIncResult.php" method="post">
<?php } elseif ($fromPage == "deletePayForm"|| $fromPage == "deletePayResult") {?>
   <form action="../../Okan/referencePayResult.php" method="post">
<?php } ?>
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
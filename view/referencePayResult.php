<!-- view/menu.php -->
<html>
　<head>
　 <title>Okan：検索結果</title>
　 <meta charset="UTF-8">
　 <meta name="description" content="収支管理システム「Okan」の検索結果画面。">
　 <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <center>
  <p>Okan：検索結果</p><br>
  <p>探したらこれだけ出てきたわよ</p>
  <p>無駄遣いばっかりして...しょうがないわねー</p><br>
  <img src="../lib/img/カーチャン.gif">
  <br><br>
  <p></p>
  <table>
    <thead>
      <th>日付</th>
      <th>名前</th>
      <th>金額</th>
      <th>カテゴリ</th>
    </thead>
    <tbody>
    <?php $j = 1; ?>
    <?php while ($j <= $i) { ?>
     <tr>
     <td><?php echo $payment[$j]['payDate']; ?></td>
     <td><?php echo $payment[$j]['payName']; ?></td>
     <td><?php echo $payment[$j]['payment']; ?></td>
     <td><?php echo $payment[$j]['payCategory']; ?></td>
     </tr>
    <?php $j++; ?>
    <?php } ?>
    </tbody>
  </table>
  <br>
  <form action="../controller/referencePayForm.php" method="post">
   <input type="submit" value="もういっかい訊く">
  </form>
  <form action="../controller/menu.php" method="post">
   <input type="submit" value="戻る">
  </form>
  </center>
　</body>
</html>
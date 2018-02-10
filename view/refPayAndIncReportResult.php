<!-- view/referencePayResult.php -->
<html>
 <head>
  <title>Okan：レポート結果</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」のレポート結果画面。">
  <meta name="keywords" content="収支管理,おかん">
  <link href="../../Okan/view/css/okanStyle.css" rel="stylesheet" type="text/css" media="all">
 </head>
 <body>
  <div align="right">
   <p>LoginID：<?php echo $loginID; ?></p>
   <form action="../../Okan/logout.php" method="post">
    <input type="submit" value="ログアウト">
   </form>
  </div>
  <div align="center">
   <p>Okan：レポート結果</p><br>
   <p><?php echo $dateFrom; ?>から<?php echo $dateTo ?>は、現金は
   <font size="5" color="black"><?php echo $difPayAndInc ?></font>円で
<?php if ($difPayAndIncStatus == "surplus") { ?>
   <font size="5" color="black">黒字</font>
<?php } elseif ($difPayAndIncStatus == "deficit") { ?>
   <font size="5" color="red">赤字</font>
<?php } else { ?>
   <font size="5" color="gray">プラスマイナスゼロ</font>
<?php }?>
   だったわよ</p>
<?php if ($difPayAndIncStatus == "surplus") { ?>
   <p>その調子で無駄遣いするんじゃないわよ</p><br>
<?php } elseif ($difPayAndIncStatus == "deficit") { ?>
   <p>無駄遣いばっかりして...しょうがないわねー</p><br>
<?php } else { ?>
   <p>もうちょっと頑張りなさいよね</p><br>
<?php }?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p>「もらったお金と使ったお金」がこれよ。</p>
   <table>
     <tbody>
      <tr>
       <th>分類</th>
       <th>金額</th>
      </tr>
      <tr>
       <td>もらったお金</td>
       <td><?php echo $sumInc[0]['SUM(income)']; ?></td>
      </tr>
      <tr>
       <td>使ったお金</td>
       <td><?php echo $sumPay[0]['SUM(payment)']; ?></td>
      </tr>
      <tr>
       <td>使ったお金(現金のみ)</td>
       <td><?php echo $sumPayOnlyCash[0]['SUM(payment)']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
      </tr>
     </tbody>
   </table>
   <br>
   <p>使ったお金が多い順にカテゴリごとにまとめたわよ。</p>
   <table>
     <tbody>
      <tr>
       <th>カテゴリ</th>
       <th>金額</th>
      </tr>
      <?php $displayCount = 0; ?>
      <?php while ($displayCount < count($sumPayCategory)) { ?>
      <tr>
       <td><?php echo $sumPayCategory[$displayCount]['categoryName']; ?></td>
       <td><?php echo $sumPayCategory[$displayCount]['SUM(payment)']; ?></td>
      </tr>
      <?php $displayCount++; ?>
      <?php } ?>
      <tr>
        <td></td>
        <td></td>
      </tr>
     </tbody>
   </table>
   <br>
   <p>使ったお金が多い順に支払方法ごとにまとめたわよ。</p>
   <table>
     <tbody>
      <tr>
       <th>支払方法</th>
       <th>金額</th>
      </tr>
      <?php $displayCount = 0; ?>
      <?php while ($displayCount < count($sumPayPayment)) { ?>
      <tr>
       <td><?php echo $sumPayPayment[$displayCount]['paymentName']; ?></td>
       <td><?php echo $sumPayPayment[$displayCount]['SUM(payment)']; ?></td>
      </tr>
      <?php $displayCount++; ?>
      <?php } ?>
      <tr>
        <td></td>
        <td></td>
      </tr>
     </tbody>
   </table>
   <br>
   <p>もらったお金が多い順にカテゴリごとにまとめたわよ。</p>
   <table>
     <tbody>
      <tr>
       <th>カテゴリ</th>
       <th>金額</th>
      </tr>
      <?php $displayCount = 0; ?>
      <?php while ($displayCount < count($sumIncCategory)) { ?>
      <tr>
       <td><?php echo $sumIncCategory[$displayCount]['categoryName']; ?></td>
       <td><?php echo $sumIncCategory[$displayCount]['SUM(income)']; ?></td>
      </tr>
      <?php $displayCount++; ?>
      <?php } ?>
      <tr>
        <td></td>
        <td></td>
      </tr>
     </tbody>
   </table>
   <br>
   <form action="../../Okan/refPayAndIncReportForm.php" method="post">
    <button type="submit">もういっかい訊く</button>
   </form>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
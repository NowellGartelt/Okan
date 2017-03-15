<!-- view/refPayAndIncReportForm.php -->
<html>
 <head>
  <title>Okan：レポート</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」のレポート画面。">
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
   <p>Okan：レポート</p><br>
<?php if ($errorNecessaryInfo == true) { ?>
   <p>ちょっと、その条件だと不足してるわよ</p>
   <p>条件を見直しなさいよね</p><br>
<?php } elseif ($errorOverOneYear == true) { ?>
   <p>ちょっと、その条件だと期間が長すぎるわよ</p>
   <p>366日以内に設定しなさいよね</p><br>
<?php } else { ?>
   <p>いつのを見たいの？？</p>
   <p>お金の使い方を振り返って、次は無駄遣いするんじゃないわよ</p><br>
<?php }?>
   <img src="../cosmetics/img/カーチャン.gif">
   <br><br>
   <p></p>
   <br>
   <form action="../controller/refPayAndIncReportResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>いつからいつまで？：</td>
       <td><input type="date" name="dateFrom" value=<?php echo date("Y-m-d"); ?>>  ～  
       <input type="date" name="dateTo" value=<?php echo date("Y-m-d"); ?>></td>
      </tr>
     </tbody>
    </table>
    <br>
    <button type="submit">オカンに訊く</button>
   </form>
   <form action="../controller/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
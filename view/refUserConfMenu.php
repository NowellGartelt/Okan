<!-- view/menu.php -->
<html>
 <head>
  <title>Okan：ユーザ設定メニュー</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」のユーザ設定メニューを表示。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <div align="right">
   <p>LoginID：<?php echo $loginID; ?></p>
   <form action="../Okan/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：ユーザ設定メニュー</p><br>
   <p>メンバー情報を変更するのね？</p>
   <p>新しいのをどうするのか、ちゃんと考えなさいよね</p>
   <br>
   <img src="cosmetics/img/okan.gif">
   <br> <br>
   <p>【やれること】</p>
   <table>
    <tbody>
     <tr>
      <td>ID、パスワード、名前、税率をかえる：</td>
      <td><a href="../../Okan/updateMemberForm.php">おかんにお願いする</a></td>
     </tr>
     <tr>
      <td>ぶんるいをかえる：</td>
      <td><a href="../../Okan/refCategoryForm.php">おかんにお願いする</a></td>
     </tr>
	</tbody>
   </table>
   <br>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
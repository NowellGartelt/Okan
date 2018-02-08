<!-- view/updateMemberForm.php -->
<html>
 <head>
  <title>Okan：メンバー情報更新</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の更新画面。">
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
   <p>Okan：メンバー情報更新</p><br>
<?php if ($errFlg == true) {?>
<?php     if ($errNoStatusChg == true) { ?>
   <p>ちょっと、今のヤツと何も変わってないじゃない</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php     } elseif ($errShortLoginID == true) {?>
   <p>ちょっと、ログインIDの長さが足りないわよ？</p>
   <p>ログインID6文字以上よ。もういっかい確認しなさいよね</p><br>
<?php     } elseif ($errRegistedLoginID == true) {?>
   <p>そのログインIDはもう使われちゃってるみたいよ？</p>
   <p>他のにしないとダメよ</p><br>
<?php     } elseif ($errPassCondition == true) { ?>
   <p>ちょっと、パスワードが条件を満たしてないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php     } else {?>
   <p>ちょっと、デフォルト税率がおかしな値になってるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php     } ?>
<?php } else {?>
   <p>メンバー情報を変更するのね？</p>
   <p>新しいのをどうするのか、ちゃんと考えなさいよね</p><br>
<?php }?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/updateMemberResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>名前は？：</td>
       <td><input type="text" name="name" style="width: 150px" value=<?php echo $memberInfo['name']; ?>></td>
      </tr>
      <tr>
       <td>ログインIDは？：</td>
       <td><input type="text" name="loginID" style="width: 150px" value=<?php echo $memberInfo['loginID']; ?> onInput="checkForm(this)"></td>
      </tr>
      <tr>
       <td>パスワードは？：</td>
       <td><input type="password" name="password" style="width: 150px"></td>
      </tr>
      <tr>
       <td>デフォルトの税率は？：</td>
       <td><input type="number" name="tax" style="width: 150px" value="<?php echo $memberInfo['defTax']; ?>"> %</td>
      </tr>
     </tbody>
    </table>
    <br>
    <table>
      <tr>
       <td><h6>ログインID：</h6></td>
       <td><h6>6文字以上、他ユーザーの使用済みのものは使用不可</h6></td>
      </tr>
      <tr>
       <td><h6>パスワード：</h6></td>
       <td><h6>数字、アルファベット小文字、大文字、<br>
       記号(!, ?, -, _, @, +, &)からそれぞれ1文字づつ使うこと<br>
       計6文字以上であること</h6></td>
      </tr>
    </table>
    <br>
    <input type="hidden" name="userID" value=<?php echo $memberInfo['userID']; ?>>
    <input type="hidden" name="nameBefore" value=<?php echo $memberInfo['name']; ?>>
    <input type="hidden" name="loginIDBefore" value=<?php echo $memberInfo['loginID']; ?>>
    <input type="hidden" name="passwordBefore" value=<?php echo $memberInfo['loginPassword']; ?>>
    <input type="hidden" name="taxBefore" value=<?php echo $memberInfo['defTax']; ?>>
    <button type="submit">オカンに教え直す</button>
   </form>
   <form action="../../Okan/refUserConfMenu.php" method="post">
    <input type="hidden" name="page" value="update">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>
<script type="text/javascript">
function checkForm($this)
{
	var str=$this.value;
	while(str.match(/[^A-Z^a-z\d\-]/))
	{
		str=str.replace(/[^A-Z^a-z\d\-]/,"");
	}
	$this.value=str;
}
</script>
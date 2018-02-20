<!-- view/login.php -->
<html>
 <head>
  <title>Okan：ログイン</title>
  <meta charset="UTF-8">
  <meta name="description" content="「Okan」は毎日のお金の収入と支出を記録したり、記録した収支を検索・収支レポートを見ることができるサービスです。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <div align="center">
   <br><br>
   <p>Okan：ログイン</p><br>
<?php if ($errGetInfo == "emptyList") { ?>
   <p>悪いわねぇ、画面の表示に失敗しちゃったわ</p>
   <p>再読み込みして、もういっかい画面を開き直してくれる？</p><br>
<?php } elseif ($login == "emptyIDorPass") { ?>
   <p>ちょっと、何も入力してないじゃない</p>
   <p>もう一回確認しなさいよね</p><br>
<?php } elseif ($login == "noRegistration") { ?>
   <p>ちょっと、そのログインIDとパスワードだと登録されてないわよ</p>
   <p>もう一回確認しなさいよね</p><br>
<?php } else {?>
   <p>ん？あんた誰よ</p>
   <p>まずはログインIDとパスワードを教えなさいよね</p><br>
<?php }?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <form action="../../Okan/loginAction.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>ログインID：</td>
       <td><input type="text" name="loginID" onInput="checkForm(this)"></td>
      </tr>
      <tr>
       <td>パスワード：</td>
       <td><input type="password" name="loginPassword"></td>
      </tr>
     </tbody>
    </table>
    <br>
    <button type="submit">ログインする</button>
   </form>
   <table>
    <tr>
     <td>
      <form action="../../Okan/registMemberForm.php" method="post">
       <button type="submit">新規登録</button>
      </form>
     </td>
     <td>
      <form action="../../Okan/forgotMemberForm.php" method="post">
       <button type="submit">ID・パスワード忘れ</button>
      </form> 
     </td>
    </tr>
   </table>
   <br><br>
   <form action="mailto:fuen.works.999@gmail.com" method="post">
    <button type="submit">おかんに意見する</button>
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
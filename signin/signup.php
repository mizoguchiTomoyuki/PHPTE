<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html// xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>サインアップ画面</title>

</head>
<?php

require_once'../sqlClass.php';
session_start();
#このページからのサブミットに対応
if(!empty($_POST)){
	//エラー確認
	if($_POST['name'] == ''){
		$error['name'] = 'blank';	
	}
	if($_POST['pass'] == ''){
		$error['pass'] = 'blank';	
	}else if(strlen($_POST['pass']) < 4){
		$error['pass'] = 'length';	
	}
	if($_POST['mail'] == ''){
		$error['mail'] = 'blank';
	}
	
	
	
	if(empty($error)){
		$mysql = new MySQLClass();
		$mysql->connect('***','***','***');
		$mysql->selectDatabase('service');
		mysql_set_charset('utf8');

		$qresult = $mysql->Query('SELECT name,mail FROM loginpage');
		while ($row = mysql_fetch_assoc($qresult)) {
			if($row['name'] == $_POST['name']){
		
				$error['name'] = 'duplicate';	
			}
			if($row['mail'] == $_POST['mail']){
		
				$error['mail'] = 'duplicate';	
			}
		}
		$mysql->disconnect();
	}


#送信データのエラーチェック後Confirm.phpへ
	if(empty($error)){
		$_SESSION['join'] = $_POST;
		header('Location: confirm.php');
		exit();	
		
	}
	
	
	
	
}	
#Confirm.phpからのrewriteに対応
if(!empty($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite'){
		$_POST = $_SESSION['join'];	
}
?>
<p>名前とパスワードを入力してくださいよ。</p>
<form method="POST" action="signup.php">

<p>Name :<input type="text" name="name" size="60" maxlength="255" value="<?php  if(!empty($_POST['name']))echo htmlspecialchars($_POST['name'], ENT_QUOTES,'UTF-8'); ?>"></p>
<?php
 if(!empty($error['name']) && $error['name'] == 'blank')
	print('<p><font color = "red">※ユーザー名を入力してください。</font></p>');
 if(!empty($error['name']) && $error['name'] == 'duplicate')
	print('<p><font color = "red">※そのユーザー名は既に登録されています。</font></p>');
?>
<p>MailAddress:<input type="text" name="mail" size="60" maxlength="255" value="<?php if(!empty($_POST['mail']))echo htmlspecialchars($_POST['mail'], ENT_QUOTES,'UTF-8'); ?>"></p>
<?php
 if(!empty($error['mail']) && $error['mail'] == 'blank')
print('<p><font color = "red">※メールアドレスを入力してください。</font></p>');

if(!empty($error['mail']) && $error['mail'] == 'duplicate')
print('<p><font color = "red">※そのメールアドレスは既に登録されています。</font></p>');
?>
<p>Password:<input type="text" name="pass" size="60" maxlength="255" value="<?php if(!empty($_POST['pass']))echo htmlspecialchars($_POST['pass'], ENT_QUOTES,'UTF-8'); ?>"></p>
<?php
 if(!empty($error['pass']) && $error['pass'] == 'blank')
print('<p><font color = "red">※パスワードを入力してください。</font></p>');

if(!empty($error['pass']) && $error['pass'] == 'length')
print('<p><font color = "red">※パスワードが短すぎます。4文字以上にしてください。</font></p>');
?>

<input type="submit" value="内容の確認">
</form>

<hr>

</body>
</html>

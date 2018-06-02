<?php
//  MySQL接続用変数定義

// $host = "localhost";
// $user = "root";
// $pass = "root";
// $db = "gp41";
// $code = "set names utf8";

//  MySQL接続用変数定義
/*
$HOST = "192.168.121.16";
$USER = "nhs40124";
$PASS = "b19941124";
$DB = "2016wp32db";
*/
// サーバー用

//DB環境変数定義

$host = "mysql129.phy.lolipop.lan";
$user = "LAA0922714";
$pass = "root";
$db = "LAA0922714-h423";
$code = "set names utf8";


//データベースへ接続
 $Link = mysqli_connect($host, $user, $pass, $db);
 if (!$Link) {
	die('データベースの接続に失敗しました。');
	exit("MySQL:DB接続失敗:".mysqli_connect_error());
 }
 //文字コード指定
 if (!mysqli_query($Link, $code)) {
	exit('Mysql文字選択失敗');
 }
 //データベースを選択
 if (!mysqli_select_db($Link,$db)) {
	exit('データベースの選択に失敗しました。');
 }

return $Link;
?>

<?php
header("Content-Type:text/html; charset=UTF-8");
session_start();
?>
<?php
$data=$_SESSION['DataName'];
$count=$_SESSION['Count'];
$X=$_SESSION['X'];
$Y=$_SESSION['Y'];
$odi=$_SESSION['odi'];

$txtYomi = htmlspecialchars($_POST["yomi"]);
$txtImi = htmlspecialchars($_POST["imi"]);
$txtRei = htmlspecialchars($_POST["rei"]);

for($i=0;$i<count($odi);$i++){
	$dbodi.=$odi[$i]."-";
}
for($i=0;$i<count($X);$i++){
	$pointX.=$X[$i]."-";
}
for($i=0;$i<count($Y);$i++){
	$pointY.=$Y[$i]."-";
}


//設定読み込み

	//データベースへ接続
	include ('ConnectDB_MySQL.php');

	 //↑データベース接続↑
	$query = "INSERT INTO newkanji(KanjiPass,KanjiRubi,KanjiMean,Rei,Kakusu,Bushu,PointX,PointY) VALUES ('$data','$txtYomi','$txtImi','$txtRei','$count','$dbodi','$pointX','$pointY')";
	 if (!$res2 = mysqli_query($Link,$query)) {
		mysqli_close($Link);
	 	exit('失敗1');
	 	echo "失敗1";
	 }

	 if (rename('img/'.$data.'.png', 'dbimg/'.$data.'.png')) {
	  // echo '移動しました。';
	} else {
	  echo '移動できない！';
	}
	mysqli_close($Link);

?>
<!DOCTYPE html>
<html lang="jp" >
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>漢字の投稿 _ マイ｢好｣辞苑</title>
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/fakeLoader.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	</head>
  <body>

	  <div id="fakeLoader"></div>

	  <div class="page he-100vh">

	  		<header class="header">
	  			<div class="title_body">
	  				<a class="title"><h1 class="title__h1">マイこうじえん</h1></a>
	  			</div>
	  		</header>

	  		<article id="comp" class="main comp_area">

	  			<section class="comp">
	  				<canvas style="display: none" width="320" height="240" id="mycanvas"></canvas>

	  				<h2 class="comp__h2">投稿が完了しました！</h2>
	  				<p class="comp__p">あなたの創った漢字が「好」辞苑に追加されました。一覧画面で確認してみましょう！</p>
	  			</section>

	  			<!-- ページ下部のボタン -->
	  			<section class="form_btn_bar">
	  				<a href="index_create.html" class="embossed_btn ">トップ画面に戻る</a>
	  			</section>

	  		</article>

	  	</div>

	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/fakeLoader.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/sub.js"></script>
</body>
</html>

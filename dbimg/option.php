<?php
header("Content-Type:text/html; charset=UTF-8");
session_start();
?>
<?php
// echo 'ago';
$data=$_SESSION['DataName'];
// echo "画像名",$data,"<br />";
$count=$_SESSION['Count'];
// echo "画数",$count;
$X=$_SESSION['X'];
//print_r($X);
$Y=$_SESSION['Y'];
// print_r($Y);

$odi=$_SESSION['odi'];
// print_r($odi);
?>

<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>漢字の設定 _ マイ｢好｣辞苑</title>
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  </head>
  <body>

	  <div class="page he-100vh">

	  		<section class="page_top btn_bar">
	  			<div class="btn_overlap float_left">
	  				<a href="create.php" class="icon_btn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
	  			</div>
	  		</section>


	  		<!-- 漢字のオプション画面 -->
	  		<article id="option" class="main option_area">

	  			<div class="content_top">
	  				<h1 class="content_top__h1"><i class="fa fa-cog" aria-hidden="true"></i>設定する</h1>
	  			</div>

	  			<form action="check.php" method="post" name="option_form">

	  				<div class="content_main flex">

	  					<!-- 画像表示部分 -->
	  					<section class="kanji_check">
	  						<div class="kanji_check__text">
	  							<p class="p_text">あなたが創り出した漢字の設定をしましょう！<br>各項目を入力して「確認する」を押してください。</p>
	  						</div>

	  						<div class="kanji_check__img">
	  							<img src="img/<?php echo $data; ?>.png" alt="kanji_img">
	  						</div>
	  					</section>

	  					<!-- 入力フォーム部分 -->
	  					<section class="form option_form">
	  						<div class="form__group">
	  							<input type="text" class="form__group__input" name="yomi">
	  							<span class="form__group__highlight"></span>
	  							<span class="form__group__bar"></span>
	  							<label class="form__group__label yomi">読み方</label>
	  						</div>
	  						<div class="form__group">
	  							<input type="text" class="form__group__input" name="imi">
	  							<span class="form__group__highlight"></span>
	  							<span class="form__group__bar"></span>
	  							<label class="form__group__label imi">意味</label>
	  						</div>
	  						<div class="form__group">
	  							<input type="text" class="form__group__input" name="rei">
	  							<span class="form__group__highlight"></span>
	  							<span class="form__group__bar"></span>
	  							<label class="form__group__label rei">例文</label>
	  						</div>
	  						<div class="form__group">
	  								<input type="text" class="form__group__input kakusu" name="kakusu" value="<?php echo $count; ?>" disabled>
	  								<span class="form__group__highlight"></span>
	  								<span class="form__group__bar kakusu"></span>
	  								<label class="form__group__label kakusu">画数</label>
	  							</div>
	  						<div class="form__group inline">
	  							<div class="inline__item">
	  								<input type="text" class="form__group__input bushu" value="<?php echo $odi[0]; ?>" name="bushu" disabled>
	  								<span class="form__group__highlight"></span>
	  								<span class="form__group__bar bushu"></span>
	  								<label class="form__group__label bushu">部首</label>
	  							</div>
	  							<div class="inline__item">
	  								<input type="text" class="form__group__input bushu" value="<?php echo $odi[1]; ?>" name="bushu2" disabled>
	  								<span class="form__group__highlight"></span>
	  								<span class="form__group__bar bushu"></span>
	  							</div>
	  							<div class="inline__item">
	  								<input type="text" class="form__group__input bushu" value="<?php echo $odi[2]; ?>" name="bushu3" disabled>
	  								<span class="form__group__highlight"></span>
	  								<span class="form__group__bar bushu"></span>
	  							</div>
	  						</div>
	  					</section>
	  				</div>

	  				<!-- ページ下部のボタン -->
	  				<section class="form_btn_bar">
	  					<input type="submit" id="form_submit" class="form_btn_bar__submit" name="submit">
	  					<label for="form_submit" class="embossed_btn ">確認する</label>
	  				</section>

	  			</form>

	  		</article>

	  	</div>

	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/sub.js"></script>
  </body>
</html>

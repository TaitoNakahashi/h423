<?php
header("Content-Type:text/html; charset=UTF-8");
session_start();
?>
<?php
$data=$_SESSION['DataName'];
$count=$_SESSION['Count'];
$odi=$_SESSION['odi'];

$txtYomi = htmlspecialchars($_POST["yomi"]);
$txtImi = htmlspecialchars($_POST["imi"]);
$txtRei = htmlspecialchars($_POST["rei"]);

?>
<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>漢字の確認 _ マイ｢好｣辞苑</title>
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	</head>
  <body>

	  <div class="page he-100vh">

	  		<section class="page_top btn_bar">
	  			<div class="btn_overlap float_left">
	  				<a href="option.php" class="icon_btn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
	  			</div>
	  		</section>

	  		<article id="check" class="main check_area">

	  			<div class="content_top">
	  				<h1 class="content_top__h1"><i class="fa fa-check" aria-hidden="true"></i>確認する</h1>
	  			</div>

	  			<form action="comp.php" method="post" name="check_form">

	  				<div class="content_main flex">

	  					<!-- 左側 -->
	  					<!-- 画像表示部分 -->
	  					<section class="kanji_check">
	  						<div class="kanji_check__text">
	  							<p class="p_text">あなたが創った漢字の設定を確認しましょう！<br>確認が完了したら「投稿する」を押してください。</p>
	  						</div>

	  						<div class="kanji_check__img">
	  							<img src="img/<?php echo $data; ?>.png" alt="kanji_img">
	  						</div>
	  					</section>

	  					<!-- 右側 -->
	  					<!-- 入力フォーム部分 -->
	  					<section class="form check_form">
	  						<div class="form__group">
	  							<input type="text" class="form__group__input" name="yomi" value="<?php echo $txtYomi; ?>" disabled>
	  							<input type="hidden" class="form__group__input" name="yomi" value="<?php echo $txtYomi; ?>" >
	  							<span class="form__group__bar"></span>
	  							<label class="form__group__label yomi">読み方</label>
	  						</div>
	  						<div class="form__group">
	  							<input type="text" class="form__group__input" name="imi" value="<?php echo $txtImi; ?>" disabled>
	  							<input type="hidden" class="form__group__input" name="imi" value="<?php echo $txtImi; ?>" >
	  							<span class="form__group__bar"></span>
	  							<label class="form__group__label imi">意味</label>
	  						</div>
	  						<div class="form__group">
	  							<input type="text" class="form__group__input" name="rei" value="<?php echo $txtRei; ?>" disabled>
	  							<input type="hidden" class="form__group__input" name="rei" value="<?php echo $txtRei; ?>" >
	  							<span class="form__group__bar"></span>
	  							<label class="form__group__label rei">例文</label>
	  						</div>
	  						<div class="form__group">
	  							<input type="text" class="form__group__input kakusu" name="kakusu" value="<?php echo $count; ?>" disabled>
	  							<span class="form__group__bar kakusu"></span>
	  							<label class="form__group__label kakusu">画数</label>
	  						</div>
	  						<div class="form__group inline">
	  							<div class="inline__item">
	  								<input type="text" class="form__group__input bushu" value="<?php echo $odi[0]; ?>" name="bushu" disabled>
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
	  					<input type="submit" id="form_submit" class="form_btn_bar__submit" data-target="comp" name="submit">
	  					<label for="form_submit" class="embossed_btn ">投稿する</label>
	  				</section>

	  			</form>

	  		</article>

	  	</div>

  <!-- <script type="text/javascript" src="./view.bundle.js"></script> -->
  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/sub.js"></script>
</body>
</html>

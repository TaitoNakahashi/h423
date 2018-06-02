<?php
header("Content-Type:text/html; charset=UTF-8");
session_start();
?>
<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>漢字の作成 _ マイ｢好｣辞苑</title>
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  </head>
  <body>

	  <div class="page he-100vh">

	  		<section class="page_top btn_bar">
	  			<div class="btn_overlap float_left">
	  				<a href="index_create.html" class="icon_btn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
	  			</div>
	  		</section>

	  		<!-- フローティング操作ボタン ヒントを表示する -->
	  		<input type="checkbox" id="helpToggle"/>
	  		<label for="helpToggle" class="control_btn control_btn__question ">
	  			<i id="openHelp" class="fa fa-question control_btn_icon" aria-hidden="true"></i>
	  			<i id="closeHelp" class='fa fa-times control_btn_icon' aria-hidden="true"></i>
	  		</label>

	  		<!-- オーバーレイ -->

	  		<!-- ヘルプ表示　モーダル -->
	  		<section class="help_modal">

	  			<div class="help_modal__title">
	  				<h2 class="help_modal__title__h2">ヒント</h3>
	  			</div>
	  			<!-- コンテンツ内容 -->
	  			<article class="help_modal__content" id="hinto">
	  				<p class="help_modal__content__p" id="">この漢字にお題で出た部首が含まれているよ！参考にしてみよう！</p>
	  			</article>

	  		</section>
	  		<label for="modal" class="modal_bg"></label>

	  		<!-- 字を書く画面 -->
	  		<article id="create" class="main create_area">

	  			<div class="content_top">
	  				<!-- <h1 class="content_top__h1"><i class="fa fa-pencil" aria-hidden="true"></i>書く</h1> -->
	  				<h1 class="content_top__h1"><i class="fa fa-paint-brush" aria-hidden="true"></i>書く</h1>
	  			</div>

	  			<div class="content_main flex">

	  				<!-- お題 画面左 -->
	  				<section class="odai float_left">

	  					<!-- <div class="odai__title">
	  						<h2 class="odai__title__h2">感じで使う部首</h2>
	  					</div> -->

	  					<div class="odai__title">
	  						<h2 class="odai__title__h2">お題</h2>
	  					</div>

	  					<p class="odai__p">
	  						下の部首を使って漢字を組み立てよう！
	  					</p>

	  					<div class="odai__images flex">

	  						<!-- phpおよびjsはidを使用 -->
	  						<div class="odai__images__body odai_img1" id="odi_img1">
	  							<img class="bushu_img" src="" alt="bushu_img">
	  							<span class="bushu_yomi" id=""></span>
	  						</div>
	  						<div class="odai__images__body odai_img2" id="odi_img2">
	  							<img class="bushu_img" src="" alt="bushu_img">
	  							<span class="bushu_yomi" id=""></span>
	  						</div>
	  					</div>

	  					<article class="odai__content">
	  						<p class="odai__content__text" id="odai_text">
	  							難易度を選択してください
	  						</p>
	  						<span class="odai__content__highlight"></span>
	  					</article>

	  					<div class="odai__bottom_bar">
	  						<label for="odai1" class="embossed_btn odai_btn easy " data-target="1">初級</label>
	  						<input type="hidden" id="odai1">
	  						<label for="odai2" class="embossed_btn odai_btn normal " data-target="2">中級</label>
	  						<input type="hidden" id="odai2">
	  						<label for="odai3" class="embossed_btn odai_btn hard " data-target="3">上級</label>
	  						<input type="hidden" id="odai2">
	  					</div>
	  				</section>

	  				<!-- 字を書く部分 -->
	  				<section class="create float_left">
	  					<!-- canvas body -->
	  					<div id="createCanvasBody" class="canvas_body create__canvas_body">
	  						<!-- canvas -->
	  						<canvas id="mycanvas" class="create_canvas"></canvas>
	  					</div>

	  					<!-- ツールメニュー -->
	  					<section class="tool default-menu">
	  						<ul class="tool_list">
	  							<li class="tool_list__item">
	  								<label id="backBtn" class="icon_btn btn-back ">
	  									<i class="fa fa-chevron-left icon_btn__icon" aria-hidden="true"></i>
	  								</label>
	  							</li>
	  							<li class="tool_list__item">
	  								<label id="forwardBtn" class="icon_btn btn-forward ">
	  									<i class="fa fa-chevron-right icon_btn__icon" aria-hidden="true"></i>
	  								</label>
	  							</li>
	  							<li class="tool_list__item">
	  								<label id="erase" class="icon_btn btn-clear ">
	  									<i class="fa fa-trash icon_btn__icon" aria-hidden="true"></i>
	  								</label>
	  							</li>
	  							<li class="tool_list__item">
	  								<label id="posting" class="embossed_btn ">投稿する</label>
	  							</li>
	  						</ul>
	  					</section>
	  				</section>
	  			</div>

	  		</article>

	  	</div>

	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/sub.js"></script>
  </body>
</html>

<!-- <?php
	//漢字のHTML生成
	$disp = '';
	$maxKanji = 10;
	for($i = 0; $i<$maxKanji;$i++) {
		$disp .= '<section class="kanji_panel modal_trigger">';
		$disp .= '<img src="" alt="kanji_img">';
		$disp .= '<h3 class="kanji_panel__yomi">【じ】</h3>';
		$disp .= '<div class="kanji_panel__kakusu">';
		$disp .= '<label class="kakusu_label">画数</label>';
		$disp .= '<span class="kakusu_num">6</span>';
		$disp .= '</div></section>';
	}

?> -->
<!DOCTYPE html>
<html lang="jp" manifest="manifest.appcache">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>漢字の一覧 _ My「好」辞苑</title>
  <link href="./view.bundle.css" rel="stylesheet"></head>
  <body>

	<div class="page he-100vh">

		<header class="header">
			<div class="title_body">
				<a class="title"><h1 class="title__h1">マイこうじえん</h1></a>
			</div>
		</header>

		<!-- フローティング操作ボタン 検索フォームを表示する -->
		<input type="checkbox" id="searchToggle"/>
		<label for="searchToggle" class="control_btn control_btn__search ripple">
			<i id="openSearch" class="fa fa-search control_btn_icon" aria-hidden="true"></i>
			<i id="closeSearch" class='fa fa-arrow-right control_btn_icon' aria-hidden="true"></i>
		</label>

		<!--　検索フォーム -->
		<section class='form search_form'>
			<form action="" id="kanjiSearch">
				<!-- キーワード -->
				<div class="form__group">
					<input type="text" class="form__group__input" name="keyword">
					<span class="form__group__highlight"></span>
					<span class="form__group__bar"></span>
					<label class="form__group__label keyword">キーワード</label>
				</div>
				<!--　submiボタン -->
				<input type="submit" class="" id="search">
				<label for="search" class="flat_btn search_form__btn">検索する</label>
			</form>
		</section>

		<!--  拡大表示部分 -->
		<!-- 拡大表示　オーバーレイ -->
		<label for="modal" class="modal_bg"></label>
		<!--  拡大表示部分 　モーダル-->
		<section class="modal kanji_modal">
			<!-- 閉じるボタン -->
			<label for="modal" class="modal__close_btn" id="modalClose">
				<i class="fa fa-times" aria-hidden="true"></i>
			</label>

			<!-- コンテンツ内容 -->
			<article class="modal__content kanji_model_content flex">
				<!-- 画像部分 -->
				<div class="kanji_thumb"><img src="" alt="kanji_img"></div>
				<!-- テキスト部分 -->
				<h3 id="yomi" class="modal__content__h3 yomi_text">【じ】</h3>
				<div class="bushu">
					<label for="" class="bushu__label">部首</label>
					<span class="bushu__thumb"><img src="" id="bushu1" alt="bushu_thumb"></span>
					<span class="bushu__thumb"><img src="" id="bushu2" alt="bushu_thumb"></span>
					<span class="bushu__thumb"><img src="" id="bushu3" alt="bushu_thumb"></span>
				</div>
				<div class="rei">
					<label for="" class="rei__label">例文</label>
					<p id="rei" class="rei__p rei_text">あいうえおあごあいうえおあごあいうえおあごあいうえおあごあいうえおあごあいうえおあご</p>
				</div>
				<div class="imi">
					<label class="imi__label">意味</label>
					<p id="imi" class="imi__p imi_text">あいうえおあごあいうえおあごあいうえおあごあいうえおあごあいうえおあごあいうえおあご</p>
				</div>

			</article>

			<!--　ボタン部分  -->
			<div class="modal__bottom_bar">
				<a href="#" target="_parent" class="embossed_btn image_btn">画像化する</a>
			</div>
		</section>

		<!-- 字の一覧画面 -->
		<article id="read" class="main read_area">

				<!-- <?php echo $disp; ?> -->

				<!-- 漢字のパネル -->
				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

				<div class="kanji_panel modal_trigger">
					<img src="" alt="kanji_img">
					<!-- 読み -->
					<h3 class="kanji_panel__yomi">【じ】</h3>
					<div class="kanji_panel__kakusu">
						<label class="kakusu_label">画数</label>
						<!-- 画数　数値 -->
						<span class="kakusu_num">6</span>
					</div>
				</div>

		</article>

	</div>

  <script type="text/javascript" src="./view.bundle.js"></script><script type="text/javascript" src="./main.bundle.js"></script></body>
</html>

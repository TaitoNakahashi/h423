<?php
header("Content-Type:text/html; charset=UTF-8");
session_start();
?>
<?php
	//データベースへ接続
	include ('ConnectDB_MySQL.php');

	if(isset($_POST["keyword"])){
		$key=$_POST["keyword"];
	}

	if(isset($_POST["busyu"])){
		$bu=$_POST["busyu"];
	}else{

	}

	if(isset($_POST["sort"])){
		$sort="order by kakusu ".$_POST["sort"];
	}else{
		$sort="";
	}

//$atai=htmlspecialchars($_POST["keyword"]);

//$atai=1;
$disp="";


if($key!=""){
	// echo $key;
	$dbkeyw="%";
	$dbkeyw.=$key;
	$dbkeyw.="%";
			if ($stmt = mysqli_prepare($Link, "SELECT KanjiID,KanjiPass,KanjiRubi,KanjiMean,Rei,Kakusu,Bushu,PointX,PointY FROM newkanji WHERE KanjiRubi LIKE ? or KanjiMean LIKE ? or Rei LIKE ? ".$sort."")) {
			mysqli_stmt_bind_param($stmt, "sss", $dbkeyw,$dbkeyw,$dbkeyw);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $KanjiID,$KanjiPass,$KanjiRubi,$KanjiMean,$Rei,$Kakusu,$Bushu,$PointX,$PointY);
			mysqli_stmt_store_result($stmt);
			while(mysqli_stmt_fetch($stmt)){
				$arrKanjiID[] = $KanjiID;
				$arrKanjiPass[] = $KanjiPass;
				$arrKanjiRubi[] = $KanjiRubi;
				$arrKanjiMean[] = $KanjiMean;
				$arrRei[] = $Rei;
				$arrKakusu[] = $Kakusu;
				$arrBushu[] = $Bushu;
				$arrPointX[] = $PointX;
				$arrPointY[] = $PointY;
			}
		mysqli_stmt_close($stmt);
	}


}else if(isset($bu)){
	$dbbu="%";
	$dbbu.=$bu;
	$dbbu.="%";
	if ($stmt = mysqli_prepare($Link, "SELECT KanjiID,KanjiPass,KanjiRubi,KanjiMean,Rei,Kakusu,Bushu,PointX,PointY FROM newkanji WHERE Bushu LIKE ? ".$sort."")) {
			mysqli_stmt_bind_param($stmt, "s", $dbbu);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $KanjiID,$KanjiPass,$KanjiRubi,$KanjiMean,$Rei,$Kakusu,$Bushu,$PointX,$PointY);
			mysqli_stmt_store_result($stmt);
			while(mysqli_stmt_fetch($stmt)){
				$arrKanjiID[] = $KanjiID;
				$arrKanjiPass[] = $KanjiPass;
				$arrKanjiRubi[] = $KanjiRubi;
				$arrKanjiMean[] = $KanjiMean;
				$arrRei[] = $Rei;
				$arrKakusu[] = $Kakusu;
				$arrBushu[] = $Bushu;
				$arrPointX[] = $PointX;
				$arrPointY[] = $PointY;
			}
		mysqli_stmt_close($stmt);
	}

}else{
		if ($stmt = mysqli_prepare($Link, "SELECT KanjiID,KanjiPass,KanjiRubi,KanjiMean,Rei,Kakusu,Bushu,PointX,PointY FROM newkanji ".$sort."")) {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $KanjiID,$KanjiPass,$KanjiRubi,$KanjiMean,$Rei,$Kakusu,$Bushu,$PointX,$PointY);
			mysqli_stmt_store_result($stmt);
			while(mysqli_stmt_fetch($stmt)){
				$arrKanjiID[] = $KanjiID;
				$arrKanjiPass[] = $KanjiPass;
				$arrKanjiRubi[] = $KanjiRubi;
				$arrKanjiMean[] = $KanjiMean;
				$arrRei[] = $Rei;
				$arrKakusu[] = $Kakusu;
				$arrBushu[] = $Bushu;
				$arrPointX[] = $PointX;
				$arrPointY[] = $PointY;
			}
		mysqli_stmt_close($stmt);
	}
}






for($i=0;$i<count($arrKanjiID);$i++){
$disp.='<!-- 漢字のパネル  この部分を繰り返し生成-->
				<section class="panel popup_trigger" data-target="';
$disp.=$arrKanjiPass[$i].'a'.$i;
$disp.='"">
					<div class="panel_body">

						<div class="panel__img">
							<img src="dbimg/';
$disp.=$arrKanjiPass[$i];
$disp.='.png" alt="kanji_img">
						</div>
						<div id="panelCanvasBody" class="panel__canvas_body">
							<canvas id="kanjiCanvas'.$i.'" class="kanji_canvas"></canvas>
						</div>

						<!-- 通常表示する部分 -->
						<div class="panel__default">
							<!-- 読み -->
							<h3 class="kanji_yomi">【';
$disp.= $arrKanjiRubi[$i];
$disp.='】</h3>
							<div class="kanji_kakusu">
								<label class="kanji_kakusu__label">画数</label>
								<!-- 画数　数値 -->
								<span class="kanji_kakusu__num">';
// ここで漢数字のファンクション
$kansuKakusu = num2kan_normal($arrKakusu[$i]);
// $disp.=$arrKakusu[$i];
$disp.=$kansuKakusu;
$disp.='</span>
							</div>
						</div>

						<!-- ポップアップ時に表示する部分 -->
						<div class="panel__popup">
							<!-- コンテンツ内容 -->
							<article class="panel__popup__content">
								<!-- テキスト部分 -->
								<h3 id="yomi" class="yomi_text">【';
$disp.=$arrKanjiRubi[$i];
$disp.='】</h3>
								<div class="bushu">
									<label for="" class="bushu__label">部首</label>';


$exBushu=explode('-',$arrBushu[$i]);
for($a=0;$a<count($exBushu);$a++){
$disp.='<span class="bushu__name">';
$disp.=$exBushu[$a];
$disp.='</span>';
}
$disp.='
								</div>
								<div class="imi">
									<label class="imi__label">意味</label>
									<p id="imi" class="imi__p imi_text">';
$disp.=$arrKanjiMean[$i];
$disp.='</p>
								</div>
								<div class="rei">
									<label for="" class="rei__label">例文</label>
									<p id="rei" class="rei__p rei_text">';
$disp.=$arrRei[$i];
$disp.='</p>
								</div>

							</article>

							<!--　ボタン部分  -->
							<!-- <div class="panel__popup___bar">
								<a href="#" target="_parent" class="embossed_btn image_btn">画像化する</a>
							</div> -->
						</div>

					</div>
				</section>
				<!-- 漢字のパネル  この部分を繰り返し生成-->';
}


// 漢数字のファンクション
function num2kan_normal($instr) {
    static $kantbl = array(0=>'〇', 1=>'一', 2=>'二', 3=>'三', 4=>'四', 5=>'五', 6=>'六', 7=>'七', 8=>'八', 9=>'九', '.'=>'．', '-'=>'－');

	$outstr = '';
	$len = strlen($instr);
	for ($i = 0; $i < $len; $i++) {
		$ch = substr($instr, $i, 1);
		if ($ch == ',')    continue;        //カンマは無視
		$outstr .= (isset($kantbl[$ch]) ? $kantbl[$ch] : '');
	}

	return $outstr;
 }

?>
<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>漢字の一覧 _ マイ｢好｣辞苑</title>
	<link href="css/font-awesome.css" rel="stylesheet">
	 <link href="css/style.css" rel="stylesheet">
	</head>
  <body>

	  <div class="page he-100vh">

		<section class="page_top btn_bar">
			<div class="btn_overlap float_left">
				<a href="read.php" class="icon_btn"><i class="fa fa-undo" aria-hidden="true"></i></a>
			</div>
			<!-- <div class="btn_overlap float_right">
				<a href="#" class="icon_btn"><i class="fa fa-undo" aria-hidden="true"></i></a>
			</div> -->
		</section>

		<!-- フローティング操作ボタン 検索フォームを表示する -->
		<input type="checkbox" id="searchToggle"/>
		<label for="searchToggle" class="control_btn control_btn__search ">
			<i id="openSearch" class="fa fa-search control_btn_icon" aria-hidden="true"></i>
			<i id="closeSearch" class='fa fa-arrow-right control_btn_icon' aria-hidden="true"></i>
		</label>

		<!-- モーダル　オーバーレイ -->
		<label for="modal" class="modal_bg"></label>
		<!-- モーダル 検索フォーム -->
		<section class='search_modal'>
			<form action="" id="kanjiSearch" method="post" name="form">
				<!-- キーワード -->
				<div class="form__group">
					<input type="text" class="form__group__input" name="keyword">
					<span class="form__group__highlight"></span>
					<span class="form__group__bar"></span>
					<label class="form__group__label keyword">意味 読み</label>
				</div>
				<!-- 部首検索  -->
				<div class="form__group">
					<label class="form__group__label">部首</label>
					<!-- optionをphpで追加 -->
					<select class="form__group__select" name="busyu" id="bushu_select">
						<option class="select_item" value="">すべて</option>
						<option class="select_item" value="さんずい">さんずい</option>
						<option class="select_item" value="しんにょう">しんにょう</option>
						<option class="select_item" value="きへん">きへん</option>
						<option class="select_item" value="てへん">てへん</option>
						<option class="select_item" value="くさかんむり">くさかんむり</option>
						<option class="select_item" value="つちへん">つちへん</option>
					</select>
				</div>

				<!-- 画数の降順昇順 -->
				<div class="form__group">
					<label class="form__group__label">画数で並び替え</label>
					<a href="" onclick="document.form1.submit();return false;">
						<label for="sort-up" class="embossed_btn" >昇順</label>
					</a>
					<a href="" onclick="document.form2.submit();return false;">
						<label for="sort-down" class="embossed_btn" >降順</label>
					<a/>
				</div>
				<!-- <div class="form__group">
					<label class="form__group__label">画数で並び替え</label>
					<label for="sort-up" class="embossed_btn">昇順</label>
					<input type="hidden" id="sort_up">
					<label for="sort-down" class="embossed_btn">降順</label>
					<input type="hidden" id="sort_down">
				</div> -->
				<!-- 部首で並び替え -->

				<!--　submiボタン -->
				<input type="submit" class="" id="search">
				<label for="search" class="flat_btn search_modal__btn">検索する</label>
			</form>

			<!-- 画数の降順昇順 -->
			<form name="form1" method="POST" action="">
				<input type="hidden" name="sort" value="ASC">
			</form>
			<form name="form2" method="POST" action="">
				<input type="hidden" name="sort" value="DESC">
			</form>
		</section>

		<!-- 字の一覧画面 -->
		<article id="read" class="main read_area">

			<!-- 閉じるボタン -->
			<label for="popup" class="control_btn popup_close_btn" id="popupClose">
				<i class="control_btn_icon fa fa-arrow-right" aria-hidden="true"></i>
			</label>

			<?php echo $disp; ?>

		</article>

	</div>

	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/sub.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
	</body>
</html>

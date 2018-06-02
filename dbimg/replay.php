<?php
header("Content-type: text/plain; charset=UTF-8");
session_start();
//設定読み込み

// ajaxで値が受け渡される(json形式)
$json = file_get_contents('php://input');
$json = mb_convert_encoding($json,'UTF-8','ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
 // JSON形式データをPHPの配列型に変換
// $data = json_decode($json, true);
//新規に入力された場合入力データ受け取り
// $KanjiPass = isset($data['kanjiPass']) ? htmlspecialchars($data['kanjiPass']) : '';
// $KanjiPass = trim($KanjiPass);

//$KanjiPass = isset($_POST['kanjiPass']) ? htmlspecialchars($_POST['kanjiPass']) : '';
$kanjiPass=$_POST['kanjiPass'];
// $kanjiID = 11;
//設定読み込み
//データベースへ接続
include ('ConnectDB_MySQL.php');

// if ($stmt = $Link->prepare("SELECT PointX FROM NewKanji WHERE KanjiID = ?")) {
// 	$stmt->bind_param('s', $KanjiPass);
// 	$stmt->execute();
// 	$stmt->bind_result($X, $Y);
// 	while ($stmt->fetch()) {
// 		printf("%s %s\n", $X, $Y);
// 	}
// 	$stmt->close();
// }

// if ($stmt = mysqli_prepare($Link, "SELECT PointX,PointY FROM NewKanji WHERE KanjiID = 11 ")) {
// 	 mysqli_stmt_execute($stmt);
// 	 mysqli_stmt_bind_result($stmt, $X,$Y);
// 	 mysqli_stmt_store_result($stmt);
// 	 mysqli_stmt_fetch($stmt);
// 	 mysqli_stmt_close($stmt);
// }

if ($stmt = mysqli_prepare($Link, "SELECT PointX,PointY FROM NewKanji WHERE KanjiPass= ?")) {
	mysqli_stmt_bind_param($stmt, "s", $kanjiPass);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $X,$Y);
	mysqli_stmt_store_result($stmt);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
}

$XY=$X."_".$Y;
$result = json_encode($XY);
echo $result;

$Link->close();

?>

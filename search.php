<?php
header("Content-Type:text/html; charset=UTF-8");
session_start();
?>
<?php
	//データベースへ接続
	include ('ConnectDB_MySQL.php');
$atai=$_POST['co'];
//一覧
if($atai==1){
	if ($stmt = mysqli_prepare($Link, "SELECT KanjiID,KanjiPass,KanjiRubi,KanjiMean,Rei,Kakusu,Bushu,PointX,PointY FROM newkanji")) {
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
	$disp="miss";
}
$result = json_encode($atai);
echo $result;
?>

<?php
header("Content-type: text/plain; charset=UTF-8");
session_start();
//設定読み込み
	//データベースへ接続
	include ('ConnectDB_MySQL.php');

	//$odai="3";//$_POST['co'];
	//$rand=array("9","13","20");
	$rand=$_POST['co'];
	$disp[]="";
	$odai=count($rand);
	for($i=0;$i<$odai;$i++){
		if ($stmt = mysqli_prepare($Link, "SELECT QRubi,QHantei FROM question WHERE QID = ? ")) {
			mysqli_stmt_bind_param($stmt, "s", $rand[$i]);
			mysqli_stmt_execute($stmt);
	 	 	mysqli_stmt_bind_result($stmt, $rubi,$hantei);
	 	 	mysqli_stmt_store_result($stmt);
	 	 	mysqli_stmt_fetch($stmt);
	 	 	mysqli_stmt_close($stmt);
	 	}
			$arrRubi[] = $rubi;
			$arrHantei[] = $hantei;

	}
$odi[]=$arrRubi[0];
$odi[]=$arrRubi[1];
$odi[]=$arrRubi[2];
$_SESSION['odi']=$odi;
$disp[0]=$arrHantei;
		if($odai==1){
			$disp[1]="『".$arrRubi[0]."』を使って新漢字を作りましょう！";
			$disp[2]='<img class="bushu_img" src="images/busyu/'.$rand[0].'.png" alt="bushu_img"><span class="bushu_yomi" id="">'.$arrRubi[0].'</span>';

		}else if($odai==2){
			$disp[1]="『".$arrRubi[0]."』と『".$arrRubi[1]."』を組み合わせて新漢字を作りましょう！";
			$disp[2]='<img class="bushu_img" src="images/busyu/'.$rand[0].'.png" alt="bushu_img"><span class="bushu_yomi" id="">'.$arrRubi[0].'</span>';
			$disp[3]='<img class="bushu_img" src="images/busyu/'.$rand[1].'.png" alt="bushu_img"><span class="bushu_yomi" id="">'.$arrRubi[1].'</span>';
		}else{
			$disp[1]='『'.$arrRubi[0].'』と『'.$arrRubi[1].'』と<p class="kisetu">『'.$arrRubi[2].'』</p>を組み合わせて新漢字を作りましょう！';
			$disp[2]='<img class="bushu_img" src="images/busyu/'.$rand[0].'.png" alt="bushu_img"><span class="bushu_yomi" id="">'.$arrRubi[0].'</span>';
			$disp[3]='<img class="bushu_img" src="images/busyu/'.$rand[1].'.png" alt="bushu_img"><span class="bushu_yomi" id="">'.$arrRubi[1].'</span>';
			//$disp[4]='<img class="bushu_img" src="images/busyu/'.$rand[2].'.png" alt="bushu_img"><span class="bushu_yomi" id="">'.$arrRubi[2].'</span>';
		}

$result = json_encode($disp);
echo $result;

?>

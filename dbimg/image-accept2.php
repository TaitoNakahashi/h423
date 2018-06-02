<?php
header("Content-type: text/plain; charset=UTF-8");
session_start();
//時間取得(ミリ秒も)
$arrTime = explode('.',microtime(true));
$name = date('YmdHis', $arrTime[0]) .$arrTime[1];





if (is_uploaded_file($_FILES["acceptImage"]["tmp_name"])) {
  if (move_uploaded_file($_FILES["acceptImage"]["tmp_name"], 'img/'.$name.'.png')) {
    //microtimeを.で分割
	$_SESSION['DataName'] = $name;
	echo $name;
	//echo $_FILES["acceptImage"]["tmp_name"];
  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}
?>

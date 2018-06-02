<?php
header("Content-type: text/plain; charset=UTF-8");
session_start();
$kaku=$_POST['co'];
$X=$_POST['X'];
$Y=$_POST['Y'];
	$_SESSION['Count'] = $kaku;
	$_SESSION['X'] = $X;
	$_SESSION['Y'] = $Y;
echo $kaku;

?>

<?php
header("Content-type: text/plain; charset=UTF-8");
//時間取得(ミリ秒も)

$arrTime = explode('.',microtime(true));
$name = date('YmdHis', $arrTime[0]) .$arrTime[1];

// POSTされた画像データの取得

$img= $_POST["gg"];

// ヘッダに「data:image/png;base64,」が付いているので、それは外す
$img= preg_replace("/data:[^,]+,/i","",$img);
 
// 残りのデータはbase64エンコードされているので、デコードする
$img= base64_decode($img);
  
// 文字列状態から画像リソース化
$image = imagecreatefromstring($img);
  
//画像として保存（ディレクトリは任意）
imagesavealpha($image, TRUE); // 透明色の有効
imagepng($image ,'ago/'.$name.'.png');





   $mail['to']['name'] = '新美様';
    //$mail['to']['mail'] = 'sflimscarr@gmail.com';
    $mail['from']['name'] = '××';
    $mail['from']['mail'] = 'ago.tuhou@gmail.com';
    $subject = '『通報』';
    $message = '「あご」と入力した人がいます！';
    $filename = '入力者.png';
    $attach_file = 'ago/'.$name.'.png'; // 添付ファイル へのパス
    $mime_type = "application/octet-stream";
 
    /****
     * 関数定義
     */
 
    // mb_encode_mimeheaderのバグ対策用
    function mb_encode_mimeheader_ex($text, $split_count = 34) {
        $position = 0;
        $encorded = '';
 
        while ($position < mb_strlen($text, 'ISO-2022-JP')) {
            if ($encorded != '') {
                $encorded .= "\r\n ";
            }
            $output_temp = mb_strimwidth($text, $position, $split_count, '', 'ISO-2022-JP');
            $position = $position + mb_strlen($output_temp, 'ISO-2022-JP');
            $encorded .= "=?ISO-2022-JP?B?" . base64_encode($output_temp) . "?=";
        }
 
        return $encorded;
    }
 
    /****
     * 以下、実際の処理
     */
 
    // 文字エンコードの設定
    mb_internal_encoding('UTF-8');
 
    // マルチパートなので、パートの区切り文字列を指定
    $boundary = '----=_Boundary_' . uniqid(rand(1000,9999) . '_') . '_';
 
    // 件名のエンコード
    $subject = mb_convert_encoding($subject, 'ISO-2022-JP', 'UTF-8');
    $subject = mb_encode_mimeheader_ex($subject);
 
    // 本文のエンコード
    $message = mb_convert_encoding($message, 'ISO-2022-JP', 'UTF-8');
 
    // toをエンコード
    $to = mb_convert_encoding($mail['to']['name'], "JIS", "UTF-8");
    $to = "=?ISO-2022-JP?B?" . base64_encode($to) . '?= <' . $mail['to']['mail'] . '>';
 
    // fromをエンコード
    $from = mb_convert_encoding($mail['from']['name'], "JIS", "UTF-8");
    $from = "=?ISO-2022-JP?B?" . base64_encode($from) . '?= <' . $mail['from']['mail'] . '>';
 
    // 添付ファイルのエンコード
    $filename = mb_convert_encoding($filename, 'ISO-2022-JP', 'UTF-8');
    $filename = "=?ISO-2022-JP?B?" . base64_encode($filename) . "?=";
    $attach_file = file_get_contents($attach_file); // ファイルを開く
    $attach_file = chunk_split(base64_encode($attach_file), 76, "\n"); // Base64に変換し76Byte分割
 
    // ヘッダーの指定
    $head = '';
    $head .= "From: {$from}\n";
    $head .= "MIME-Version: 1.0\n";
    $head .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\n";
    $head .= "Content-Transfer-Encoding: 7bit";
 
    $body = '';
 
    // 本文
    $body .= "--{$boundary}\n";
    $body .= "Content-Type: text/plain; charset=ISO-2022-JP\n" .
              "Content-Transfer-Encoding: 7bit\n";
    $body .= "\n";
    $body .= "{$message}\n";
 
    // 添付ファイルの処理
    $body .= "--{$boundary}\n";
    $body .= "Content-Type: {$mime_type}; name=\"{$filename}\"\n" .
             "Content-Transfer-Encoding: base64\n" .
             "Content-Disposition: attachment; filename=\"{$filename}\"\n";
    $body .= "\n";
    $body .= "{$attach_file}\n";
 
    // マルチパートの終了
    $body .= "--$boundary--\n";
 
    if (mail($to, $subject, $body, $head)) {
        echo '送信完了';
    } else {
        echo '送信できませんでした。';
    }


?>
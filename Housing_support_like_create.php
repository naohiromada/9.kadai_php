<?php
// まずはこれ
// var_dump($_GET);
// exit();
// 関数ファイルの読み込み
include('functions.php');
// GETデータ取得
$user_id = $_GET['id'];
$Housing_support_id = $_GET['id'];
// DB接続
$pdo = connect_to_db();

$sql = 'INSERT INTO Housing_support_like_table(id, user_id, Housing_support_id, created_at)
 VALUES(NULL, :user_id, :Housing_support_id, sysdate())'; // SQL作成

//  
// いいね状態のチェック（COUNTで件数を取得できる！）
$sql = 'SELECT COUNT(*) FROM Housing_support_like_table 
 WHERE user_id=:user_id AND Housing_support_id=:Housing_support_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':Housing_support_id', $Housing_support_id, PDO::PARAM_INT);
$status = $stmt->execute();
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]); // エラー処理
} else {
    $like_count = $stmt->fetch();
    // var_dump($like_count[0]); // データの件数を確認しよう！
    // exit();
    // いいねしていれば削除，していなければ追加のSQLを作成
    if ($like_count[0] != 0) {
        $sql = 'DELETE FROM Housing_support_like_table WHERE user_id=:user_id AND Housing_support_id=:Housing_support_id';
    } else {
        $sql = 'INSERT INTO Housing_support_like_table(id, user_id, Housing_support_id, created_at)
 VALUES(NULL, :user_id, :Housing_support_id, sysdate())';
    }
    // INSERTのSQLは前項で使用したものと同じ！
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':Housing_support_id', $Housing_support_id, PDO::PARAM_INT);
    $status = $stmt->execute();
    // 以降（SQL実行部分と一覧画面への移動）は変更なし！
    if ($status == false) {
        $error = $stmt->errorInfo();
        echo json_encode(["error_msg" => "{$error[2]}"]); // エラー処理
    } else {
        header("location:Housing_support_read.php");
        exit();
    }
    // SQL文は1行にまとめる
}
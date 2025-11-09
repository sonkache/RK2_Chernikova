<?php
require_once __DIR__.'/../db.php'; require_once __DIR__.'/../functions.php';
if(!is_authed()){ header('Location: /primer_shop/auth/login.php'); exit; }
$uid = $_SESSION['user']['id'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';
if($action==='add'){
  $pid = (int)($_POST['product_id']??0); $qty = max(1,(int)($_POST['qty']??1));
  $stmt = $mysqli->prepare("INSERT INTO cart(user_id,product_id,qty) VALUES(?,?,?) ON DUPLICATE KEY UPDATE qty=qty+VALUES(qty)");
  $stmt->bind_param('iii',$uid,$pid,$qty); $stmt->execute();
  header('Location: /primer_shop/cart.php'); exit;
}
if($action==='set'){
  $pid = (int)($_POST['product_id']??0); $qty = max(1,(int)($_POST['qty']??1));
  $stmt = $mysqli->prepare("UPDATE cart SET qty=? WHERE user_id=? AND product_id=?");
  $stmt->bind_param('iii',$qty,$uid,$pid); $stmt->execute();
  echo 'ok'; exit;
}
if($action==='remove'){
  $pid = (int)($_POST['product_id']??0);
  $stmt = $mysqli->prepare("DELETE FROM cart WHERE user_id=? AND product_id=?");
  $stmt->bind_param('ii',$uid,$pid); $stmt->execute();
  echo 'ok'; exit;
}
http_response_code(400); echo 'bad request';
?>

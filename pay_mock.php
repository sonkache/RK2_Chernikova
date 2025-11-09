<?php
require_once __DIR__.'/db.php';
require_once __DIR__.'/functions.php';
require_auth();

$id = (int)($_GET['id'] ?? 0);
$ord = $mysqli->prepare("SELECT id,status,total,payment_method FROM orders WHERE id=? AND user_id=?");
$ord->bind_param('ii',$id,$_SESSION['user']['id']); $ord->execute();
$o = $ord->get_result()->fetch_assoc();
if(!$o){ http_response_code(404); echo "Заказ не найден"; exit; }

$action = $_GET['action'] ?? '';
if($action==='success'){
  $u = $mysqli->prepare("UPDATE orders SET status='paid' WHERE id=? AND user_id=?");
  $u->bind_param('ii',$id,$_SESSION['user']['id']); $u->execute();
  $status = 'paid';
} elseif($action==='cancel'){
  $u = $mysqli->prepare("UPDATE orders SET status='cancelled' WHERE id=? AND user_id=?");
  $u->bind_param('ii',$id,$_SESSION['user']['id']); $u->execute();
  $status = 'cancelled';
} else {
  $status = $o['status'];
}
?>
<?php include __DIR__.'/partials/header.php'; ?>
<h1>Оплата заказа №<?= (int)$id ?></h1>

<?php if($status==='pending'): ?>
  <p>Сумма к оплате: <strong><?= price_rub($o['total']) ?></strong></p>
  <p>Способ оплаты: <strong><?= esc(strtoupper($o['payment_method'])) ?></strong></p>
  <div style="display:flex; gap:12px; margin:16px 0">
    <a class="btn" href="/primer_shop/pay_mock.php?id=<?= (int)$id ?>&action=success">Оплатить</a>
    <a class="btn" style="background:#fff;color:#000;border:1px solid #000" href="/primer_shop/pay_mock.php?id=<?= (int)$id ?>&action=cancel">Отменить</a>
  </div>
<?php elseif($status==='paid'): ?>
  <p class="ok">Оплата прошла успешно! Спасибо.</p>
  <p>Статус заказа: <strong>Оплачен</strong></p>
<?php elseif($status==='cancelled'): ?>
  <p class="err">Оплата отменена.</p>
  <p>Статус заказа: <strong>Отменён</strong></p>
<?php endif; ?>

<p><a href="/primer_shop/shop.php">Вернуться в магазин</a></p>
<?php include __DIR__.'/partials/footer.php'; ?>

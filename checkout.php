<?php
require_once __DIR__.'/db.php';
require_once __DIR__.'/functions.php';
require_auth();
include __DIR__.'/partials/header.php';

$uid = $_SESSION['user']['id'];
$q = $mysqli->prepare("SELECT c.product_id, c.qty, p.title, p.price FROM cart c JOIN products p ON p.id=c.product_id WHERE c.user_id=?");
$q->bind_param('i',$uid); $q->execute(); $items = $q->get_result()->fetch_all(MYSQLI_ASSOC);
if(!$items){ echo "<h1>Оформление</h1><p>Корзина пуста.</p>"; include __DIR__.'/partials/footer.php'; exit; }
$sum = 0; foreach($items as $it){ $sum += $it['price'] * $it['qty']; }

if($_SERVER['REQUEST_METHOD']==='POST'){
  $fio = trim($_POST['fio'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $address = trim($_POST['address'] ?? '');
  $pay = $_POST['payment_method'] ?? 'card';
  if($fio && $phone && $address){
    $stmt = $mysqli->prepare("INSERT INTO orders(user_id,fio,phone,address,payment_method,status,total) VALUES(?,?,?,?,?,'pending',?)");
    $stmt->bind_param('issssd', $uid, $fio, $phone, $address, $pay, $sum);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    $ins = $mysqli->prepare("INSERT INTO order_items(order_id,product_id,title,price,qty) VALUES(?,?,?,?,?)");
    foreach($items as $it){
      $ins->bind_param('iisdi', $order_id, $it['product_id'], $it['title'], $it['price'], $it['qty']);
      $ins->execute();
    }
    $del = $mysqli->prepare("DELETE FROM cart WHERE user_id=?"); $del->bind_param('i',$uid); $del->execute();

    header("Location: /primer_shop/pay_mock.php?id=".$order_id);
    exit;
  } else $err = 'Заполните ФИО, телефон и адрес.';
}
?>
<h1>Оформление</h1>

<div class="grid" style="grid-template-columns:2fr 1fr; gap:24px">
  <form method="post" class="auth-form" style="max-width:none">
    <?php if(!empty($err)): ?><p class="err"><?= esc($err) ?></p><?php endif; ?>
    <label>ФИО <input name="fio" required value="<?= esc($_SESSION['user']['name']) ?>"></label>
    <label>Телефон <input name="phone" required placeholder="+7..."></label>
    <label>Адрес доставки <input name="address" required placeholder="Город, улица, дом, кв."></label>
    <fieldset style="border:1px solid var(--border); border-radius:10px; padding:10px">
      <legend>Оплата</legend>
      <label><input type="radio" name="payment_method" value="card" checked> Банковская карта</label><br>
      <label><input type="radio" name="payment_method" value="sbp"> СБП</label><br>
      <label><input type="radio" name="payment_method" value="cash"> Наличными курьеру</label>
    </fieldset>
    <button class="btn">Перейти к оплате</button>
  </form>

  <div>
    <h3>Ваш заказ</h3>
    <div class="cart">
      <?php foreach($items as $it): ?>
        <div class="cart-row" style="grid-template-columns:1fr 80px; border:none">
          <div><?= esc($it['title']) ?> × <?= (int)$it['qty'] ?></div>
          <div style="text-align:right"><?= price_rub($it['price']*$it['qty']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="cart-total" style="justify-content:space-between">
      <span>Итого:</span><strong><?= price_rub($sum) ?></strong>
    </div>
  </div>
</div>
<?php include __DIR__.'/partials/footer.php'; ?>

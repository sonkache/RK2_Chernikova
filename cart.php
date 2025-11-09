<?php require_once __DIR__.'/db.php'; require_once __DIR__.'/functions.php'; require_auth(); include __DIR__.'/partials/header.php';
$uid = $_SESSION['user']['id'];
$q = $mysqli->prepare("SELECT c.product_id, c.qty, p.title, p.price, p.image FROM cart c JOIN products p ON p.id=c.product_id WHERE c.user_id=?");
$q->bind_param('i',$uid); $q->execute(); $items = $q->get_result()->fetch_all(MYSQLI_ASSOC);
$sum = 0; foreach($items as $it){ $sum += $it['price'] * $it['qty']; }
?>
<h1>Корзина</h1>
<?php if(!$items): ?>
  <p>Ваша корзина пуста.</p>
<?php else: ?>
  <div class="cart">
    <?php foreach($items as $it): ?>
      <div class="cart-row" data-id="<?= (int)$it['product_id'] ?>">
        <img src="/primer_shop/assets/img/products/<?= esc($it['image']) ?>" alt="<?= esc($it['title']) ?>">
        <div class="title"><?= esc($it['title']) ?></div>
        <div class="price"><?= price_rub($it['price']) ?></div>
        <div class="qty">
          <button class="dec">−</button>
          <input type="number" value="<?= (int)$it['qty'] ?>" min="1">
          <button class="inc">+</button>
        </div>
        <div class="line"><?= price_rub($it['price']*$it['qty']) ?></div>
        <button class="remove">Удалить</button>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="cart-total">Итого: <strong id="cart-sum"><?= price_rub($sum) ?></strong></div>
  <?php if($items): ?>
  <div style="display:flex;justify-content:flex-end;margin-top:12px">
    <a class="btn" href="/primer_shop/checkout.php">Перейти к оформлению</a>
  </div>
<?php endif; ?>

  <?php endif; ?>
<script src="/primer_shop/assets/js/cart.js"></script>
<?php include __DIR__.'/partials/footer.php'; ?>

<?php require_once __DIR__.'/db.php'; require_once __DIR__.'/functions.php'; include __DIR__.'/partials/header.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $mysqli->prepare("SELECT id, title, description, price, image, brand, volume_ml FROM products WHERE id=?");
$stmt->bind_param('i', $id);
$stmt->execute();
$p = $stmt->get_result()->fetch_assoc();
if(!$p){ echo '<p>Товар не найден.</p>'; include __DIR__.'/partials/footer.php'; exit; }
?>
<div class="product">
  <img class="product-img" src="/primer_shop/assets/img/products/<?= esc($p['image']) ?>" alt="<?= esc($p['title']) ?>">
  <div class="product-info">
    <h1><?= esc($p['title']) ?></h1>
    <div class="muted"><?= esc($p['brand']) ?> • <?= (int)$p['volume_ml'] ?> мл</div>
    <div class="price big"><?= price_rub($p['price']) ?></div>
    <form method="post" action="/primer_shop/api/cart.php" class="buy">
      <input type="hidden" name="action" value="add">
      <input type="hidden" name="product_id" value="<?= (int)$p['id'] ?>">
      <label>Количество <input type="number" name="qty" value="1" min="1"></label>
      <button class="btn">В корзину</button>
    </form>
    <h3>Описание</h3>
    <p><?= nl2br(esc($p['description'])) ?></p>
  </div>
</div>
<?php include __DIR__.'/partials/footer.php'; ?>

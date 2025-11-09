<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/db.php';
require_once __DIR__.'/functions.php';
include __DIR__.'/partials/header.php';

<?php require_once __DIR__.'/db.php'; require_once __DIR__.'/functions.php'; include __DIR__.'/partials/header.php'; ?>

<section class="hero">
  <div class="slider">
    <div class="slides">
      <img class="active" src="/primer_shop/assets/img/banners/b1.jpg" alt="Баннер 1">
      <img src="/primer_shop/assets/img/banners/b2.jpg" alt="Баннер 2">
      <img src="/primer_shop/assets/img/banners/b3.jpg" alt="Баннер 3">
      <img src="/primer_shop/assets/img/banners/b4.jpg" alt="Баннер 4">
      <img src="/primer_shop/assets/img/banners/b5.jpg" alt="Баннер 5">
    </div>
    <button class="prev" aria-label="Назад">‹</button>
    <button class="next" aria-label="Вперёд">›</button>
  </div>
</section>

<section>
  <h2>Новые праймеры</h2>
  <div class="grid">
    <?php
    $res = $mysqli->query("SELECT id, title, price, image, brand, volume_ml FROM products ORDER BY id DESC LIMIT 6");
    while($p = $res->fetch_assoc()): ?>
      <a class="card" href="/primer_shop/product.php?id=<?= (int)$p['id'] ?>">
        <img src="/primer_shop/assets/img/products/<?= esc($p['image']) ?>" alt="<?= esc($p['title']) ?>">
        <div class="card-body">
          <div class="card-title"><?= esc($p['title']) ?></div>
          <div class="muted"><?= esc($p['brand']) ?> • <?= (int)$p['volume_ml'] ?> мл</div>
          <div class="price"><?= price_rub($p['price']) ?></div>
        </div>
      </a>
    <?php endwhile; ?>
  </div>
</section>

<?php include __DIR__.'/partials/footer.php'; ?>

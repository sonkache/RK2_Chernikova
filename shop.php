<?php require_once __DIR__.'/db.php'; require_once __DIR__.'/functions.php'; include __DIR__.'/partials/header.php'; ?>
<h1>Магазин</h1>
<div class="shop-toolbar">
  <input type="text" id="search" placeholder="Поиск праймеров..." aria-label="Поиск">
  <select id="brand">
    <option value="">Все бренды</option>
    <?php
      $brands = $mysqli->query("SELECT DISTINCT brand FROM products ORDER BY brand");
      while($b = $brands->fetch_row()){ echo '<option>'.esc($b[0]).'</option>'; }
    ?>
  </select>
  <select id="sort">
    <option value="new">Сначала новые</option>
    <option value="price_asc">Цена: по возрастанию</option>
    <option value="price_desc">Цена: по убыванию</option>
  </select>
</div>
<div id="products" class="grid"></div>
<script src="/primer_shop/assets/js/shop.js"></script>
<?php include __DIR__.'/partials/footer.php'; ?>

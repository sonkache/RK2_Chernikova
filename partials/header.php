<?php require_once __DIR__.'/../config.php'; ?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc(APP_NAME) ?></title>
  <link rel="stylesheet" href="/primer_shop/assets/css/styles.css?v=3">
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
    <div class="logo"><a href="/primer_shop/index.php"><?= esc(APP_NAME) ?></a></div>
    <nav class="nav">
      <a href="/primer_shop/index.php" class="<?= basename($_SERVER['PHP_SELF'])==='index.php'?'active':'' ?>">Главная</a>
      <a href="/primer_shop/shop.php" class="<?= basename($_SERVER['PHP_SELF'])==='shop.php'?'active':'' ?>">Магазин</a>
      <a href="/primer_shop/contact.php" class="<?= basename($_SERVER['PHP_SELF'])==='contact.php'?'active':'' ?>">Контакты</a>
      <?php if(is_authed()): ?>
        <a href="/primer_shop/cart.php" class="<?= basename($_SERVER['PHP_SELF'])==='cart.php'?'active':'' ?>">Корзина</a>
        <span class="hello">Здравствуйте, <?= esc($_SESSION['user']['name']) ?></span>
        <a href="/primer_shop/auth/logout.php" class="btn-out">Выйти</a>
      <?php else: ?>
        <a href="/primer_shop/auth/login.php">Войти</a>
        <a href="/primer_shop/auth/register.php" class="btn">Регистрация</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<main class="container">

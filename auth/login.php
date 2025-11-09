<?php require_once __DIR__.'/../db.php'; require_once __DIR__.'/../functions.php'; include __DIR__.'/../partials/header.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email = trim($_POST['email']??'');
  $pass = $_POST['password']??'';
  $stmt = $mysqli->prepare("SELECT id,name,email,password_hash FROM users WHERE email=?");
  $stmt->bind_param('s',$email); $stmt->execute(); $u = $stmt->get_result()->fetch_assoc();
  if($u && password_verify($pass, $u['password_hash'])){
    $_SESSION['user']=['id'=>$u['id'],'name'=>$u['name'],'email'=>$u['email']];
    header('Location: /primer_shop/index.php'); exit;
  } else $err='Неверный email или пароль.';
}
?>
<h1>Вход</h1>
<?php if(!empty($err)): ?><p class="err"><?= esc($err) ?></p><?php endif; ?>
<form class="auth-form" method="post">
  <label>Email <input name="email" type="email" required></label>
  <label>Пароль <input name="password" type="password" required></label>
  <button class="btn">Войти</button>
</form>
<p>Нет аккаунта? <a href="/primer_shop/auth/register.php">Зарегистрироваться</a></p>
<?php include __DIR__.'/../partials/footer.php'; ?>

<?php require_once __DIR__.'/../db.php'; require_once __DIR__.'/../functions.php'; include __DIR__.'/../partials/header.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name = trim($_POST['name']??'');
  $email = trim($_POST['email']??'');
  $pass = $_POST['password']??'';
  if($name && filter_var($email,FILTER_VALIDATE_EMAIL) && $pass){
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO users(name,email,password_hash) VALUES(?,?,?)");
    if($stmt){ $stmt->bind_param('sss',$name,$email,$hash); $ok=$stmt->execute(); }
    if(!empty($ok)){
      $_SESSION['user']=['id'=>$stmt->insert_id,'name'=>$name,'email'=>$email];
      header('Location: /primer_shop/index.php'); exit;
    } else $err='Такой email уже зарегистрирован или ошибка БД.';
  } else $err='Заполните все поля корректно.';
}
?>
<h1>Регистрация</h1>
<?php if(!empty($err)): ?><p class="err"><?= esc($err) ?></p><?php endif; ?>
<form class="auth-form" method="post">
  <label>Имя <input name="name" required></label>
  <label>Email <input name="email" type="email" required></label>
  <label>Пароль <input name="password" type="password" required></label>
  <button class="btn">Создать аккаунт</button>
</form>
<p>Уже есть аккаунт? <a href="/primer_shop/auth/login.php">Войти</a></p>
<?php include __DIR__.'/../partials/footer.php'; ?>

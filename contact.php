<?php require_once __DIR__.'/db.php'; require_once __DIR__.'/functions.php'; include __DIR__.'/partials/header.php'; ?>
<h1>Контакты</h1>
<p>Есть вопрос — напишите нам. Авторизация не обязательна.</p>
<form class="contact-form" method="post">
  <label>Имя <input name="name" required value="<?= esc($_SESSION['user']['name'] ?? '') ?>"></label>
  <label>Email <input type="email" name="email" required value="<?= esc($_SESSION['user']['email'] ?? '') ?>"></label>
  <label>Тема <input name="subject" required></label>
  <label>Сообщение <textarea name="message" required></textarea></label>
  <button class="btn">Отправить</button>
</form>
<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
  $stmt = $mysqli->prepare("INSERT INTO feedback(name,email,subject,message) VALUES(?,?,?,?)");
  $stmt->bind_param('ssss', $_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
  if($stmt->execute()){ echo '<p class="ok">Спасибо! Мы получили ваше сообщение.</p>'; }
  else { echo '<p class="err">Ошибка отправки</p>'; }
}
?>
<?php include __DIR__.'/partials/footer.php'; ?>

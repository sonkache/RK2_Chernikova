<?php
function esc($s){ return htmlspecialchars($s ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function is_authed(){ return isset($_SESSION['user']); }
function require_auth(){
    if(!is_authed()){ header('Location: /primer_shop/auth/login.php'); exit; }
}
function price_rub($n){ return number_format($n, 2, ',', ' ') . ' ₽'; }
?>

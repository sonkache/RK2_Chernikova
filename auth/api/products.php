<?php
require_once __DIR__.'/../db.php'; require_once __DIR__.'/../functions.php';
$q = trim($_GET['q'] ?? '');
$brand = trim($_GET['brand'] ?? '');
$sort = $_GET['sort'] ?? 'new';
$order = "id DESC";
if($sort==='price_asc') $order = "price ASC";
if($sort==='price_desc') $order = "price DESC";
$sql = "SELECT id,title,price,image,brand,volume_ml FROM products WHERE 1";
$params = []; $types='';
if($q!==''){ $sql.=" AND title LIKE ?"; $params[] = "%$q%"; $types.='s'; }
if($brand!==''){ $sql.=" AND brand=?"; $params[] = $brand; $types.='s'; }
$sql .= " ORDER BY $order LIMIT 60";
$stmt = $mysqli->prepare($sql);
if($params){ $stmt->bind_param($types, ...$params); }
$stmt->execute();
$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($res, JSON_UNESCAPED_UNICODE);
?>

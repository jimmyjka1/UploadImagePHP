<?php
// (A) CONNECT TO DATABASE

// (B) GET IMAGE FROM DATABASE
if (!isset($_GET['id'])){
    die("NO id specified");
}
require "pdo.php";
$stmt = $pdo->prepare("SELECT * FROM `images` WHERE `id`=?");
$stmt->execute([htmlspecialchars(strip_tags($_GET['id']))]);
$imgR = $stmt->fetch();
$img = $imgR["img_data"];
// var_dump($imgR);

// (C) BASE 64 ENCODE TO OUTPUT TO <IMG> TAG
$img = base64_encode($img);
$ext = pathinfo($imgR['img_name'], PATHINFO_EXTENSION);
echo "<img src='data:image/".$ext.";base64,".$img."'/>";
?>
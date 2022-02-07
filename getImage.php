<?php
    if (!isset($_GET['id'])) {
        die("No Id specified");
    }

    require_once("pdo.php");

    $stmt = $pdo->prepare("SELECT * FROM `images` WHERE `id`=?");
    $stmt->execute([htmlspecialchars(strip_tags($_GET['id']))]);
    $imgR = $stmt->fetch();
    $img = $imgR["img_data"];

    // (C) OUTPUT IMAGE
    $ext = pathinfo($imgR['img_name'], PATHINFO_EXTENSION);
    if ($ext == "jpg") {
        $ext = "jpeg";
    }

    // var_dump($ext);
    header("Content-type: image/" . $ext);
    echo $img;

?>
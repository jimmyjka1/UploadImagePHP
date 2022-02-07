<?php
require_once "pdo.php";

$statusMsg = $status = "";
if (isset($_POST["submit"])) {
    $status = "error";
    // var_dump("<pre>",$_FILES);

    if (!empty($_FILES['file']['name'])) {
        $fileName = basename($_FILES['file']['name']);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // var_dump($fileName);
        // var_dump($fileType);

        $allowTypes = array('jpg', 'jpeg', 'gif', 'png');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['file']['tmp_name'];
            $stmt = $pdo->prepare("INSERT INTO `images` (`img_name`, `img_data`) VALUES (?,?)");
            $stmt->execute([$_FILES["file"]["name"], file_get_contents($_FILES["file"]["tmp_name"])]);

            $id = $pdo -> lastInsertId();
            echo 'To view Image : <a href="imageView.php?id='.$id.'">Go Here</a><br>
            To download Image: <a href="getImage.php?id='.$id.'">Go Here</a>';

        }
    } else {
        $statusMsg = "Please select an Image file to upload.";
    }
} else {
    $statusMsg = "Please select an Image file to upload.";
}





echo $statusMsg;

?>


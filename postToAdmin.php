<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
print_r($_FILES);
if($_POST['text']) {
    $uploaddir = __DIR__ . '/uploads/';
    $fileName = $_FILES['file']['name'];
    $newName = date("YmdHis");
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $uploadfile = $uploaddir . $newName.".".$ext;


    if(!empty($_FILES['file']['name'])) {
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    }

    file_put_contents(__DIR__ . '/posts/'.$newName.'.txt', $_POST['text']);
}

header("Location: loggedIn.php?success");
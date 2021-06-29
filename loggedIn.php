<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Session Steal | Member Area</title>

    <style type="text/css">
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

    </style>
</head>
<body class="text-center">

<main class="form-signin">
    <?php
    if ($_SESSION['type'] === 'user') { ?>
        <form action="postToAdmin.php" method="post" enctype="multipart/form-data">
            <?php if(isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    Daten erfolgreich an Admin gesendet
                </div>
            <?php } ?>
            <h1 class="h3 mb-3 fw-normal">Hallo <?= $_SESSION['user'] ?> (<?= $_SESSION['type'] ?>)</h1>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Message for admin</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="text" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">File for admin</label>
                <input class="form-control" type="file" id="formFile" name="file">
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">POST to admin</button>
        </form>
    <?php
    } ?>
    <?php
    if ($_SESSION['type'] === 'admin') {
        $path = './posts';
        $files = array_diff(scandir($path), array('.', '..'));

        ?>
        <h1 class="h3 mb-3 fw-normal">POSTS von Benutzern</h1>

        <ul class="list-group">
            <?php
            foreach ($files as $file) {
                ?>
                <li class="list-group-item"><?=$file?>: <?=file_get_contents(__DIR__."/posts/".$file)?></li>
                <?php
            }
            ?>
        </ul>
    <?php
    } ?>
</main>


</body>
</html>
